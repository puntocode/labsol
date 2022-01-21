<?php

namespace App\Jobs;

use Exception;
use App\Models\PatronIde;
use App\Models\Expediente;
use Illuminate\Bus\Queueable;
use App\Models\ValorCertificado;
use Barryvdh\DomPDF\Facade as PDF;
use App\Mail\CertificadoCalibracionMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class EnviarCertificadosCalibracionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Expedientes a enviar
     *
     * @var \Illuminate\Support\Collection
     */
    public $expedientes;

    /**
     * Create a new job instance.
     *
     * @param \Illuminate\Support\Collection $expedientes
     * @return void
     */
    public function __construct($expedientes)
    {
        $this->expedientes = $expedientes;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emails = $this->prepararEmailsInfo();

        foreach ($emails as $email => $data) {
            try {
                Mail::to($email)->send(new CertificadoCalibracionMail($data['contacto'], $data['documentos']));

                Expediente::whereIn('id', $this->expedientes->pluck('id'))
                    ->update([
                        'enviado'                 => Expediente::STATUS_ENVIO_CERTIFICADO_ENVIADO,
                        'fecha_envio_certificado' => now(),
                    ]);
            } catch (Exception $e) {
                $ids = collect($data['documentos'])->pluck('id');

                Expediente::whereIn('id', $ids)->update(['enviado' => false]);

                throw $e;
            }
        }
    }

    /**
     * Prepara la información que contendrá cada email
     *
     * @return array
     */
    public function prepararEmailsInfo()
    {
        $emails = [];

        try {
            foreach ($this->expedientes as $expediente) {

                $patrones           = $expediente->getPatternsForCalibrationCertificate();
                $valoresCertificado = ValorCertificado::ValorTable($expediente->calibracion->id)->get();
                $ide                = PatronIde::where('patron_id', $patrones[1]->id)->first();
                $srcGrafica         = $this->generarGrafica($valoresCertificado, $ide);

                $data = compact(
                    'expediente',
                    'patrones',
                    'valoresCertificado',
                    'ide',
                    'srcGrafica'
                );

                $view = view('panel.egreso.enviar_certificados_calibracion.print', $data);

                $pdf = PDF::loadHtml($view)->setPaper('a3');

                $email = $expediente->entradaInstrumentos->contact['email'];

                $emails[$email]['contacto'] = $expediente->entradaInstrumentos->contact;
                $emails[$email]['documentos'][] = [
                    'id'     => $expediente->id,
                    'number' => $expediente->number,
                    'pdf'    => $pdf->output()
                ];
            }
        } catch (Exception $e) {
            Expediente::whereIn('id', $this->expedientes->pluck('id'))->update(['enviado' => false]);

            throw $e;
        }

        return $emails;
    }

    /**
     * Envía una petición para generar la gráfica en plotly
     * devolviendo la url de la imagen de la gráfica generada
     *
     * @param \App\Models\ValorCertificado $valoresCertificado
     * @param \App\Models\PatronIde $ide
     * @return string
     */
    private function generarGrafica($valoresCertificado, $ide)
    {
        $unidad = $valoresCertificado->first()->unidad ?? '';
        $xAxisTitle = "<b>$ide->magnitude ( $unidad )</b>";

        $xData = $valoresCertificado->pluck('ip');
        $yData = $valoresCertificado->pluck('e');
        $errorYData = $valoresCertificado->pluck('u');

        $username = 'USERNAME='. config('plotly.username');
        $apiKey   = 'API_KEY=' . config('plotly.api_key');

        $command = "$username $apiKey node public/grafica_certificado.js '$xAxisTitle' $xData $yData $errorYData";

        shell_exec($command);

        return Storage::get('grafica-certificado.txt');
    }
}
