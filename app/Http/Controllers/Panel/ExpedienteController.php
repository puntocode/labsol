<?php

namespace App\Http\Controllers\Panel;

use App\Models\Expediente;
use Illuminate\Http\Request;
use App\Models\ExpedienteEstado;
use App\Http\Controllers\Controller;
use App\Models\ExpedienteHistorial;
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
        $expedientes = Expediente::with('servicios', 'estados')->get();
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
        $data = $this->cargarData($id);
        return view('panel.expedientes.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expediente = Expediente::find($id);
        $historial = ExpedienteHistorial::where('expediente_id', $id)->get();
        return view('panel.expedientes.form', compact('expediente', 'historial'));
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
        return $request->all();
        //return redirect(route('panel.expedientes.index'));
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
        $expedientes = Expediente::where('expediente_estado_id', 1)->with('servicios', 'estados')->get();
        return response()->json($expedientes);
    }

    public function agenda(Request $request){
        $estados = ExpedienteEstado::activo()->get();
        $expedientes = Expediente::whereNotNull('delivery_date')->get();
        $estadosSum = Expediente::suma()->get();
        return view('panel.expedientes.agenda.index', compact('estados','expedientes', 'estadosSum'));
    }


    public function asignarTecnicoIndex()
    {
        $estados = ExpedienteEstado::where('status', true)->get();
        $expedientes = Expediente::with('servicios', 'estados')->get();
        return view('panel.expedientes.asignar', compact('expedientes', 'estados'));
    }


    public function asignarTecnicos(Request $request)
    {
        //foreach($request['number'] as $expediente){
            $exp = Expediente::where('number', $request['number'])->first();
            $exp->update(['tecnicos' => $request['personales'], 'delivery_date' => $request['delivery_date']]);
            ExpedienteHistorial::create(['expediente_id' => $exp->id, 'tecnicos' => $request['personales'], 'delivery_date' => $request['delivery_date']]);
        //}
        return response()->json(Response::HTTP_OK);
    }



    public function cargarData($id)
    {
        $data = [
            'expediente' => Expediente::with('servicios', 'estados')->find($id),
            'historial'  => ExpedienteHistorial::where('expediente_id', $id)->get(),
        ];
        return $data;
    }

}
