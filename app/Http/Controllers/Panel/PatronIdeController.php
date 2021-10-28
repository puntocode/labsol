<?php

namespace App\Http\Controllers\Panel;

use App\Models\Patron;
use App\Models\IdeRango;
use App\Models\PatronIde;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;


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
            $rank->resolucion = $rango['resolucion'];
            $rank->rango_medida = $rango['rango_medida'];
            $rank->resolucion_medida = $rango['resolucion_medida'];
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PatronIde  $patronIde
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patronIde = PatronIde::with('rangos')->find($id);
        $patron = Patron::with('magnitude')->find($patronIde->patron_id);
        return view('panel.patrones.ide.edit', compact('patronIde', 'patron'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PatronIde  $patronIde
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $patronIde = PatronIde::find($id);
        $patronIde->update([ 'magnitude' => $request['magnitude'], 'unit_measurement' => $request['unit_measurement']]);
        $this->insertUpdateRank($request['rangos'], $patronIde->id);
        return response()->json(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatronIde  $patronIde
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patronIde = PatronIde::findOrFail($id);
        $patronIde->delete();
        return response()->json(Response::HTTP_OK);
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
        $ides = PatronIde::with('rangos.rangoDerivas')->where('patron_id', $patron_id)->get();
        if(request()->wantsJson()) return response()->json($ides);
        $patron = Patron::findOrFail($patron_id);
        return view('panel.patrones.ide.show', compact('ides', 'patron'));
    }


    public function insertUpdateRank($rangos, $patronIde_id){
        foreach($rangos as $rango){
            $rank = $rango['id'] == 0 ?  new IdeRango : IdeRango::findOrFail($rango['id']);
            $rank->rango = $rango['rango'];
            $rank->resolucion = $rango['resolucion'];
            $rank->rango_medida = $rango['rango_medida'];
            $rank->resolucion_medida = $rango['resolucion_medida'];
            $rank->patron_ide_id = $patronIde_id;
            $rank->save();
        }
    }


}
