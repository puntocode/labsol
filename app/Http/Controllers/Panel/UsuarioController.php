<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsuarioController extends Controller
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
        $usuarios = config('demo.usuarios');
        return view('panel.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'laboratorio')) abort(403);

      $usuario = NULL;
      return view('panel.usuarios.form', compact('usuario'));
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
        $usuarios = config('demo.usuarios');
        return view('panel.usuarios.index', compact('usuarios'));
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
      $usuario = config('demo.usuarios')[$id];

      return view('panel.usuarios.form', compact('usuario', 'view_mode'));
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

      $usuario = config('demo.usuarios')[$id];

      return view('panel.usuarios.form', compact('usuario'));
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

      return redirect(route('panel.usuarios.index'));
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
