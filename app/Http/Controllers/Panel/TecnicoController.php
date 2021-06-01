<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TecnicoController extends Controller
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
        $tecnicos = config('demo.tecnicos');

        return view('panel.tecnicos.index', compact('tecnicos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::user()->hasRole('administrador') === false) abort(403);

        $tecnico = NULL;
        $grupos_tecnicos = config('demo.gruposTecnicos');

        return view('panel.tecnicos.form', compact('tecnico', 'grupos_tecnicos'));
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
        $tecnico = config('demo.tecnicos')[$id];
        $grupos_tecnicos = config('demo.gruposTecnicos');

        return view('panel.tecnicos.form', compact('tecnico', 'grupos_tecnicos', 'view_mode'));
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

        $tecnico = config('demo.tecnicos')[$id];
        $grupos_tecnicos = config('demo.gruposTecnicos');

        return view('panel.tecnicos.form', compact('tecnico', 'grupos_tecnicos'));
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

        return redirect(route('panel.tecnicos.index'));
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
