<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->hasRole('tecnico')){
            $actividades_tecnico = config('demo.actividadesTecnico');

            return view('panel.perfil.actividades.index', compact('actividades_tecnico'));
        }

        #return a listado de actividades de todos los técnicos
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $actividades_tecnico = config('demo.actividadesTecnico');

      return view('panel.perfil.actividades.index', compact('actividades_tecnico'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $actividad = config('demo.actividadesTecnico')[$id];
        $documentos = config('demo.documentos');

        return view('panel.perfil.actividades.form', compact('actividad', 'documentos'));
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
      $actividades_tecnico = config('demo.actividadesTecnico');

      return view('panel.perfil.actividades.index', compact('actividades_tecnico'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
