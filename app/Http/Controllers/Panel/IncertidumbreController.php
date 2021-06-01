<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $incertidumbre = config('demo.incertidumbre');
        return view('panel.incertidumbre.index', compact('incertidumbre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (\Auth::user()->hasAnyRole('secretaria', 'jefatura_calibracion', 'laboratorio')) abort(403);

      $incertidumbre = NULL;
      return view('panel.incertidumbre.form', compact('incertidumbre'));
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
        $incertidumbre = config('demo.incertidumbre');
        return view('panel.incertidumbre.index', compact('incertidumbre'));
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
      $incertidumbre = config('demo.incertidumbre')[$id];

      return view('panel.incertidumbre.form', compact('incertidumbre', 'view_mode'));
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

      $incertidumbre = config('demo.incertidumbre')[$id];

      return view('panel.incertidumbre.form', compact('incertidumbre'));
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

      return redirect(route('panel.incertidumbre.index'));
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

}
