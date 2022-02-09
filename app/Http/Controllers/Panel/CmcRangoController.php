<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\CmcRango;
use App\Models\Patron;
use Illuminate\Http\Request;

class CmcRangoController extends Controller
{

    public function getCmcs(Request $request)
    {
        $cmcs = CmcRango::where('procedimiento_id', $request->procedimiento_id)->where('patron_code', $request->patron_code)->get();
        return response()->json($cmcs);
    }

    public function store(Request $request){
        $patron = Patron::where('code', $request->patron_code)->firstOrFail();
        $request->request->add(['patron_id' => $patron->id]);
        $cmc = CmcRango::create($this->validateData());
        return response()->json(['cmc' => $cmc], 201);
    }

    public function update(Request $request){

    }

    public function validateData()
    {
        return request()->validate([
            'cmc' => 'required',
            'rango_a' => 'required',
            'rango_de' => 'required',
            'patron_id' => 'required',
            'cmc_unidad' => 'required',
            'patron_code' => 'required',
            'rango_unidad' => 'required',
            'patron_medida' => 'required',
            'procedimiento_id' => 'required',
        ]);
    }

}
