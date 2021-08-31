<?php

namespace App\Http\Controllers\Panel;


use App\Models\User;
use App\Models\Cliente;
use App\Models\Instrumento;
use Illuminate\Http\Request;
use App\Models\Procedimiento;
use App\Models\EntradaInstrumento;
use App\Http\Controllers\Controller;
use App\Models\EntradaInstrumentoService;

class EntradaInstrumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entradaInstrumento = EntradaInstrumento::all();
        return view('panel.instrumentos.entradas.index', compact('entradaInstrumento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $data = $this->returnData(null);
        return view('panel.instrumentos.entradas.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entradaInstrumento = EntradaInstrumento::create($this->validateData());
        foreach($request['servicio'] as $servicio){
            EntradaInstrumentoService::create([
                'entrada_instrumento_id' => $entradaInstrumento->id,
                'instrumento_id'         => $servicio['instrumento_id'],
                'quantity'               => $servicio['quantity'],
                'service'                => $servicio['service'],
            ]);
        };
        return response()->json(['data' => $entradaInstrumento], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntradaInstrumento  $entradaInstrumento
     * @return \Illuminate\Http\Response
     */
    public function show(EntradaInstrumento $entradaInstrumento)
    {
        return view('panel.instrumentos.entradas.show', compact('entradaInstrumento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EntradaInstrumento  $entradaInstrumento
     * @return \Illuminate\Http\Response
     */
    public function edit(EntradaInstrumento $entradaInstrumento)
    {
        $data = $this->returnData($entradaInstrumento);
        return view('panel.instrumentos.entradas.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EntradaInstrumento  $entradaInstrumento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntradaInstrumento $entradaInstrumento)
    {
        $entradaInstrumento->update($this->validateData());
        return response()->json(['data' => $entradaInstrumento], 201);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EntradaInstrumento  $entradaInstrumento
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntradaInstrumento $entradaInstrumento)
    {
        //
    }

    /**
     * Imprime los datos del detalle de la entrada de instrumento.
     *
     * @param  \App\Models\EntradaInstrumento  $entradaInstrumento
     * @return \Illuminate\Http\Response
     */
    public function print(EntradaInstrumento $entradaInstrumento)
    {
        return view('panel.instrumentos.entradas.print', compact('entradaInstrumento'));
    }


    public function validateData()
    {
        return request()->validate([
            'certificate'        => 'required',
            'certificate_adress' => 'nullable',
            'certificate_ruc'    => 'nullable',
            'cliente_id'         => 'required',
            'cliente_id'         => 'required',
            'contact'            => 'nullable',
            'delivered'          => 'nullable',
            'identification'     => 'nullable',
            'obs'                => 'nullable',
            'priority'           => 'required|in:NORMAL,URGENTE',
            'type'               => 'required|in:LS,LSI',
            'user_id'            => 'nullable',
        ]);
    }


    public function returnData($entradaInstrumento){
        $data = [
            'usuarios'           => User::all(),
            'clientes'           => Cliente::all(),
            'instrumentos'       => Instrumento::all(),
            // 'procedimientos'     => Procedimiento::all(),
            'entradaInstrumento' => $entradaInstrumento === null ? null : $entradaInstrumento,
            'id'                 => $entradaInstrumento === null ? 0 : $entradaInstrumento->id,
        ];
        return $data;
    }

}
