<?php

namespace App\Http\Controllers\Panel;

use App\Models\Procedimiento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ProcedimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *f
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procedimientos = Procedimiento::all();
        return view('panel.procedimientos.index', compact('procedimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $procedimiento = null;
        return view('panel.procedimientos.form', compact('procedimiento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $procedimiento = Procedimiento::create($this->validateData());
        return response()->json($procedimiento);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Procedimiento $procedimiento)
    {
        return view('panel.procedimientos.show', compact('procedimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Procedimiento $procedimiento)
    {
        return view('panel.procedimientos.form', compact('procedimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Procedimiento $procedimiento)
    {
        $procedimiento->update($this->validateData());
        return response()->json($procedimiento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Procedimiento  $procedimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Procedimiento $procedimiento)
    {
        //
    }


    public function getProcedimientoForId($id){
        return response()->json(Procedimiento::find($id));
    }

    public function validateData()
    {
        return request()->validate([
            'code'             => 'required',
            'name'             => 'required',
            'revision'         => 'numeric',
            'validity'         => 'nullable',
            'valve'            => 'nullable',
            'accredited_scope' => 'nullable',
            'pdf'              => 'nullable',
        ]);
    }
}
