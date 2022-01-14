<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CertificadoCalibracionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Información de contacto del cliente
     *
     * @var array
     */
    public $contacto;

    /**
     * Documentos PDF a enviar
     *
     * @var array
     */
    public $documentos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contacto, $documentos)
    {
        $this->contacto = $contacto;
        $this->documentos = $documentos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->view('emails.calibracion.certfificado')
            ->subject('Certificado(s) de Calibración');

        foreach ($this->documentos as $index => $documento) {
            $this->attachData(
                $documento['pdf'],
                "Certificado de Calibración {$documento['number']}.pdf",
                ['mime' => 'application/pdf']
            );
        }

        return $this;
    }
}
