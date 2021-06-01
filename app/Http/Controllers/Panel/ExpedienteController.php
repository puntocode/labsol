<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
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
        # -- Filtros --
        $tecnicos = config('demo.tecnicos');
        $clientes = config('demo.clientesContacto');

        $expedientes = config('demo.expedientes');
        $estados = config('demo.estados_calibraciones');

        return view('panel.expedientes.index', compact('expedientes', 'tecnicos', 'clientes', 'estados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::user()->hasRole('administrador') === false) abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(404);
        /*if (\Auth::user()->hasRole('administrador') === false) abort(403);
        return redirect(route('panel.expedientes.index'));        */
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
        $expediente = config('demo.expedientes')[$id];
        $tecnicos = config('demo.tecnicos');

        return view('panel.expedientes.form', compact('expediente', 'view_mode', 'tecnicos'));
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

        $expediente = config('demo.expedientes')[$id];
        $tecnicos = config('demo.tecnicos');

        return view('panel.expedientes.form', compact('expediente', 'tecnicos'));
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
        return redirect(route('panel.expedientes.index'));
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

    public function agenda(Request $request){
        $tipos_equipos = config('demo.tipos_equipos');
        $tipos_actividades = config('demo.tipos_actividades');
        $estados_calibraciones = config('demo.estados_calibraciones');
        $expedientes = config('demo.expedientes');

        $vista = isset($request->vista) ? $request->vista : 'agenda';

        if($vista == 'agenda'){
            $eventos = config('demo.eventos');
        }else{
            $eventos = NULL;
        }

        return view('panel.agenda.index', compact('vista', 'eventos', 'tipos_equipos', 'estados_calibraciones', 'tipos_actividades', 'expedientes'));
    }
}
