<?php

namespace App\Http\Controllers\Panel;

use App\Models\Patron;
use App\Models\PatronIde;
use Illuminate\Support\Str;
use App\Models\PatronEnsayo;
use Illuminate\Http\Request;
use App\Models\Historycalibration;
use App\Models\Historymaintenance;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
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

        if(request()->wantsJson()){
            $patrones = Patron::where('condition_id', '!=', 2)->orderBy('description')->get();
            return response()->json($patrones);
        }

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
        $patron->magnitude()->attach($request['magnitude']);
        return response()->json($request->all());
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
        $ide = PatronIde::with('rangos.ocultos')->where('patron_id',$patrone->id)->get();
        $ensayos = PatronEnsayo::where('patron_id', $patrone->id)->get();
        return view('panel.patrones.show', compact('patrone', 'documentos', 'historyCalibration', 'historyMaintenance', 'ide', 'ensayos'));
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
        $pattern->magnitude()->sync($request['magnitude']);
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
            'alert_calibration_id' => 'required',
            'brand'                => 'nullable',
            'calibration'          => 'required',
            'calibration_period'   => 'nullable',
            'certificate_no'       => 'nullable',
            'code'                 => 'required',
            'condition_id'         => 'required',
            'description'          => 'required',
            'error_max'            => 'nullable',
            'last_calibration'     => 'nullable',
            'model'                => 'nullable',
            'next_calibration'     => 'nullable',
            'precision'            => 'nullable',
            'procedimiento_id'     => 'nullable',
            'rank'                 => 'nullable',
            'serie_number'         => 'nullable',
            'tolerance'            => 'nullable',
            'type'                 => 'nullable',
            'type_description'     => 'nullable',
            'ubication'            => 'nullable',
            'uncertainty'          => 'nullable',
        ]);
    }

    public function hojaVida($id)
    {
        $data = [
            'data' => Patron::with('magnitude', 'procedimientos', 'formulario')->whereId($id)->first(),
            'calibracion' => Historycalibration::where('historycalibration_id', $id)->where('historycalibration_type', 'App\Models\Patron')->get(),
            'mantenimiento' => Historymaintenance::where('historymaintenance_id', $id)->where('historymaintenance_type', 'App\Models\Patron')->get()
        ];
        return view('panel.patrones.hoja-vida', compact('data'));
    }

    /**
     * Imprime la hoja de vida del Patrón
     *
     * @param \App\Models\Patron $id
     * @return \Illuminate\Http\Response
     */
    public function hojaVidaPrint(Patron $patron)
    {
        $patron->load([
            'magnitude',
            'procedimientos',
            'formulario',
            'historycalibrations',
            'historymaintenances',
        ]);

        $view = view('panel.patrones.hoja_vida.print', compact('patron'));

        $pdf = PDF::loadHtml($view)->setPaper('a3');

        return $pdf->stream("Hoja de Vida del Patrón #$patron->id.pdf");
    }


    public function getPatronForId($id){
        return response()->json(Patron::with('magnitude')->find($id));
    }

    public function getPatronForCode(Request $request){
        return response()->json(Patron::with('magnitude')->where('code', $request->code)->firstOrFail());
    }




    #Documentos ----------------------------------------------------------------------------------------------------------------------------
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
            'idioma' => $request->header('idioma') == 'ESPANOL' ? 'ESPAÑOL' : $request->header('idioma'),
            'extension' => $arrayDoc['extension'],
            'name' => $arrayDoc['nombre'],
            'url' => $arrayDoc['url']
        ]);
        return response()->json($patron);
    }

    public function cargarDocumento($request)
    {
        $file = $request->file('documento')->getClientOriginalName();
        $slug = Str::slug(pathinfo($file,PATHINFO_FILENAME));
        $extension = $request->documento->guessExtension();
        $nombreArchivo = $slug.".".$extension;
        $url = 'media/docs/'.$request->header('folder');
        $request->documento->move(public_path($url), $nombreArchivo);
        return [
            'nombre' =>  $nombreArchivo,
            'extension' =>  $extension,
            'url' =>  $url,
        ];
    }

    public function getManuales(Request $request){
        $patron = Patron::with('documents')->where('code', $request['patron'])->first();
        return response()->json($patron);
    }


    #Historial de calibracion --------------------------------------------------------------------------------------------------
    public function patronCalibrationHistory(Patron $patron, $id)
    {
        return view('panel.patrones.calibration-history.form', compact('patron', 'id'));
    }

    public function storeCalibrationHistory(Request $request, $id)
    {
        $historial = new Historycalibration($this->validacionHistorial());

        $patron = Patron::findOrFail($id);
        $patron->historycalibrations()->save($historial);
        $patron->certificate_no = $request['certificate_no'];
        $patron->save();

        return response()->json($historial);
    }

    public function validacionHistorial()
    {
        return request()->validate([
            'certificate_no'   => 'required',
            'calibration'      => 'nullable',
            'next_calibration' => 'nullable',
            'done'             => 'required',
            'obs'              => 'nullable',
        ]);
    }


    #Historial de Mantenimiento ---------------------------------------------------------------------------------------------------
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



    #Patron IDE ---------------------------------------------------------------------------------------------------------------------
    public function unidadesIde()
    {
        $unidades = DB::table('unidad_medidas')->get();
        return response()->json($unidades);
    }

    public function ideForm($id)
    {
        $patron = Patron::with('magnitude', 'procedimientos')->whereId($id)->first();
        return view('panel.patrones.ide.form', compact('patron'));
    }


    #Patron Ensayos ------------------------------------------------------------------------------------------------------------------

    public function ensayoForm($id)
    {
        $patron = Patron::with('magnitude')->whereId($id)->first();
        return view('panel.patrones.ensayos.form', compact('patron'));
    }

    public function ensayoStore(Request $request)
    {
        $ensayo = PatronEnsayo::create($this->validacionEnsayo());
        return response()->json($ensayo);
    }

    public function ensayoEdit($id)
    {
        $ensayo = PatronEnsayo::with('patron.magnitude')->findOrFail($id);
        return view('panel.patrones.ensayos.edit', compact('ensayo'));
    }

    public function ensayoUpdate(Request $request)
    {
        $ensayo = PatronEnsayo::find($request['id']);
        $ensayo->update($this->validacionEnsayo());
        return response()->json($ensayo);
    }

    public function ensayoDestroy($id)
    {
        $ensayo = PatronEnsayo::findOrFail($id);
        $ensayo->delete();
        return response()->json(Response::HTTP_OK);
    }


    public function validacionEnsayo()
    {
        return request()->validate([
            'patron_id'        => 'required',
            'ensayo'           => 'required',
            'unit_measurement' => 'required',
            'rangos'           => 'required',
        ]);
    }



}
