<?php

namespace App\Http\Controllers\Panel;

use App\Models\Patron;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;


class PatronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patrones = Patron::all();
        return view('panel.patrones.index', compact('patrones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patrone = null;
        return view('panel.patrones.form', compact('patrone'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patron = Patron::create($this->validateData());
        return response()->json($patron);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patron  $patron
     * @return \Illuminate\Http\Response
     */
    public function show(Patron $patrone)
    {
        return view('panel.patrones.show', compact('patrone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patron  $patron
     * @return \Illuminate\Http\Response
     */
    public function edit(Patron $patrone)
    {
        return view('panel.patrones.form', compact('patrone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patron  $patron
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patron $patron)
    {
        $pattern = Patron::findOrFail($request->id);
        $pattern->update($this->validateData());
        return response()->json(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patron  $patron
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patron $patron)
    {
        //$patron = Patron::find($id);
    }


    public function validateData()
    {
        return request()->validate([
            'code'                 => 'required',
            'description'          => 'required',
            'condition_id'         => 'required',
            'magnitude_id'         => 'required',
            'alert_calibration_id' => 'required',
            'brand'                => 'nullable',
            'certificate_no'       => 'nullable',
            'rank'                 => 'nullable',
            'precision'            => 'nullable',
            'calibration_period'   => 'nullable',
            'error_max'            => 'nullable',
            'last_calibration'     => 'nullable',
            'next_calibration'     => 'nullable',
        ]);
    }

    public function hojaVida($id){
        $patron = Patron::with('magnitude')->whereId($id)->first();
        return view('panel.patrones.hoja-vida', compact('patron'));
    }


    public function historial(){
      return view('panel.historial.index');
    }


    public function getPatronForId($id){
        return response()->json(Patron::find($id));
    }



}
