<?php

namespace App\Http\Controllers\Panel;

use App\Models\IdeRango;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patron;
use App\Models\RangoDeriva;
use Symfony\Component\HttpFoundation\Response;


class IdeRangoController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IdeRango  $ideRango
     * @return \Illuminate\Http\Response
     */
    public function show(IdeRango $ideRango)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IdeRango  $ideRango
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $deriva = IdeRango::with('patronIde.patron', 'rangoDerivas')->whereId($id)->first();
        return view('panel.patrones.ide.deriva', compact('deriva'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IdeRango  $ideRango
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IdeRango $ideRango)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdeRango  $ideRango
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        IdeRango::destroy($id);
        return response()->json(Response::HTTP_OK);
    }


    public function insertDeriva(Request $request){
        $deriva = RangoDeriva::create($this->validateDeriva());
        return response()->json($deriva);
    }

    public function validateDeriva()
    {
        return request()->validate([
            'ip'           => 'required',
            'u'            => 'required',
            'k'            => 'required',
            'uc'           => 'required',
            'e_actual'     => 'required',
            'e_anterior'   => 'nullable',
            'deriva'       => 'required',
            'ide_rango_id' => 'required',
        ]);
    }



}
