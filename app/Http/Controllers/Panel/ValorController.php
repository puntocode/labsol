<?php

namespace App\Http\Controllers\Panel;


use App\Models\Valor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ValorController extends Controller
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
        $valores = Valor::create($this->validateData());
        return response()->json($valores);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Valor  $valor
     * @return \Illuminate\Http\Response
     */
    public function show(Valor $valor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Valor  $valor
     * @return \Illuminate\Http\Response
     */
    public function edit(Valor $valor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Valor  $valor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Valor $valor)
    {
        $valor = Valor::whereId($request->valor_id)->first();
        $valor->update($this->validateData());
        return response()->json($valor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Valor  $valor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Valor $valor)
    {
        $valor->delete();
        return response()->json(Response::HTTP_OK);
    }


    public function validateData()
    {
        return request()->validate([
            'iec_medida'     => 'required',
            'iec_valor'      => 'required',
            'ip_medida'      => 'required',
            'ip_valor'       => 'required',
            'patron'         => 'required',
            'calibracion_id' => 'required',
        ]);
    }
}
