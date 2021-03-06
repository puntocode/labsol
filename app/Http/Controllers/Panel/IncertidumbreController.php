<?php

namespace App\Http\Controllers\Panel;

use App\Models\Incertidumbre;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\IncertidumbreRequest;

class IncertidumbreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incertidumbres = Incertidumbre::all();
        return view('panel.incertidumbre.index', compact('incertidumbres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $incertidumbre = new Incertidumbre();
        return view('panel.incertidumbre.form', compact('incertidumbre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Panel\IncertidumbreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(IncertidumbreRequest $request)
    {
        $incertidumbre = Incertidumbre::create($request->validated());
        $request->formula_img->move(public_path('media/formulas'), "$incertidumbre->formula.jpg");
        return redirect()->route('panel.incertidumbre.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incertidumbre $incertidumbre
     * @return \Illuminate\Http\Response
     */
    public function show(Incertidumbre $incertidumbre)
    {
        return view('panel.incertidumbre.show', compact('incertidumbre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incertidumbre $incertidumbre
     * @return \Illuminate\Http\Response
     */
    public function edit(Incertidumbre $incertidumbre)
    {
        return view('panel.incertidumbre.form', compact('incertidumbre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Panel\IncertidumbreRequest $request
     * @param  \App\Models\Incertidumbre $incertidumbre
     * @return \Illuminate\Http\Response
     */
    public function update(IncertidumbreRequest $request, Incertidumbre $incertidumbre)
    {
        $oldFormula = $incertidumbre->formula;

        $incertidumbre->update($request->validated());

        if ($request->formula_img) {
            unlink(public_path("media/formulas/$oldFormula.jpg"));
            $request->formula_img->move(public_path('media/formulas'), "$incertidumbre->formula.jpg");
        } else {
            rename(public_path("media/formulas/$oldFormula.jpg"), public_path("media/formulas/$incertidumbre->formula.jpg"));
        }

        return redirect()->route('panel.incertidumbre.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

}
