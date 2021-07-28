<?php

namespace App\Http\Controllers\Panel;

use App\Models\Equipo;
use App\Models\Document;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class EquipoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipos = Equipo::all();
        return view('panel.equipos.index', compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $equipo = NULL;
      return view('panel.equipos.form', compact('equipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $equipo = Equipo::create($this->validateData());
        return response()->json($equipo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $equipo = Equipo::findOrFail($id);
      $documentos = Document::where('document_id', $equipo->id)->where('document_type', 'App\Models\Equipo')->get();
      return view('panel.equipos.show', compact('equipo', 'documentos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $equipo = Equipo::findOrFail($id);
      return view('panel.equipos.form', compact('equipo'));
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
        $equipo = Equipo::findOrFail($request->id);
        $equipo->update($this->validateData());
        return response()->json($equipo);
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

    public function historial(){

    }


    public function hojaVida($id){
        $equipo = Equipo::with('magnitude')->whereId($id)->first();
        // dd($equipo->toArray());
        return view('panel.equipos.hoja-vida', compact('equipo'));
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
        ]);
    }


    public function documents(Equipo $equipo)
    {
        return view('panel.equipos.doc', compact('equipo'));
    }


    public function storeDocument(Request $request, $id)
    {
        $file = $request->file('documento')->getClientOriginalName();
        $extension = $request->documento->guessExtension();
        $slug = Str::slug(pathinfo($file,PATHINFO_FILENAME));
        $nombreArchivo = $slug.".".$extension;
        $request->documento->move(public_path('media\docs\equipos'), $nombreArchivo);

        $equipo = Equipo::findOrFail($id);
        $equipo->documents()->create(['extension' => $extension, 'name' => $nombreArchivo]);
        return response()->json($equipo);
    }

}
