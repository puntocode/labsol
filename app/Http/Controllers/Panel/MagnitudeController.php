<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Magnitude;
use Illuminate\Http\Request;

class MagnitudeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $magnitudes = Magnitude::orderBy('name')->get();
        if(request()->wantsJson()) return response()->json($magnitudes);
        return view('panel.magnitudes.index', compact('magnitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $magnitud = NULL;
        return view('panel.magnitudes.form', compact('magnitud'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $magnitud = Magnitude::create($this->validateData());
        return response()->json($magnitud);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Magnitude  $magnitude
     * @return \Illuminate\Http\Response
     */
    public function show(Magnitude $magnitude)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Magnitude  $magnitude
     * @return \Illuminate\Http\Response
     */
    public function edit(Magnitude $magnitude)
    {
        $magnitud = Magnitude::find($magnitude->id);
        return view('panel.magnitudes.form', compact('magnitud'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Magnitude  $magnitude
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Magnitude $magnitude)
    {
        $magnitude->update($this->validateData());
        return response()->json($magnitude);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Magnitude  $magnitude
     * @return \Illuminate\Http\Response
     */
    public function destroy(Magnitude $magnitude)
    {
        //
    }


    public function active($id)
    {
        $instrumento = Magnitude::find($id);
        $instrumento->status = $instrumento->status === 'ACTIVO' ? 0 : 1;
        $instrumento->save();
        return response()->json($instrumento->status);
    }


    public function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'condition_type' => 'required',
            'unit_measurement' => 'nullable'
        ]);
    }


}
