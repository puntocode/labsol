<?php

namespace App\Http\Controllers\Panel;

use App\Models\Document;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Procedimiento;
use App\Models\PatronProcedimiento;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;


class ProcedimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *f
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procedimientos = Procedimiento::all();
        if(request()->wantsJson()) return response()->json($procedimientos);
        return view('panel.procedimientos.index', compact('procedimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $procedimiento = null;
        return view('panel.procedimientos.form', compact('procedimiento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $procedimiento = Procedimiento::create($this->validateData());
        $procedimiento->instrumentos()->attach($request->instrumento_id);
        //if($request->has('instrumento_id')) $procedimiento->instrumento()->attach($request->instrumento_id);

        $patrones = $request['patrones'];
        foreach($patrones as $patron){
            $pattern = new PatronProcedimiento;
            $pattern->patron = $patron['patron'];
            $pattern->code = $patron['code'];
            $pattern->procedimiento_id = $procedimiento->id;
            $pattern->save();
        }

        return response()->json($procedimiento);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $procedimiento = Procedimiento::with('patrones', 'ambiental', 'instrumentos')->findOrFail($id);
        return view('panel.procedimientos.show', compact('procedimiento'));
    }

    /**}
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $procedimiento = Procedimiento::with('patrones', 'instrumentos')->find($id);
        return view('panel.procedimientos.form', compact('procedimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Procedimiento $procedimiento)
    {
        $procedimiento->update($this->validateData());
        $procedimiento->instrumentos()->sync($request->instrumento_id);

        $patrones = $request['patrones'];
        foreach($patrones as $patron){
            $pattern = $patron['id'] == 0 ? new PatronProcedimiento : PatronProcedimiento::findOrFail($patron['id']);
            $pattern->patron = $patron['patron'];
            $pattern->code = $patron['code'];
            $pattern->procedimiento_id = $procedimiento->id;
            $pattern->save();
        }

        return response()->json($procedimiento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Procedimiento $procedimiento)
    {
        //
    }


    public function destroyProcedimientoPatron($id)
    {
        $patron = PatronProcedimiento::findOrFail($id);
        $patron->delete();
        return response()->json(Response::HTTP_OK);
    }


    public function getProcedimientoForId($id){
        return response()->json(Procedimiento::find($id));
    }


    public function validateData()
    {
        return request()->validate([
            'code'             => 'required',
            'name'             => 'required',
            'revision'         => 'numeric',
            'validity'         => 'nullable',
            'valve'            => 'nullable',
            'accredited_scope' => 'nullable',
        ]);
    }


    #Documentos ------------------------------------------------------------------------------

    public function documents(Procedimiento $procedimiento)
    {
        return view('panel.procedimientos.doc', compact('procedimiento'));
    }


    public function storeDocument(Request $request, $id)
    {
        $file = $request->file('documento')->getClientOriginalName();
        $extension = $request->documento->guessExtension();
        $slug = Str::slug(pathinfo($file,PATHINFO_FILENAME));
        $nombreArchivo = $slug.".".$extension;
        $url = 'media/docs/procedimientos';

        $request->documento->move(public_path($url), $nombreArchivo);

        $procedimiento = Procedimiento::findOrFail($id);
        $procedimiento->pdf = $nombreArchivo;
        $procedimiento->save();

        return response()->json($procedimiento);
    }

    public function deleteDocument($id){
        $procedimiento = Procedimiento::findOrFail($id);
        $path = public_path()."/media/docs/procedimientos/".$procedimiento->pdf;
        unlink($path);
        $procedimiento->pdf = null;
        $procedimiento->save();
        return response()->json(Response::HTTP_OK);
    }


}
