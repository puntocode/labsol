<?php

namespace App\Http\Controllers\Panel;

use App\Models\Valor;
use Illuminate\Http\Request;
use App\Models\ValorResultado;
use App\Http\Controllers\Controller;

class ValorResultadoController extends Controller
{
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
        $resultado = ValorResultado::create($this->validateData());
        return response()->json($resultado);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ValorResultado  $valorResultado
     * @return \Illuminate\Http\Response
     */
    public function show(ValorResultado $valorResultado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ValorResultado  $valorResultado
     * @return \Illuminate\Http\Response
     */
    public function edit(ValorResultado $valorResultado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ValorResultado  $valorResultado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ValorResultado $valorResultado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ValorResultado  $valorResultado
     * @return \Illuminate\Http\Response
     */
    public function destroy(ValorResultado $valorResultado)
    {
        //
    }


    public function validateData()
    {
        return request()->validate([
            'valor_id'     => 'required',
            'desv_iec'     => 'required',
            'desv_ip'      => 'required',
            'error_iec'    => 'required',
            'error_ip'     => 'required',
            'iec'          => 'required',
            'ip'           => 'required',
            'ip_corregido' => 'required',
            'uk'           => 'required',
            'unidad'       => 'required',
        ]);
    }
}
