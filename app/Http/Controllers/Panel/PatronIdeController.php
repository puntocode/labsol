<?php

namespace App\Http\Controllers\Panel;

use App\Models\PatronIde;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IdeRango;

class PatronIdeController extends Controller
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
        $ide = PatronIde::create($this->validateData());
        $rangos = $request['rangos'];
        foreach($rangos as $rango){
            $rank = new IdeRango;
            $rank->rango = $rango['rango'];
            $rank->unidad_medida = $rango['unidad_medida'];
            $rank->patron_ide_id = $ide->id;
            $rank->save();
        }
        return response()->json(['data' => $ide], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PatronIde  $patronIde
     * @return \Illuminate\Http\Response
     */
    public function show(PatronIde $patronIde)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PatronIde  $patronIde
     * @return \Illuminate\Http\Response
     */
    public function edit(PatronIde $patronIde)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PatronIde  $patronIde
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PatronIde $patronIde)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatronIde  $patronIde
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatronIde $patronIde)
    {
        //
    }


    public function validateData()
    {
        return request()->validate([
            'patron_id'        => 'required',
            'magnitude'        => 'required',
            'unit_measurement' => 'required',
        ]);
    }


    public function patronIdeShow($patron_id)
    {
        $ides = PatronIde::with('rangos')->where('patron_id', $patron_id)->get();
        return response()->json($ides);
    }


    //TODO: crear vista calcular derivada
    //TODO: cargar derivada
    //TODO: crear BD derivada
    //TODO: modificar show

}
