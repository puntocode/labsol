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





}
