<?php

namespace App\Http\Controllers\Panel;

use App\Models\Expediente;
use Illuminate\Http\Request;
use App\Models\ExpedienteEstado;
use App\Http\Controllers\Controller;
use App\Models\CalibracionHistorial;
use App\Models\ExpedienteHistorial;
use App\Models\PatronIde;
use App\Models\Procedimiento;
use App\Models\Valor;
use App\Models\ValorCertificado;
use App\Models\ValorResultado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class ExpedienteController extends Controller
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
        # -- Filtros --
        $estados = ExpedienteEstado::where('status', true)->get();
        $expedientes = Expediente::relaciones()->get();
        return view('panel.expedientes.index', compact('expedientes', 'estados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(404);
        /*if (\Auth::user()->hasRole('administrador') === false) abort(403);
        return redirect(route('panel.expedientes.index'));        */
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
        // dd($expediente->toArray());
        $patrones = null;
        $valores = null;
        $ide = null;
        $historialCalibracion = null;
        $valorResultados = null;
        $valoresCertificado = null;


        if(isset($expediente->calibracion)){
            $calibracionId = $expediente->calibracion->id;
            $valores = Valor::where('calibracion_id', $calibracionId)->get();
            $historialCalibracion = CalibracionHistorial::where('calibracion_id', $calibracionId)->get();

            if(isset($valores)){
                $valorResultados = ValorResultado::getValorResults($valores);
                $valoresCertificado = ValorCertificado::ValorTable($calibracionId)->get();
            }
        }


        if($expediente->expediente_estado_id > 2 && $expediente->expediente_estado_id != 11){
            $patrones = $expediente->getPatternsForCalibrationCertificate();
            $ide = PatronIde::where('patron_id', $patrones[1]->id)->first();
        }

        $instrumentoProcedimiento = DB::table('instrumento_procedimiento')->where('instrumento_id', $expediente->instrumento_id)->first();
        $procedimiento = Procedimiento::whereId($instrumentoProcedimiento->procedimiento_id)->with('incertidumbres')->first();


        return view('panel.expedientes.show', compact(
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
        // $expediente = Expediente::find($id);
        // $historial = ExpedienteHistorial::where('expediente_id', $id)->get();
        // return view('panel.expedientes.form', compact('expediente', 'historial'));
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
        $expediente = Expediente::with('instrumentos', 'estados')->findOrFail($id);
        $expediente->certificate = $request['certificate'];
        $expediente->certificate_ruc = $request['certificate_ruc'];
        $expediente->certificate_adress = $request['certificate_adress'];
        $expediente->obs = $request['obs'];
        $expediente->priority = $request['priority'];
        $expediente->save();

        return response()->json($expediente);
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


    public function getExpedienteEspera(){
        $expedientes = Expediente::relaciones()->asignar()->get();
        return response()->json($expedientes);
    }

    public function agenda(Request $request){
        $estados = ExpedienteEstado::agenda()->get();
        $expedientes = Expediente::agenda()->get();
        $estadosSum = Expediente::suma()->get();

        $estadosFiltro = $estadosSum->filter(function ($value, $key) {
            return $value->expediente_estado_id == '2' || $value->expediente_estado_id == '11' || $value->expediente_estado_id == '8';
        });
        return view('panel.expedientes.agenda.index', compact('estados','expedientes', 'estadosFiltro'));
    }


    public function asignarTecnicoIndex()
    {
        return view('panel.expedientes.asignar');
    }


    public function asignarTecnicos(Request $request)
    {
        $exp = Expediente::relaciones()->where('number', $request['number'])->first();

        $comentario = 'Tecnicos Asignados: ';
        foreach($request['personales'] as $tecnicos){
            $comentario = $comentario. $tecnicos['nombre']. ', ';
        }

        $exp->historial()->create([
            'estado_anterior' => $exp->expediente_estado_id,
            'estado_nuevo' => 2,
            'estado_comentario' => $comentario,
            'user_id' => Auth::id(),
        ]);

        $exp->update(['tecnicos' => $request['personales'], 'delivery_date' => $request['delivery_date'], 'expediente_estado_id' => 2]);
        return response()->json($exp);
    }



    public function cambiarEstadoExpediente(Request $request)
    {
        $statusNew = $request['expediente_estado_id'];
        $exp = Expediente::findOrFail($request['expediente_id']);

        $comentario = 'Ya han tomado datos de medición y generado el certificado de calibración';

        if($request->has('estado_comentario')) $comentario = $request['estado_comentario'];

        if($request['expediente_estado_id'] == 9){
            $exp->tecnicos = null;
            $exp->delivery_date = null;
        }

        //Guarda el historial de estados ---------------------------------
        $exp->historial()->create([
            'estado_anterior' => $exp->expediente_estado_id,
            'estado_nuevo' => $statusNew,
            'estado_comentario' => $comentario,
            'user_id' => Auth::id(),
        ]);

        $exp->expediente_estado_id = $statusNew;
        $exp->save();
        return response()->json($exp);
    }





    /**
     * Display historial of expedients.
     *
     * @return \Illuminate\Http\Response
     */
    public function getHistorial(Request $request)
    {
        $historial = ExpedienteHistorial::with('user', 'estadoNuevo')->where('expediente_id', $request['expediente_id'])->get();
        return response()->json($historial);
    }



}
