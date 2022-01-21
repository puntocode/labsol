<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Models\ValorCertificado;
use App\Http\Controllers\Controller;


class ValorCertificadoController extends Controller
{

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



    public function getValoresForValorId(Request $request){
        $valores = ValorCertificado::where('valor_id', $request->valor_id)->first();
        return response()->json($valores);
    }


    public function updateValorCertificado(Request $request){
        $valorCertificado = ValorCertificado::where('valor_id', $request->valor_id)->first();
        $valorCertificado->update($this->validateData());
        return response()->json($valorCertificado);
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
