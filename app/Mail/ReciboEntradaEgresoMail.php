<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReciboEntradaEgresoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Identifica si es un recibo de entrada
     *
     * @var boolean
     */
    public $esEntrada;

    /**
     * Colección de expedientes a los que se le dió entrada/salida
     *
     * @var \Illuminate\Support\Collection
     */
    public $expedientes;

    /**
     * Documento PDF a enviar
     *
     * @var string
     */
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($esEntrada, $expedientes, $pdf)
    {
        $this->esEntrada   = $esEntrada;
        $this->expedientes = $expedientes;
        $this->pdf         = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tipo = $this->esEntrada ? 'Recepción' : 'Retiro';

        $subject = "$tipo de ítems de Calibración";

        $this->view('emails.entrada_egreso.recibo')
            ->subject($subject)
            ->attachData(
                $this->pdf,
                "$subject.pdf",
                ['mime' => 'application/pdf']
            );

        return $this;
    }
}
