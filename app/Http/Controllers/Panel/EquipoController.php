<?php

namespace App\Http\Controllers\Panel;

use App\Models\Equipo;
use App\Models\Document;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Historycalibration;
use App\Models\Historymaintenance;

class EquipoController extends Controller
{

    public function index()
    {
        $equipos = Equipo::all();
        if(request()->wantsJson()){
            $equipos = Equipo::where('condition_id', '!=', 2)->orderBy('description')->get();
            return response()->json($equipos);
        }
        return view('panel.equipos.index', compact('equipos'));
    }


    public function create()
    {
      $equipo = NULL;
      return view('panel.equipos.form', compact('equipo'));
    }


    public function store(Request $request)
    {
        $equipo = Equipo::create($this->validateData());
        return response()->json($equipo);
    }


    public function show($id)
    {
        $equipo = Equipo::findOrFail($id);
        $documentos = $equipo->getDocuments();
        $historyCalibration = Historycalibration::where('historycalibration_id', $equipo->id)->where('historycalibration_type', 'App\Models\Equipo')->get();
        $historyMaintenance = Historymaintenance::where('historymaintenance_id', $equipo->id)->where('historymaintenance_type', 'App\Models\Equipo')->get();
        return view('panel.equipos.show', compact('equipo', 'documentos', 'historyCalibration', 'historyMaintenance'));
    }


    public function edit($id)
    {
      $equipo = Equipo::findOrFail($id);
      return view('panel.equipos.form', compact('equipo'));
    }


    public function update(Request $request, $id)
    {
        $equipo = Equipo::findOrFail($request->id);
        $equipo->update($this->validateData());
        return response()->json($equipo);
    }


    public function destroy($id)
    {

    }


    public function hojaVida($id){
        $data = [
            'data' => Equipo::with('magnitude', 'procedimientos')->whereId($id)->first(),
            'calibracion' => Historycalibration::where('historycalibration_id', $id)->where('historycalibration_type', 'App\Models\Equipo')->get(),
            'mantenimiento' => Historymaintenance::where('historymaintenance_id', $id)->where('historymaintenance_type', 'App\Models\Equipo')->get()
        ];
        return view('panel.equipos.hoja-vida', compact('data'));
    }


    public function getEquipoForId($id){
        return response()->json(Equipo::find($id));
    }


    public function validateData()
    {
        return request()->validate([
            'code'                 => 'required',
            'description'          => 'required',
            'condition_id'         => 'required',
            'magnitude_id'         => 'required',
            'alert_calibration_id' => 'required',
            'brand'                => 'nullable',
            'certificate_no'       => 'nullable',
            'rank'                 => 'nullable',
            'resolution'           => 'nullable',
            'calibration_period'   => 'nullable',
            'error_max'            => 'nullable',
            'last_calibration'     => 'nullable',
            'next_calibration'     => 'nullable',
            'ubication'            => 'nullable',
            'model'                => 'nullable',
            'type'                 => 'nullable',
            'serie_number'         => 'nullable',
            'uncertainty'          => 'nullable',
            'tolerance'            => 'nullable',
            'procedimiento_id'     => 'nullable',
            'headboard'            => 'nullable'
        ]);
    }

    #Historial de calibracion ----------------------------------------------

    public function equipoCalibrationHistory(Equipo $equipo, $id)
    {
        return view('panel.equipos.calibration-history', compact('equipo', 'id'));
    }

    public function storeCalibrationHistory(Request $request, $id)
    {
        $equipo = Equipo::findOrFail($id);
        if($request->file('documento')){
            $documento = $this->cargarDocumento($request);
            $request['certificate'] = $documento['nombre'];
        }
        $equipo->historycalibrations()->create($request->all());
        $equipo->certificate_no = $request['certificate_no'];
        $equipo->save();
        return response()->json($equipo);
    }


    #Historial de Mantenimiento ----------------------------------------------

    public function equipoMaintenanceHistory(Equipo $equipo, $id)
    {
        return view('panel.equipos.maintenance-history', compact('equipo', 'id'));
    }

    public function equipoMaintenanceStore(Request $request, $id)
    {
        $equipo = Equipo::findOrFail($id);
        $equipo->historymaintenances()->create($request->all());
        return response()->json($equipo);
    }


    #Documentos --------------------------------------------------------------

    public function documents(Equipo $equipo)
    {
        return view('panel.equipos.doc', compact('equipo'));
    }

    public function storeDocument(Request $request, $id)
    {
        $arrayDoc = $this->cargarDocumento($request);
        $equipo = Equipo::findOrFail($id);
        $equipo->documents()->create([
            'extension' => $arrayDoc['extension'],
            'name' => $arrayDoc['nombre'],
            'category' => $request->header('category'),
            'idioma' => $request->header('idioma'),
            'url' => $arrayDoc['url']
        ]);
        return response()->json($equipo);
    }


    public function cargarDocumento($request){
        $file = $request->file('documento')->getClientOriginalName();
        $extension = $request->documento->guessExtension();
        $slug = Str::slug(pathinfo($file,PATHINFO_FILENAME));
        $nombreArchivo = $slug.".".$extension;
        $url = 'media/docs/'.$request->header('folder');
        $request->documento->move(public_path($url), $nombreArchivo);

        return [
            'nombre' =>  $nombreArchivo,
            'extension' =>  $extension,
            'url' =>  $url,
        ];
    }



}
