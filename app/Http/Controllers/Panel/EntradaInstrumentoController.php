<?php

namespace App\Http\Controllers\Panel;


use App\Models\User;
use App\Models\Cliente;
use App\Models\Expediente;
use App\Models\Formulario;
use App\Models\Instrumento;
use Illuminate\Http\Request;
use App\Models\EntradaInstrumento;
use App\Http\Controllers\Controller;
use App\Jobs\EnviarReciboEntradaEgresoJob;
use Illuminate\Support\Facades\Auth;

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
        $servicios = $request['servicio'];
        $entradaInstrumento = EntradaInstrumento::create($this->validateData());

        #-- Creamos los expedientes de acuerdo a la cantidad de servicios---------------------------
        foreach($servicios as $servicio){
            for ($i = 1; $i <= $servicio['quantity']; $i++) {
                $expediente = new Expediente();
                $expediente->certificate = $servicio['certificate'];
                $expediente->certificate_adress = $servicio['certificate_adress'];
                $expediente->certificate_ruc = $servicio['certificate_ruc'];
                $expediente->instrumento_id = $servicio['instrumento_id'];
                $expediente->obs = $servicio['obs'];
                $expediente->priority = $servicio['priority'];
                $expediente->service = $servicio['service'];
                $expediente->type = $entradaInstrumento->type;
                $expediente->entrada_instrumento_id = $entradaInstrumento->id;
                $expediente->save();
            }
        }

        dispatch(new EnviarReciboEntradaEgresoJob($entradaInstrumento));

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
        $entradaInstrumento = $entradaInstrumento->with('cliente', 'user')->findOrFail($entradaInstrumento->id);
        // $expedientesCantidad = Expediente::cantidad($entradaInstrumento->id)->get();
        $expedientes = Expediente::relaciones()->where('entrada_instrumento_id', $entradaInstrumento->id)->get();
        return view('panel.instrumentos.entradas.show', compact('entradaInstrumento', 'expedientes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EntradaInstrumento  $entradaInstrumento
     * @return \Illuminate\Http\Response
     */
    public function edit(EntradaInstrumento $entradaInstrumento)
    {
        $data = [
            'entrada' => $entradaInstrumento->with('cliente', 'user')->first(),
            'expedientes' => Expediente::where('entrada_instrumento_id', $entradaInstrumento->id)->get(),
            'cantidades' =>  Expediente::cantidad($entradaInstrumento->id)->get(),
            'instrumentos' => Instrumento::all(),
        ];
        return view('panel.instrumentos.entradas.edit', compact('data'));
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
        $expedientesIngresados = Expediente::cantidad($entradaInstrumento->id)->get();

        $formulario = Formulario::firstWhere('codigo', 'LS-FOR-047');

        return view('panel.instrumentos.entradas.print', compact('entradaInstrumento', 'expedientesIngresados', 'formulario'));
    }


    public function validateData()
    {
        return request()->validate([
            'cliente_id'     => 'required',
            'contact'        => 'nullable',
            'delivered'      => 'nullable',
            'identification' => 'nullable',
            'type'           => 'required|in:LS,LSI',
            'user_id'        => 'nullable',
            'obs_general'    => 'nullable'
        ]);
    }


    public function returnData($entradaInstrumento){
        $data = [
            'usuario'            => Auth::user(),
            'clientes'           => Cliente::all(),
            'instrumentos'       => Instrumento::all(),
            'entradaInstrumento' => $entradaInstrumento === null ? null : $entradaInstrumento,
            'id'                 => $entradaInstrumento === null ? 0 : $entradaInstrumento->id,
        ];
        return $data;
    }

}
