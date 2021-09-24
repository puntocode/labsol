<?php

namespace App\Http\Controllers\Panel;

use App\Models\Patron;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Historycalibration;
use App\Models\Historymaintenance;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;


class PatronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patrones = Patron::all();
        if(request()->wantsJson()) return response()->json($patrones);
        return view('panel.patrones.index', compact('patrones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patrone = null;
        return view('panel.patrones.form', compact('patrone'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patron = Patron::create($this->validateData());
        return response()->json($patron);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patron  $patron
     * @return \Illuminate\Http\Response
     */
    public function show(Patron $patrone)
    {
        $documentos = $patrone->getDocuments();
        $historyCalibration = Historycalibration::where('historycalibration_id', $patrone->id)->where('historycalibration_type', 'App\Models\Patron')->get();
        $historyMaintenance = Historymaintenance::where('historymaintenance_id', $patrone->id)->where('historymaintenance_type', 'App\Models\Patron')->get();
        return view('panel.patrones.show', compact('patrone', 'documentos', 'historyCalibration', 'historyMaintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patron  $patron
     * @return \Illuminate\Http\Response
     */
    public function edit(Patron $patrone)
    {
        return view('panel.patrones.form', compact('patrone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patron  $patron
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patron $patron)
    {
        $pattern = Patron::findOrFail($request->id);
        $pattern->update($this->validateData());
        return response()->json(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patron  $patron
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patron $patron)
    {
        //$patron = Patron::find($id);
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
            'precision'            => 'nullable',
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
            'procedimiento_id'     => 'nullable'
        ]);
    }

    public function hojaVida($id)
    {
        $data = [
            'data' => Patron::with('magnitude', 'procedimientos')->whereId($id)->first(),
            'calibracion' => Historycalibration::where('historycalibration_id', $id)->where('historycalibration_type', 'App\Models\Patron')->get(),
            'mantenimiento' => Historymaintenance::where('historymaintenance_id', $id)->where('historymaintenance_type', 'App\Models\Patron')->get()
        ];
        return view('panel.patrones.hoja-vida', compact('data'));
    }


    public function historial(){
      return view('panel.historial.index');
    }


    public function getPatronForId($id){
        return response()->json(Patron::find($id));
    }


    #Documentos -----------------------------------------------------------

    public function documents(Patron $patron)
    {
        return view('panel.patrones.documents.doc', compact('patron'));
    }

    public function storeDocument(Request $request, $id)
    {
        $arrayDoc = $this->cargarDocumento($request);
        $patron = Patron::findOrFail($id);
        $patron->documents()->create([
            'category' => $request->header('category'),
            'idioma' => $request->header('idioma'),
            'extension' => $arrayDoc['extension'],
            'name' => $arrayDoc['nombre'],
            'url' => $arrayDoc['url']
        ]);
        return response()->json($patron);
    }

    #Historial de calibracion ----------------------------------------------

    public function patronCalibrationHistory(Patron $patron, $id)
    {
        return view('panel.patrones.calibration-history.form', compact('patron', 'id'));
    }

    public function storeCalibrationHistory(Request $request, $id)
    {
        $patron = Patron::findOrFail($id);
        if($request->file('documento')) $request['certificate'] = $this->cargarDocumento($request);
        $patron->historycalibrations()->create($request->all());
        return response()->json($request);
    }



    #Historial de Mantenimiento ----------------------------------------------

    public function patronMaintenanceHistory(Patron $patron, $id)
    {
        return view('panel.patrones.maintenance-history.form', compact('patron', 'id'));
    }

    public function patronMaintenanceStore(Request $request, $id)
    {
        $patron = Patron::findOrFail($id);
        $patron->historymaintenances()->create($request->all());
        return response()->json($patron);
    }


    public function cargarDocumento($request)
    {
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
