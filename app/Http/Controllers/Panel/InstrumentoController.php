<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Instrumento;
use Illuminate\Http\Request;

class InstrumentoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instrumentos = Instrumento::all();
        if(request()->wantsJson()) return response()->json($instrumentos);
        return view('panel.instrumentos.index', compact('instrumentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $instrumento = NULL;
      return view('panel.instrumentos.form', compact('instrumento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entrada_instrumentos = config('demo.entrada_instrumentos');
        // return view('panel.instrumentos.index', compact('entrada_instrumentos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $view_mode = 'readonly';
      $entrada_instrumento = config('demo.entrada_instrumentos')[$id];
      $tecnicos = config('demo.tecnicos');
        $usuarios = config('demo.usuarios');

      return view('panel.instrumentos.form', compact('entrada_instrumento', 'view_mode', 'tecnicos', 'usuarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $instrumento = Instrumento::find($id);
      return view('panel.instrumentos.form', compact('instrumento'));
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

    //   return redirect(route('panel.instrumentos.index'));
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

    public function active($id)
    {
        $instrumento = Instrumento::find($id);
        $instrumento->status = $instrumento->status === 'ACTIVO' ? 0 : 1;
        $instrumento->save();
        return response()->json($instrumento->status);
    }


    public function getInstrumentos(){
        $instrumentos = Instrumento::all();
        return response()->json($instrumentos);
    }


}
