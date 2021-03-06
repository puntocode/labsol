<?php

namespace App\Http\Controllers\Panel;

use App\Models\Expediente;
use App\Models\Calibracion;
use Illuminate\Http\Request;
use App\Models\AlertCalibration;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\CalibracionHistorial;
use App\Models\ValorHistorial;

class CalibracionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function limpiarValores(Request $request)
    {
        $calibracion = Calibracion::with('valorHistorial')->where('expediente_id', $request['expediente_id'])->first();

        foreach($calibracion->valores as $valor){
            $historial = new ValorHistorial;
            $historial->patron = $valor->patron;
            $historial->ip_valor = $valor->ip_valor;
            $historial->iec_valor = $valor->iec_valor;
            $historial->ip_medida = $valor->ip_medida;
            $historial->iec_medida = $valor->iec_medida;
            $historial->calibracion_id = $calibracion->id;
            $historial->save();
        }

        $calibracion->valores()->delete();
        return response()->json($calibracion);
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $calibracion = Calibracion::find($id);
      return response()->json($calibracion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $calibracion = Calibracion::find($request['id']);
        $calibracion->update($request->all());
        return response()->json($calibracion);
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


    public function calibrarExpediente($expediente_id)
    {
        $userId = Auth::id();
        $userName = Auth::user()->name . ' ' . Auth::user()->last_name;
        $calibracion = Calibracion::where('expediente_id', $expediente_id)->first();

        if($calibracion == null) $calibracion = Calibracion::create(['expediente_id' => $expediente_id, 'user_id' => $userId]);

        $expediente = Expediente::calibration()->findOrFail($expediente_id);

        //Guarda el historial de estados ---------------------------------
        if($expediente->expediente_estado_id !== 11){
            $expediente->historial()->create([
                'estado_anterior' => $expediente->expediente_estado_id,
                'estado_nuevo' => 11,
                'estado_comentario' => 'Inicia el proceso de calibraci??n',
                'user_id' => Auth::id(),
            ]);
        }

        //Actualiza al tecnico que est?? logueado ---------------------------------
        $expediente->update([
            'expediente_estado_id' => 11,
            'tecnicos' => [[ 'id' => $userId, 'nombre' => $userName ]]
        ]);

        return view('panel.calibracion.form', compact('expediente'));
    }


    /**
     * Retorna la alerta de calibracion
     *
     * @return \Illuminate\Http\Response
     */
    public function getAlertCalibration(){
        return response()->json(AlertCalibration::all());
    }



    public function actualizarHistorico(Request $request)
    {
        $calibracion = Calibracion::find($request['id'])->fill($request->all());
        $anterior = [];
        $nuevo = [];

        if($calibracion->isDirty())
        {
            $temporal = Calibracion::whereId($request['id'])->get();

            //actualizamos
            $calibracion->update($request->all());

            //detectamos los cambios
            $cambios = $calibracion->getChanges();

            //guardamos los campos modificados
            foreach($cambios as $key => $cambio){
                if($key !== "updated_at"){
                    $anterior[$key] = $temporal[0][$key];
                    $nuevo[$key] = $request[$key];
                }
            }

            $data = [
                'anteriores' => $anterior,
                'nuevos' => $nuevo,
                'calibracion_id' => $calibracion->id,
                'user_id' => Auth::user()->id,
            ];

            CalibracionHistorial::create($data);

        }
        return response()->json($calibracion);
    }


    public function actualizarCampo(Request $request){
        $calibracion = Calibracion::find($request->id);
        $actualizado = $calibracion->update([ $request->campo => $request->valor ]);
        return response()->json($request->valor);
    }


}
