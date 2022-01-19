<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ValorHistorial;
use Illuminate\Http\Request;

class ValorHistorialController extends Controller
{

    public function getValoresForCalibracion(Request $request)
    {
        $valores = ValorHistorial::where('calibracion_id', $request->calibracion_id)->get();
        return response()->json($valores);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valores = ValorHistorial::create($this->validateData());
        return response()->json($valores);
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
