<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GrupoTecnicoController extends Controller
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
        $grupos_tecnicos = config('demo.gruposTecnicos');

        return view('panel.tecnicos.grupos.index', compact('grupos_tecnicos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::user()->hasRole('administrador') === false) abort(403);
        $grupo_tecnico = NULL;

        return view('panel.tecnicos.grupos.form', compact('grupo_tecnico'));
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
        return redirect(route('panel.tecnicos.grupos.index'));
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
        $grupo_tecnico = config('demo.gruposTecnicos')[$id];

        return view('panel.tecnicos.grupos.form', compact('grupo_tecnico', 'view_mode'));
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
        $grupo_tecnico = config('demo.gruposTecnicos')[$id];

        return view('panel.tecnicos.grupos.form', compact('grupo_tecnico'));
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
        return redirect(route('panel.tecnicos.grupos.index'));
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
}
