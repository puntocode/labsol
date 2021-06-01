<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calidad', 'laboratorio')) abort(403);

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
        if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calidad', 'laboratorio')) abort(403);
        return redirect(route('panel.calibracion.index'));
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calidad', 'laboratorio')) abort(403);
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
        if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calidad', 'laboratorio')) abort(403);
        return redirect(route('panel.calibracion.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calidad', 'laboratorio')) abort(403);
    }

}
