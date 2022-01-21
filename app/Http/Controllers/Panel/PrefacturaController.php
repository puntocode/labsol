<?php

namespace App\Http\Controllers\Panel;

use App\Models\Cliente;
use App\Models\Expediente;
use App\Models\Prefactura;
use App\Models\ExpedienteEstado;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\AlmacenarPrefacturaRequest;
use App\Http\Requests\Panel\ActualizarPrefacturaRequest;

class PrefacturaController extends Controller
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
        $prefacturas = Prefactura::query()
            ->where('cerrada', true)
            ->get();

        return view('panel.facturas.prefacturas.index', compact('prefacturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($clienteId = request()->cliente_id) {
            $cliente = Cliente::findOrFail($clienteId);

            $expedientes = $cliente
                ->expedientes()
                ->whereHas('estados', function ($query) {
                    $query->where('name', 'APROBADA');
                })
                ->get();

            return view('panel.facturas.prefacturas.create', compact('cliente', 'expedientes'));
        }

        $clientes = Cliente::query()
            ->whereHas('expedientes', function ($query) {
                $query->whereHas('estados', function ($estadosQuery) {
                    $estadosQuery->where('name', 'APROBADA');
                });
            })
            ->orWhereHas('prefacturas', function ($query) {
                $query->where('cerrada', false);
            })
            ->with('expedientes', function ($query) {
                $query->whereHas('estados', function ($estadosQuery) {
                    $estadosQuery->where('name', 'APROBADA');
                });
            })
            ->with('prefacturas', function ($query) {
                $query->where('cerrada', false);
            })
            ->get();

        return view('panel.facturas.prefacturas.clientes', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Panel\AlmacenarPrefacturaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlmacenarPrefacturaRequest $request)
    {
        $cliente = Cliente::query()->findOrFail($request->cliente_id);

        $prefactura = $cliente->prefacturas()->firstOrCreate(['cerrada' => false]);

        $expedientes = Expediente::query()
            ->with('instrumentos')
            ->whereIn('id', $request->expedientes)
            ->get();

        $detalles = [];

        foreach ($expedientes as $expediente) {
            $detalles[] = [
                'expediente_id' => $expediente->id  ,
                'costo'         => $expediente->instrumentos->costo
            ];
        }

        $prefactura->prefacturaDetalles()->createMany($detalles);

        $prefactura->update(['total' => $expedientes->pluck('instrumentos')->flatten()->sum('costo')]);

        $estado = ExpedienteEstado::firstWhere('name', 'PREFACTURADO');

        $expedientes->each->cambiarEstado($estado->id, 'Se ha agregado a la planilla de liquidación.');

        return redirect()->route('panel.facturas.prefacturas.edit', $prefactura);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prefactura  $prefactura
     * @return \Illuminate\Http\Response
     */
    public function show(Prefactura $prefactura)
    {
        $prefactura->load([
            'prefacturaDetalles.expediente.instrumentos',
            'prefacturaDetalles.expediente.calibracion'
        ]);

        return view('panel.facturas.prefacturas.show', compact('prefactura'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prefactura  $prefactura
     * @return \Illuminate\Http\Response
     */
    public function edit(Prefactura $prefactura)
    {
        if ($prefactura->cerrada) {
            abort(404);
        }

        $prefactura->load([
            'prefacturaDetalles.expediente.instrumentos',
            'prefacturaDetalles.expediente.calibracion'
        ]);

        return view('panel.facturas.prefacturas.edit', compact('prefactura'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Panel\ActualizarPrefacturaRequest  $request
     * @param  \App\Models\Prefactura  $prefactura
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarPrefacturaRequest $request, Prefactura $prefactura)
    {
        $data = $request->validated();

        $prefactura->load('prefacturaDetalles.expediente.instrumentos');

        foreach ($prefactura->prefacturaDetalles as $prefacturaDetalle) {
            $prefacturaDetalle->update($data['prefacturaDetalles'][$prefacturaDetalle->id]);
        }

        $prefactura->update($data);

        if ($prefactura->cerrada) {
            $estado = ExpedienteEstado::firstWhere('name', 'FACTURADA');

            $prefactura->prefacturaDetalles
                ->pluck('expediente')
                ->flatten()
                ->each
                ->cambiarEstado($estado->id, 'Se ha agregado a la planilla de liquidación.');
        }

        return redirect()->route('panel.facturas.prefacturas.index');
    }
}
