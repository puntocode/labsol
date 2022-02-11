<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ValorIncertidumbreResultado;



class ValorIncertidumbreResultadoController extends Controller
{

    public function store(Request $request)
    {
        $incerResult = ValorIncertidumbreResultado::create($this->validateData());
        return response()->json($incerResult);
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
