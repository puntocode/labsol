<?php

namespace App\Http\Controllers\Panel;

use App\Models\Patron;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Historycalibration;
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
        $documentos = Document::where('document_id', $patrone->id)->where('document_type', 'App\Models\Patron')->get();
        $historyCalibration = Historycalibration::where('historycalibration_id', $patrone->id)->where('historycalibration_type', 'App\Models\Patron')->get();
        return view('panel.patrones.show', compact('patrone', 'documentos', 'historyCalibration'));
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
        ]);
    }

    public function hojaVida($id){
        $patron = Patron::with('magnitude')->whereId($id)->first();
        return view('panel.patrones.hoja-vida', compact('patron'));
    }


    public function historial(){
      return view('panel.historial.index');
    }


    public function getPatronForId($id){
        return response()->json(Patron::find($id));
    }


    public function documents(Patron $patron, $vista)
    {
        dd($vista);
        return view('panel.patrones.doc', compact('patron', 'vista'));
    }


    public function storeDocument(Request $request, $id)
    {
        $file = $request->file('documento')->getClientOriginalName();
        $extension = $request->documento->guessExtension();
        $slug = Str::slug(pathinfo($file,PATHINFO_FILENAME));
        $nombreArchivo = $slug.".".$extension;
        $request->documento->move(public_path('media\docs\patrones'), $nombreArchivo);

        $patron = Patron::findOrFail($id);
        $patron->documents()->create(['extension' => $extension, 'name' => $nombreArchivo]);
        return response()->json($patron);
    }


    public function storeCalibrationHistory(Request $request, $id)
    {
        $patron = Patron::findOrFail($id);
        $patron->historycalibrations()->delete();
        foreach($request->all() as $data){
            $patron->historycalibrations()->create($data);
        }
        return response()->json($patron);
    }


    public function getCalibrationHistory($id){
        $historyCalibration = Historycalibration::where('historycalibration_id', $id)->where('historycalibration_type', 'App\Models\Patron')->get();
        return response()->json($historyCalibration);
    }


}
