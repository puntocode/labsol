<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Models\CalibracionHistorial;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class CalibracionHistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historial = CalibracionHistorial::all();
        return $historial;
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
        $user = Auth::user();
        if(password_verify($request->pin, $user->password)) {
            $request->request->add(['user_id' => Auth::id()]);
            $historial = CalibracionHistorial::create($this->validateData());
            return response()->json($historial);
        }else{
            return abort(401, 'Pin incorrecto');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CalibracionHistorial  $calibracionHistorial
     * @return \Illuminate\Http\Response
     */
    public function show(CalibracionHistorial $calibracionHistorial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CalibracionHistorial  $calibracionHistorial
     * @return \Illuminate\Http\Response
     */
    public function edit(CalibracionHistorial $calibracionHistorial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CalibracionHistorial  $calibracionHistorial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalibracionHistorial $calibracionHistorial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CalibracionHistorial  $calibracionHistorial
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalibracionHistorial $calibracionHistorial)
    {
        //
    }


    public function validateData()
    {
        return request()->validate([
            'anteriores'     => 'required',
            'nuevos'         => 'required',
            'campo'          => 'required',
            'calibracion_id' => 'required',
            'user_id'        => 'required',
        ]);
    }
}
