<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EgresoController extends Controller
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
        $salida_instrumentos = config('demo.salida_instrumentos');
        return view('panel.egreso.index', compact('salida_instrumentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (\Auth::user()->hasRole('administrador') === false) abort(403);

      $salida_instrumento = NULL;
      $tecnicos = config('demo.tecnicos');
      $expedientes = config('demo.expedientes');

      return view('panel.egreso.form', compact('salida_instrumento', 'tecnicos', 'expedientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Auth::user()->hasRole('administrador') === false) abort(403);
        $salida_instrumentos = config('demo.salida_instrumentos');
        return view('panel.egreso.index', compact('salida_instrumentos'));
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
      $salida_instrumento = config('demo.salida_instrumentos')[$id];
      $tecnicos = config('demo.tecnicos');

      return view('panel.egreso.form', compact('salida_instrumento', 'view_mode', 'tecnicos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (\Auth::user()->hasRole('administrador') === false) abort(403);

      $salida_instrumento = config('demo.salida_instrumentos')[$id];
      $tecnicos = config('demo.tecnicos');

      return view('panel.egreso.form', compact('salida_instrumento', 'tecnicos'));
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
      if (\Auth::user()->hasRole('administrador') === false) abort(403);

      return redirect(route('panel.egreso.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Auth::user()->hasRole('administrador') === false) abort(403);
    }

    public function historial(){

    }


}
