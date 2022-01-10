<?php

namespace App\Http\Controllers\Panel;

use App\Models\User;
use App\Models\Expediente;
use Illuminate\Http\Request;
use App\Models\ValorCertificado;
use App\Http\Controllers\Controller;
use App\Models\CalibracionHistorial;
use App\Models\Patron;
use App\Models\PatronIde;
use App\Models\Procedimiento;
use App\Models\Valor;
use App\Models\ValorResultado;
use Illuminate\Support\Facades\DB;

class CertificadoController extends Controller
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
        $expedientes = Expediente::where('expediente_estado_id', 3)->relaciones()->get();
        return view('panel.calibracion.certificados.index', compact('expedientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return redirect(route('panel.certificados.index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect(route('panel.certificados.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expediente = Expediente::relaciones()->findOrFail($id);
        $patrones = $expediente->getPatternsForCalibrationCertificate();

        $calibracionId = $expediente->calibracion->id;
        $instrumentoId = $expediente->instrumentos->id;


        $valores = Valor::where('calibracion_id', $calibracionId)->get();
        $valorResultados = ValorResultado::getValorResults($valores);
        $valoresCertificado = ValorCertificado::ValorTable($calibracionId)->get();
        $ide = PatronIde::where('patron_id', $patrones[1]->id)->first();
        $instrumentoProcedimiento = DB::table('instrumento_procedimiento')->where('instrumento_id', $instrumentoId)->first();
        $procedimiento = Procedimiento::whereId($instrumentoProcedimiento->procedimiento_id)->with('incertidumbres')->first();
        $historialCalibracion = CalibracionHistorial::where('calibracion_id', $calibracionId)->get();


        return view('panel.calibracion.certificados.show', compact(
            'expediente',
            'patrones',
            'valores',
            'valorResultados',
            'valoresCertificado',
            'ide',
            'procedimiento',
            'historialCalibracion'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect(route('panel.certificados.index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect(route('panel.certificados.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    /**
     * Imprime los datos el detalle del certificado de calibración
     *
     * @param  int expedienteId
     * @return \Illuminate\Http\Response
     */
    public function print($expedienteId)
    {
        $expediente = Expediente::calibration()->findOrFail($expedienteId);
        $patrones = $expediente->getPatternsForCalibrationCertificate();
        $valoresCertificado = ValorCertificado::ValorTable($expediente->calibracion->id)->get();
        $ide = PatronIde::where('patron_id', $patrones[1]->id)->first();
        // $tecnicoRealizador = User::where('id', $expediente->tecnicos[0]['id'])->first();

        return view('panel.calibracion.certificados.print', compact(
            'expediente',
            'patrones',
            'valoresCertificado',
            'ide'
        ));
    }
}
