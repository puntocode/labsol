<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EquipoController extends Controller
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
        $equipos = config('demo.equipos');
        return view('panel.equipos.index', compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'laboratorio')) abort(403);

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
        if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'laboratorio')) abort(403);
        $equipos = config('demo.equipos');
        return view('panel.equipos.index', compact('equipos'));
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
      $equipo = config('demo.equipos')[$id];

      return view('panel.equipos.form', compact('equipo', 'view_mode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'laboratorio')) abort(403);

      $equipo = config('demo.equipos')[$id];

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
      if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'laboratorio')) abort(403);

      return redirect(route('panel.equipos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'laboratorio')) abort(403);
    }

    public function historial(){

    }


}
