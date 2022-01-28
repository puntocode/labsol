<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Instrumento;
use Illuminate\Http\Request;

class InstrumentoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instrumentos = Instrumento::all();
        if(request()->wantsJson()) return response()->json($instrumentos);
        return view('panel.instrumentos.index', compact('instrumentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $instrumento = NULL;
      return view('panel.instrumentos.form', compact('instrumento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $instrumento = Instrumento::create($this->validateData());
        return response()->json($instrumento);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $instrumento = Instrumento::find($id);
      return view('panel.instrumentos.form', compact('instrumento'));
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
        $instrumento = Instrumento::whereId($id)->update($this->validateData());
        return response()->json($instrumento);
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

    public function active($id)
    {
        $instrumento = Instrumento::find($id);
        $instrumento->status = $instrumento->status === 'ACTIVO' ? 0 : 1;
        $instrumento->save();
        return response()->json($instrumento->status);
    }


    public function getInstrumentos(){
        $instrumentos = Instrumento::all();
        return response()->json($instrumentos);
    }


    public function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'costo' => 'required',
            'obs' => 'nullable'
        ]);
    }


}
