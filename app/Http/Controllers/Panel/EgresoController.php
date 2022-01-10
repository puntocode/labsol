<?php

namespace App\Http\Controllers\Panel;

use App\Models\User;
use App\Models\Expediente;
use Illuminate\Http\Request;
use App\Models\EgresoInstrumento;
use App\Models\EntradaInstrumento;
use App\Http\Controllers\Controller;
use App\Models\DetalleEgresoInstrumento;
use App\Http\Requests\Panel\EgresoInstrumentoRequest;

class EgresoController extends Controller
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
        $entradasInstrumentos = EntradaInstrumento::query()
            ->whereHas('egresoInstrumentos')
            ->get();

        return view('panel.egreso.index', compact('entradasInstrumentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($entradaInstrumentoId = request()->entrada_instrumento_id) {
            $entradaInstrumento = EntradaInstrumento::findOrFail($entradaInstrumentoId);

            $expedientes = $entradaInstrumento
                ->expedientes()
                ->porEgresar()
                ->get();

            $usuarios = User::all();

            return view('panel.egreso.form', compact('entradaInstrumento', 'expedientes', 'usuarios'));
        }

        $entradasInstrumentos = EntradaInstrumento::query()
            ->whereHas('expedientes', function ($query) {
                $query->porEgresar();
            })
            ->get();

        return view('panel.egreso.form_entry_list', compact('entradasInstrumentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Panel\EgresoInstrumentoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EgresoInstrumentoRequest $request)
    {
        Expediente::whereIn('id', $request->expedientes)->update(['egresado' => true]);

        $expedientes = Expediente::whereIn('id', $request->expedientes)
            ->with('entradaInstrumentos')
            ->get();

        foreach ($expedientes->pluck('entradaInstrumentos')->unique() as $entradaInstrumento) {
            $tipoRetiro = $entradaInstrumento->expedientes()->porEgresar()->count()
                ? 'parcial #' . $entradaInstrumento->egresoInstrumentos->count() + 1
                : 'total';

            $egresoInstrumento = EgresoInstrumento::create(array_merge(
                $request->validated(),
                [
                    'entrada_instrumento_id' => $entradaInstrumento->id,
                    'tipo_retiro'            => $tipoRetiro,
                ]
            ));

            foreach ($expedientes->where('entrada_instrumento_id', $entradaInstrumento->id) as $expediente) {
                DetalleEgresoInstrumento::create([
                    'expediente_id'         => $expediente->id,
                    'egreso_instrumento_id' => $egresoInstrumento->id
                ]);
            }
        }

        return redirect()->route('panel.egreso.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntradaInstrumento  $entradaInstrumento
     * @return \Illuminate\Http\Response
     */
    public function show(EntradaInstrumento $entradaInstrumento)
    {
        $expedientesIngresados = $entradaInstrumento->expedientes()
            ->with(['instrumentos', 'estados'])
            ->get();

        $entradaInstrumento->load(
            'egresoInstrumentos.entregadoPor',
            'egresoInstrumentos.detalleEgresoInstrumentos.expediente'
        );

        return view('panel.egreso.show', compact(
            'entradaInstrumento',
            'expedientesIngresados'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    /**
     * Imprime el detalle de los egreso de instrumentos de la entrada
     *
     * @param  \App\Models\EntradaInstrumento  $entradaInstrumento
     * @return \Illuminate\Http\Response
     */
    public function print(EntradaInstrumento  $entradaInstrumento)
    {
        $expedientesIngresados = Expediente::cantidad($entradaInstrumento->id)->get();

        $egresoInstrumentos = $entradaInstrumento->egresoInstrumentos
            ->map(function ($egresoInstrumento) use ($entradaInstrumento) {
                $egresoInstrumento->expedientesEgresados = Expediente::cantidad($entradaInstrumento->id)
                    ->whereIn('id', $egresoInstrumento->detalleEgresoInstrumentos->pluck('expediente_id'))
                    ->get();

                return $egresoInstrumento;
            });

        return view('panel.egreso.print', compact(
            'entradaInstrumento',
            'expedientesIngresados',
            'egresoInstrumentos'
        ));
    }

    public function historial(){

    }


}
