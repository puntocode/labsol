<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Models\ValorIncertidumbre;
use App\Http\Controllers\Controller;


class ValorIncertidumbreController extends Controller
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
        ValorIncertidumbre::insert($request->all());
        return response()->json($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ValorIncertidumbre  $valorIncertidumbre
     * @return \Illuminate\Http\Response
     */
    public function show(ValorIncertidumbre $valorIncertidumbre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ValorIncertidumbre  $valorIncertidumbre
     * @return \Illuminate\Http\Response
     */
    public function edit(ValorIncertidumbre $valorIncertidumbre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ValorIncertidumbre  $valorIncertidumbre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ValorIncertidumbre $valorIncertidumbre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ValorIncertidumbre  $valorIncertidumbre
     * @return \Illuminate\Http\Response
     */
    public function destroy(ValorIncertidumbre $valorIncertidumbre)
    {
        //
    }
}
