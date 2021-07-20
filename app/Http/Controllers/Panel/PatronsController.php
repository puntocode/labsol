<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Magnitude;
use App\Models\Patron;
use App\Models\StatusPattern;
use Illuminate\Http\Request;

class PatronsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patrones = Patron::all();
        // dd($patrones->toArray());
        return view('panel.patrones.index', compact('patrones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statusPattern = StatusPattern::all();
        $magnitudes = Magnitude::all();
        return view('panel.patrones.create', compact('statusPattern','magnitudes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patron = Patron::create($request->all());
        return response()->json($patron);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $patrone = Patron::find($id);
      return view('panel.patrones.show', compact('patrone'));
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
        $patron = Patron::find($id);
    }

    public function historial(){
      return view('panel.historial.index');
    }

    public function StatusPattern(){
        return response()->json(StatusPattern::all());
    }

    public function Magnitudes(){
        return response()->json(Magnitude::all());
    }


}
