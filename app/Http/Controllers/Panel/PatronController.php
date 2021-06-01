<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatronController extends Controller
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
        $patrones = config('demo.patrones');
        return view('panel.patrones.index', compact('patrones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'laboratorio')) abort(403);

      $patron = NULL;
      return view('panel.patrones.form', compact('patron'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'laboratorio')) abort(403);
        $patrones = config('demo.patrones');
        return view('panel.patrones.index', compact('patrones'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $view_mode = 'readonly';
      $patron = config('demo.patrones')[$id];

      return view('panel.patrones.form', compact('patron', 'view_mode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'laboratorio')) abort(403);

      $patron = config('demo.patrones')[$id];

      return view('panel.patrones.form', compact('patron'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'laboratorio')) abort(403);

      return redirect(route('panel.patrones.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'laboratorio')) abort(403);
    }

    public function historial(){
      return view('panel.historial.index');
    }


}
