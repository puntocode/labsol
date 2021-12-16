<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Models\ValorCertificado;
use App\Http\Controllers\Controller;


class ValorCertificadoController extends Controller
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
        $valores = ValorCertificado::create($this->validateData());
        return response()->json($valores);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ValorCertificado  $valorCertificado
     * @return \Illuminate\Http\Response
     */
    public function show(ValorCertificado $valorCertificado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ValorCertificado  $valorCertificado
     * @return \Illuminate\Http\Response
     */
    public function edit(ValorCertificado $valorCertificado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ValorCertificado  $valorCertificado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ValorCertificado $valorCertificado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ValorCertificado  $valorCertificado
     * @return \Illuminate\Http\Response
     */
    public function destroy(ValorCertificado $valorCertificado)
    {
        //
    }

    public function validateData()
    {
        return request()->validate([
            'e'        => 'required',
            'iec'      => 'required',
            'ip'       => 'required',
            'k'        => 'required',
            'u'        => 'required',
            'unidad'   => 'required',
            'valor_id' => 'required',
        ]);
    }
}
