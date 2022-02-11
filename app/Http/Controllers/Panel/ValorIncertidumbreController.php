<?php

namespace App\Http\Controllers\Panel;

use App\Models\Valor;
use Illuminate\Http\Request;
use App\Models\ValorIncertidumbre;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;


class ValorIncertidumbreController extends Controller
{

    public function store(Request $request)
    {
        $valors = Valor::find($request->valor_id);
        $valors->incertidumbres()->createMany($request->incertidumbres);
        return response()->json(Response::HTTP_OK);
    }

    public function getValorIncertidumbre(Request $request){
        $incertidumbre =  ValorIncertidumbre::where('valor_id', $request->id)->get();
        return response()->json($incertidumbre);
    }

    public function eliminarIncertidumbres(Request $request){
        $valor = ValorIncertidumbre::where('valor_id', $request->valor_id)->delete();
        return response()->json($valor, 200);
    }

}
