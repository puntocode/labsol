<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cmc;

class CmcController extends Controller
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
        $cmc = null;
        return view('panel.cmc.form', compact('cmc'));
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
     * @param  \App\Models\Cmc  $cmc
     * @return \Illuminate\Http\Response
     */
    public function show(Cmc $cmc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cmc  $cmc
     * @return \Illuminate\Http\Response
     */
    public function edit(Cmc $cmc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cmc  $cmc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cmc $cmc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cmc  $cmc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cmc $cmc)
    {
        //
    }
}
