<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Support\Str;
use App\Models\Procedimiento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Document;


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
        if($request->has('patron_id')) $procedimiento->patron()->attach($request->patron_id);
        if($request->has('instrumento_id')) $procedimiento->instrumento()->attach($request->instrumento_id);
        return response()->json($procedimiento);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Procedimiento $procedimiento)
    {
        $documentos = Document::where('document_id', $procedimiento->id)->where('document_type', 'App\Models\Procedimiento')->get();
        return view('panel.procedimientos.show', compact('procedimiento', 'documentos'));
    }

    /**}
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Procedimiento $procedimiento)
    {
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
        if($request->has('patron_id')){
            $procedimiento->patron()->detach();
            $procedimiento->patron()->attach($request->patron_id);
        }

        if($request->has('instrumento_id')){
            $procedimiento->instrumento()->detach();
            $procedimiento->instrumento()->attach($request->instrumento_id);
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
            'pdf'              => 'nullable',
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
        $url = 'media/docs/'.$request->header('folder');

        $request->documento->move(public_path($url), $nombreArchivo);

        $procedimiento = Procedimiento::findOrFail($id);
        $procedimiento->documents()->create([
            'extension' => $extension,
            'name' => $nombreArchivo,
            'category' => $request->header('category'),
            'url' => $url
        ]);
        return response()->json($procedimiento);
    }


}
