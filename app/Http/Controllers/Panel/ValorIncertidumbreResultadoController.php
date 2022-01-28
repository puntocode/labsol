<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ValorIncertidumbreResultado;


class ValorIncertidumbreResultadoController extends Controller
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
        $valores = ValorIncertidumbreResultado::create($this->validateData());
        return response()->json($valores);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ValorIncertidumbreResultado  $valorIncertidumbreResultado
     * @return \Illuminate\Http\Response
     */
    public function show(ValorIncertidumbreResultado $valorIncertidumbreResultado)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ValorIncertidumbreResultado  $valorIncertidumbreResultado
     * @return \Illuminate\Http\Response
     */
    public function edit(ValorIncertidumbreResultado $valorIncertidumbreResultado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ValorIncertidumbreResultado  $valorIncertidumbreResultado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ValorIncertidumbreResultado $valorIncertidumbreResultado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ValorIncertidumbreResultado  $valorIncertidumbreResultado
     * @return \Illuminate\Http\Response
     */
    public function destroy(ValorIncertidumbreResultado $valorIncertidumbreResultado)
    {
        //
    }


    public function updateIncertidumbreResultado(Request $request){
        $incerResult = ValorIncertidumbreResultado::where('valor_id', $request->valor_id)->first();
        $incerResult->update($this->validateData());
        return response()->json($incerResult);
    }


    public function getResultado(Request $request){
        $resultado =  ValorIncertidumbreResultado::where('valor_id', $request->id)->first();
        return response()->json($resultado);
    }


    public function validateData()
    {
        return request()->validate([
            'g_libertad_efectivos'    => 'required',
            'incertidumbre_combinada' => 'required',
            'incertidumbre_expandida' => 'required',
            'ip'                      => 'required',
            'k'                       => 'required',
            'patron'                  => 'required',
            'potencia'                => 'required',
            'unidad'                  => 'required',
            'valor_id'                => 'required',
        ]);
    }
}
