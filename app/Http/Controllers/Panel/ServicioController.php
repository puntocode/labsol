<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicioController extends Controller
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
        $servicios = config('demo.servicios');
        return view('panel.servicios.index', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'tecnico')) abort(403);

      $servicio = NULL;
      return view('panel.servicios.form', compact('servicio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'tecnico')) abort(403);

      return redirect(route('panel.servicios.index'));
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
      $servicio = config('demo.servicios')[$id];

      return view('panel.servicios.form', compact('servicio', 'view_mode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'tecnico')) abort(403);

      $servicio = config('demo.servicios')[$id];

      return view('panel.servicios.form', compact('servicio'));
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
      if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'tecnico')) abort(403);

      return redirect(route('panel.servicios.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'tecnico')) abort(403);
    }

    public function historial(){

    }


}
