<?php

namespace App\Http\Controllers\Panel;

use App\Models\Expediente;
use App\Http\Controllers\Controller;
use App\Jobs\EnviarCertificadosCalibracionJob;
use App\Http\Requests\Panel\EnviarCertificadoCalibracionRequest;

class EnviarCertificadoCalibracionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expedientes = Expediente::where('enviado', false)
            ->whereHas('estados', function ($estadosQuery) {
                $estadosQuery->whereIn('name', ['FACTURADA', 'PREFACTURADO']);
            })
            ->relaciones()
            ->get();

        return view('panel.egreso.enviar_certificados_calibracion.index', compact('expedientes'));
    }

    /**
     * Send certificates
     *
     * @param EnviarCertificadoCalibracionRequest $request
     * @return void
     */
    public function send(EnviarCertificadoCalibracionRequest $request)
    {
        $expedientes = Expediente::whereIn('id', $request->expedientes)
            ->relaciones()
            ->get();

        Expediente::whereIn('id', $request->expedientes)
            ->update(['enviado' => Expediente::STATUS_ENVIO_CERTIFICADO_EN_PROCESO]);

        dispatch(new EnviarCertificadosCalibracionJob($expedientes));

        return redirect()->route('panel.egreso.enviar-certificados-calibracion.index');
    }
}
