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
        return view('panel.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $customer = Cliente::create($request->all());
        return response()->json($customer);
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
      $cliente = Cliente::find($id);
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

        $cliente = Cliente::find($id);

        return view('panel.clientes.edit', compact('cliente'));
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
        $cliente = Cliente::whereId($id)->update([
            'name'    => $request->name,
            'code'    => $request->code,
            'ruc'     => $request->ruc,
            'contact' => $request->contact,
        ]);
        return response()->json($cliente);
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

    public function equipos(){
        $equipos = config('demo.equiposClientes');
        return view('panel.clientes.equipos.index', compact('equipos'));
    }
}
