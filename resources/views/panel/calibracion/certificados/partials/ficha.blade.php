<div class="mt-6 row">
    <div class="col-12 border-bottom border-primary mb-6">
        <h3>1. Solicitante</h3>
    </div>

    <div class="form-group col-md-6">
        <label>Solicitante</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->certificate }}</span>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>RUC</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->certificate_ruc }}</span>
        </div>
    </div>

    <div class="form-group col-md-12">
        <label>Dirección</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->certificate_adress }}</span>
        </div>
    </div>
</div>

<div class="mt-6 row">
    <div class="col-12 border-bottom border-primary mb-6">
        <h3>2. Datos del Equipo Calibrado</h3>
    </div>

    <div class="form-group col-md-6">
        <label>Instrumento</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->instrumentos->name }}</span>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>N° de Serie</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->calibracion->nro_serie }}</span>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>Identificación</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->calibracion->identificacion }}</span>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>Intervalo</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">
                {{"
                    {$expediente->calibracion->intervalo_desde}
                    {$expediente->calibracion->intervalo_medida}
                    a {$expediente->calibracion->intervalo_hasta}
                    {$expediente->calibracion->intervalo_medida}
                "}}
            </span>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>Marca</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->calibracion->marca }}</span>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>{{ $expediente->calibracion->tipo === 'DIGITAL' ? 'Resolución' : 'División' }}</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->calibracion->resolucion }} {{$expediente->calibracion->resolucion_medida }}</span>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>Modelo</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->calibracion->modelo }}</span>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>Tipo</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->calibracion->tipo }}</span>
        </div>
    </div>
</div>

<div class="mt-6 row">
    <div class="col-12 border-bottom border-primary mb-6">
        <h3>3. Patrones utilizados</h3>
    </div>

    <div class="col-10 mx-auto mb-12">
        <table class="table table-bordered table-sm">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="text-center">Identificación</th>
                    <th scope="col" class="text-center">Descripción</th>
                    <th scope="col" class="text-center">Certificado</th>
                    <th scope="col" class="text-center">Próx. Calibración</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patrones as $patron)
                <tr>
                    <td>{{ $patron->code }}</td>
                    <td>{{ $patron->description }}</td>
                    <td>{{ $patron->certificate }}</td>
                    <td>{{ $patron->next_calibration }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6 row">
    <div class="col-12 border-bottom border-primary mb-6">
        <h3>4. Datos de Calibración</h3>
    </div>

    <div class="form-group col-md-6">
        <label>Procedimiento</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->instrumentos->procedimiento[0]->code }}</span>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>Lugar de Calibración</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->calibracion->lugar }}</span>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>Fecha de Calibración Inicial</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->calibracion->fecha_inicio }}</span>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>Fecha de Calibración Final</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->calibracion->fecha_fin }}</span>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>Temperatura Inicial</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->calibracion->temperatura_inicial }} °C</span>
        </div>
    </div>


    <div class="form-group col-md-6">
        <label>Temperatura Final</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->calibracion->temperatura_final }} °C</span>
        </div>
    </div>


    <div class="form-group col-md-6">
        <label>Humedad Relativa Inicial</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->calibracion->humedad_inicial }} %</span>
        </div>
    </div>


    <div class="form-group col-md-6">
        <label>Temperatura Relativa Final</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->calibracion->temperatura_final }} %</span>
        </div>
    </div>

    <div class="form-group col-md-12">
        <label>Observaciones</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->calibracion->obs }}</span>
        </div>
    </div>
</div>

<div class="mt-6 row">
    <div class="col-12 border-bottom border-primary mb-6">
        <h3>5. Registro de Medición</h3>
    </div>

    <div class="col-10 mx-auto">
        <table class="table table-bordered table-sm mb-14">
            <thead class="thead-light">
                <tr>
                    <th class="bg-white"></th>
                    <th scope="col" colspan="4" class="text-center">Indicación del Patrón (IP)</th>
                    <th scope="col" colspan="4" class="text-center">Indicación del Equipo Calibrado (IEC)</th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-active">
                    <td class="bg-white"></td>
                    <td colspan="4" class="text-center">{{ $expediente->calibracion->ip_medida }}</td>
                    <td colspan="4" class="text-center">{{ $expediente->calibracion->unidad_medida }}</td>
                </tr>

                @foreach ($valores as $valor)
                    <tr>
                        <td class="text-center font-bold">{{$valor->patron}}</td>
                        <td class="text-center font-bold">{{ $valor->ip_medida }}</td>
                        <td class="text-center">{{ Helper::numberFormat($valor->ip_valor[0]) }}</td>
                        <td class="text-center">{{ Helper::numberFormat($valor->ip_valor[1]) }}</td>
                        <td class="text-center">{{ Helper::numberFormat($valor->ip_valor[2]) }}</td>
                        <td class="text-center font-bold">{{ $valor->iec_medida }}</td>
                        <td class="text-center">{{ Helper::numberFormat($valor->iec_valor[0]) }}</td>
                        <td class="text-center">{{ Helper::numberFormat($valor->iec_valor[1]) }}</td>
                        <td class="text-center">{{ Helper::numberFormat($valor->iec_valor[2]) }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <table class="table table-bordered table-sm mb-16">
            <thead class="thead-light">
                <tr>
                <th scope="col" class="text-center">IP</th>
                <th scope="col" class="text-center">Des. estandar <br>IP</th>
                <th scope="col" class="text-center">Error Patrón</th>
                <th scope="col" class="text-center">IP Corregido</th>
                <th scope="col" class="text-center">IEC</th>
                <th scope="col" class="text-center">Des. estandar <br>IEC</th>
                <th scope="col" class="text-center">Error</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($valorResultados as $resultado)
                    <tr>
                        <td>{{ Helper::numberFormat($resultado->ip) }} {{ $resultado->unidad }}</td>
                        <td>{{ Helper::numberFormat($resultado->desv_ip) }} {{ $resultado->unidad }}</td>
                        <td>
                            @if ($resultado->error_ip == 'Error')
                                Error
                            @else
                                {{ Helper::numberFormat($resultado->error_ip) }} {{ $resultado->unidad }}
                            @endif
                        </td>
                        <td>{{ Helper::numberFormat($resultado->ip_corregido) }} {{ $resultado->unidad }}</td>
                        <td>{{ Helper::numberFormat($resultado->iec)  }} {{ $resultado->unidad }}</td>
                        <td>{{ Helper::numberFormat($resultado->desv_iec)  }} {{ $resultado->unidad }}</td>
                        <td>{{ Helper::numberFormat($resultado->error_iec)  }} {{ $resultado->unidad }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <ficha-incertidumbre :valores="{{ $valores }}" :procedimiento_id="{{ $expediente->instrumentos->id }}"></ficha-incertidumbre>


</div>


<div class="mt-6 row">
    <div class="col-12 border-bottom border-primary mb-6">
        <h3>6. Resultados</h3>
    </div>

    <div class="col-md-8 mx-auto">
        <h4></h4>
        <table class="table table-bordered table-sm">
            <thead class="thead-light">
                <tr>
                    <th scope="col" colspan="5" class="text-center">{{ $ide->magnitude }} ({{ $valoresCertificado->first()->unidad }})</th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-active">
                    <td class="text-center font-bold">IP ({{ $valoresCertificado->first()->unidad }})</td>
                    <td class="text-center font-bold">IEC ({{ $valoresCertificado->first()->unidad }})</td>
                    <td class="text-center font-bold">E ({{ $valoresCertificado->first()->unidad }})</td>
                    <td class="text-center font-bold">U ({{ $valoresCertificado->first()->unidad }})</td>
                    <td class="text-center font-bold">k</td>
                </tr>

                @foreach ($valoresCertificado as $valor)
                    <tr>
                        <td class="text-center">{{ Helper::numberFormat($valor->ip) }}</td>
                        <td class="text-center">{{ Helper::numberFormat($valor->iec) }}</td>
                        <td class="text-center">{{ Helper::numberFormat($valor->e) }}</td>
                        <td class="text-center">{{ Helper::numberFormat($valor->u) }}</td>
                        <td class="text-center">{{ Helper::numberFormat($valor->k) }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div class="col-md-8 mx-auto">
        <calibracion-grafico
            :valores="{{ $valoresCertificado }}"
            magnitud="{{ $ide->magnitude }}">
        </calibracion-grafico>
    </div>
</div>

<div class="mt-6 row">
    <div class="col-12 border-bottom border-primary mb-6">
        <h3>7. Responsables</h3>
    </div>

    <div class="form-group col-md-6">
        <label>Realizado por</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->calibracion->tecnico->name }} {{ $expediente->calibracion->tecnico->last_name }}</span>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>Autorizado por</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">
                @if (isset($expediente->autorizado_id))
                    {{ $expediente->autorizado->name }} {{ $expediente->autorizado->last_name }}
                @endif
            </span>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label>Observaciones Generales</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $expediente->entradaInstrumentos->obs_general }}</span>
        </div>
    </div>
</div>


