<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgendamientoController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $agendamiento = NULL;
        // $instrumentos = config('demo.instrumentos');
        // $tipos_actividades = config('demo.tipos_actividades');
        // $clientes = config('demo.clientesContacto');
        // $tecnicos = config('demo.tecnicos');

        // return view('panel.agenda.agendamientos.form', compact('agendamiento', 'instrumentos', 'tipos_actividades', 'clientes', 'tecnicos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect(route('panel.serviceTickets.agenda'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $agendamiento = config('demo.agendamientos')[$i];
        // $instrumentos = config('demo.instrumentos');
        // $tipos_actividades = config('demo.tipos_actividades');
        // $clientes = config('demo.clientes');
        // $tecnicos = config('demo.tecnicos');
        // $view_mode = 'readonly';

        // return view('panel.agenda.agendamientos.form', compact('agendamiento', 'instrumentos', 'tipos_actividades', 'clientes', 'tecnicos', 'view_mode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // $agendamiento = config('demo.agendamientos')[$i];
        // $instrumentos = config('demo.instrumentos');
        // $tipos_actividades = config('demo.tipos_actividades');
        // $clientes = config('demo.clientes');
        // $tecnicos = config('demo.tecnicos');

        // return view('panel.agenda.agendamientos.form', compact('agendamiento', 'instrumentos', 'tipos_actividades', 'clientes', 'tecnicos'));
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
}
