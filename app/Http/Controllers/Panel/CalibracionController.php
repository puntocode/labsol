<?php

namespace App\Http\Controllers\Panel;

use App\Models\Expediente;
use App\Models\Calibracion;
use Illuminate\Http\Request;
use App\Models\AlertCalibration;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\CalibracionHistorial;

class CalibracionController extends Controller
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
      $expedientes = config('demo.expedientes');
      $calibraciones = config('demo.calibraciones');
      $estados = config('demo.estados_calibraciones');
      return view('panel.calibracion.index', compact('expedientes', 'estados', 'calibraciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $calibracion = NULL;
        $expedientes = config('demo.expedientes');
        $clientes = config('demo.clientesContacto');
        $instrumentos = config('demo.instrumentos');
        $patrones = config('demo.patrones');
        return view('panel.calibracion.form', compact('calibracion', 'expedientes', 'clientes', 'instrumentos', 'patrones'));
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
        $calibracion = config('demo.calibraciones')[$id];
        return view('panel.clientes.form', compact('calibracion'));
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


    public function getAlertCalibration(){
        return response()->json(AlertCalibration::all());
    }


    public function calibrarExpediente($expediente_id)
    {
        $userId = Auth::id();
        $userName = Auth::user()->name . ' ' . Auth::user()->last_name;
        $calibracion = Calibracion::where('expediente_id', $expediente_id)->first();

        if($calibracion == null){
            $calibracion = Calibracion::create(['expediente_id' => $expediente_id, 'user_id' => $userId]);
        }

        $expediente = Expediente::calibration()->findOrFail($expediente_id);

        $expediente->update([
            'expediente_estado_id' => 11,
            'tecnicos' => [[ 'id' => $userId, 'nombre' => $userName ]]
        ]);

        return view('panel.calibracion.form', compact('expediente'));
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


}
