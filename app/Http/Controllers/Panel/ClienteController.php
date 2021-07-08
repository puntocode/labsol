<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $clientes = Cliente::all();
        return view('panel.clientes.index', compact('clientes'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'laboratorio')) abort(403);

        $cliente = NULL;

        return view('panel.clientes.form', compact('cliente'));
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
        $clientes = config('demo.clientesContacto');
        return view('panel.clientes.index', compact('clientes'));
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
        $cliente = config('demo.clientesContacto')[$id];

        return view('panel.clientes.form', compact('cliente', 'view_mode'));
    }

    public function ficha($id){
      $cliente = config('demo.clientesContacto')[$id];
      $facturas = config('demo.facturas');
      $expedientes = config('demo.expedientes');

      return view('panel.clientes.ficha', compact('cliente', 'facturas', 'expedientes'));
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

        $cliente = config('demo.clientesContacto')[$id];

        return view('panel.clientes.form', compact('cliente'));
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

        return redirect(route('panel.clientes.index'));
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

    public function equipos(){
        $equipos = config('demo.equiposClientes');

        return view('panel.clientes.equipos.index', compact('equipos'));
    }
}
