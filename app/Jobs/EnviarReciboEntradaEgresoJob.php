<?php

namespace App\Jobs;

use App\Models\Expediente;
use Illuminate\Bus\Queueable;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReciboEntradaEgresoMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class EnviarReciboEntradaEgresoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Entrada de Instrumentos
     *
     * @var \App\Models\EntradaInstrumento
     */
    public $entradaInstrumento;

    /**
     * Identifica si el envío se generó por una entrada
     *
     * @var boolean
     */
    public $esEntrada;

    /**
     * Create a new job instance.
     *
     * @param \App\Models\EntradaInstrumento $entradaInstrumento
     * @return void
     */
    public function __construct($entradaInstrumento, $esEntrada=true)
    {
        $this->entradaInstrumento = $entradaInstrumento;
        $this->esEntrada = $esEntrada;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $info = $this->prepararEmailInfo();

        Mail::to($info['email'])->send(
            new ReciboEntradaEgresoMail($info['esEntrada'], $info['expedientes'], $info['pdf'])
        );
    }

    /**
     * Prepara la información que contendrá el email
     *
     * @return array
     */
    public function prepararEmailInfo()
    {
        $info = [];

        $entradaInstrumento = $this->entradaInstrumento;

        $expedientesIngresados = Expediente::cantidad($entradaInstrumento->id)->get();

        $egresoInstrumentos = $entradaInstrumento->egresoInstrumentos
            ->map(function ($egresoInstrumento) use ($entradaInstrumento) {
                $egresoInstrumento->expedientesEgresados = Expediente::cantidad($entradaInstrumento->id)
                    ->whereIn('id', $egresoInstrumento->detalleEgresoInstrumentos->pluck('expediente_id'))
                    ->get();

                return $egresoInstrumento;
            });

        $data = compact('entradaInstrumento', 'expedientesIngresados', 'egresoInstrumentos');

        $view =  view('panel.instrumentos.registro_entradas_egresos.print', $data);

        $pdf = PDF::loadHtml($view)->setPaper('a3');

        $info = [
            'email'     => $entradaInstrumento->contact['email'],
            'esEntrada' => $this->esEntrada,
            'pdf'       => $pdf->output(),
        ];

        $info['expedientes'] = $this->esEntrada
            ? $expedientesIngresados
            : $egresoInstrumentos->last()->expedientesEgresados;

        return $info;
    }
}
