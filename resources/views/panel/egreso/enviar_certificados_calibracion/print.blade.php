<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificado de Calibración</title>

    <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}">

    <style>
        /* latin-ext */
        @font-face {
          font-family: 'Lato';
          font-style: normal;
          font-weight: normal;
          src: url("{{ storage_path('fonts/Lato-Regular.ttf') }}");
        }
        /* latin */
        @font-face {
          font-family: 'Lato';
          font-style: normal;
          font-weight: bold;
          src: url("{{ storage_path('fonts/Lato-Bold.ttf') }}");
        }
    </style>

    <style>
        @page {
            margin-left: 55px;
            margin-top: 15px;
            margin-right: 55px;
        }

        body {
            font-family: 'Lato', sans-serif;
            font-weight: normal;
            color: #000;
        }

        .w-100 { width: 100%; }

        .p-0 { padding: 0; }

        .pl-0 { padding-left: 0; }

        .py-0 {
            padding-top: 0;
            padding-bottom: 0;
        }

        .my-0 {
            margin-top: 0;
            margin-bottom: 0;
        }

        table { border-top: 3px solid white !important; }

        .table td, .table th {
            border: 3px solid white !important;
            color: #000;
        }

        .table th {
            font-weight: bold;
            background-color: #E4E6EF;
        }

        .page-content { position: relative; }

        .watermark { position: absolute; }

        .watermark-center {
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-10deg);
        }

        .watermark-bottom-left {
            top: 85%;
            left: 13%;
            transform: translate(-50%, -50%);
            width: 25%;
        }

        .watermark-bottom-right {
            top: 89%;
            right: -7%;
            transform: translate(-50%, -50%);
            width: 15%;
        }
    </style>
</head>
<body>
    @include('panel.egreso.enviar_certificados_calibracion.partials.header')

    <div class="page-content" style="">
        <table class="table my-0 table-condensed">
            <tbody>
                <tr>
                    <th style="width: 155px;">1. SOLICITANTE:</th>
                    <td colspan="8">{{ $expediente->certificate }}</td>
                </tr>
                <tr>
                    <th>Dirección:</th>
                    <td colspan="8">{{ $expediente->certificate_adress }}</td>
                </tr>
                <tr>
                    <th>RUC:</th>
                    <td colspan="8">{{ $expediente->certificate_ruc }}</td>
                </tr>
                <tr>
                    <td colspan="9" class="p-0">&nbsp;</td>
                </tr>
                <tr>
                    <th colspan="9">2. DATOS DEL EQUIPO CALIBRADO</th>
                </tr>
                <tr>
                    <th>Instrumento:</th>
                    <td colspan="3">{{ $expediente->calibracion->instrumento }}</td>
                    <th>N° de Serie:</th>
                    <td colspan="4">{{ $expediente->calibracion->nro_serie }}</td>
                </tr>
                <tr>
                    <th>Identificación:</th>
                    <td  colspan="3">{{ $expediente->calibracion->identificacion }}</td>
                    <th>Intervalo:</th>
                    <td colspan="4">
                        {{ Helper::numberFormat($expediente->calibracion->intervalo_desde) }}
                        {{ $expediente->calibracion->intervalo_medida }}
                        a
                        {{ Helper::numberFormat($expediente->calibracion->intervalo_hasta) }}
                        {{ $expediente->calibracion->intervalo_medida }}
                    </td>
                </tr>
                <tr>
                    <th>Marca:</th>
                    <td colspan="3">{{ $expediente->calibracion->marca }}</td>
                    <th>Resolución:</th>
                    <td colspan="4">
                        {{ Helper::numberFormat($expediente->calibracion->resolucion) }}
                        {{ $expediente->calibracion->resolucion_medida}}
                    </td>
                </tr>
                <tr>
                    <th>Modelo:</th>
                    <td colspan="3">{{ $expediente->calibracion->modelo }}</td>
                    <th>Tipo:</th>
                    <td colspan="4">{{ $expediente->calibracion->tipo }}</td>
                </tr>
                <tr>
                    <td colspan="9" class="p-0">&nbsp;</td>
                </tr>
                <tr>
                    <th colspan="9">3. PATRONES UTILIZADOS</th>
                </tr>
                <tr>
                    <td colspan="9" style="padding: 0">
                        <table class="table table-condensed" style="margin-bottom: 0">
                            <tbody>
                                <tr style="border-top: 0 !important; border-left: 0 !important;">
                                    <th style="width: 155px">Identificación:</th>
                                    @foreach ($patrones as $patron)
                                        <td class="text-center" style="border-top: 0 !important">{{ $patron->code }}</td>
                                    @endforeach
                                </tr>
                                <tr style="border-left: 0 !important;">
                                    <th class="align-middle">Descripción:</th>
                                    @foreach ($patrones as $patron)
                                        <td class="text-center">{{ $patron->description }}</td>
                                    @endforeach
                                </tr>
                                <tr style="border-left: 0 !important;">
                                    <th class="align-middle">Certificado:</th>
                                    @foreach ($patrones as $patron)
                                        <td class="text-center">{{ $patron->certificate_no }}</td>
                                    @endforeach
                                </tr>
                                <tr style="border-bottom: 0 !important; border-left: 0 !important;">
                                    <th>Próx. Calibración:</th>
                                    @foreach ($patrones as $patron)
                                        <td class="text-center">{{ $patron->next_calibration }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="9" class="p-0">&nbsp;</td>
                </tr>
                <tr>
                    <th colspan="3">4. DATOS DE CALIBRACIÓN</th>
                    <th style="background-color: #FFF"></th>
                    <th colspan="5">5. ABREVIATURAS</th>
                </tr>
                <tr>
                    <th>Fecha de calibración:</th>
                    <td colspan="3">{{ $expediente->calibracion->fecha_fin }}</td>
                    <th class="text-center">IP:</th>
                    <td colspan="4">Promedio de indicacion del patrón</td>
                </tr>
                <tr>
                    <th>Lugar de calibración:</th>
                    <td colspan="3">{{ $expediente->calibracion->lugar }}</td>
                    <th class="text-center">IEC:</th>
                    <td colspan="4">Promedio de indicacion del equipo calibrado</td>
                </tr>
                <tr>
                    <th>Temperatura:</th>
                    <td colspan="3">{{ Helper::numberFormat($expediente->calibracion->temperatura_final) }} °C</td>
                    <th class="text-center">E:</th>
                    <td colspan="4">Error de medición</td>
                </tr>
                <tr>
                    <th>Humedad Relativa:</th>
                    <td colspan="3">{{ Helper::numberFormat($expediente->calibracion->humedad_final) }} %</td>
                    <th class="text-center">U:</th>
                    <td colspan="4">Incertidumbre de medición</td>
                </tr>
                <tr>
                    <th rowspan="2" style="vertical-align: middle">Procedimiento/s:</th>
                    <td colspan="3">
                        {{ $expediente->instrumentos->procedimiento[0]->code }}
                        Rev.{{ $expediente->instrumentos->procedimiento[0]->revision }}
                    </td>
                    <th class="text-center">k:</th>
                    <td colspan="4">Factor de cobertura</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="5"></td>
                </tr>
                <tr>
                    <td colspan="9" class="p-0"></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center">
                        <b>Realizado por:</b>
                        {{ $expediente->calibracion->tecnico->name }} {{ $expediente->calibracion->tecnico->last_name }}
                    </td>
                    <th colspan="5">6. OBSERVACIONES</th>
                </tr>
                <tr>
                    <td colspan="4" class="text-center">
                        <b>Código:</b>
                        {{ $expediente->calibracion->tecnico->uuid }}
                    </td>
                    <td colspan="5">
                        La incertidumbre expandida de medida informada se expresa como la
                        incertidumbre de medida estándar multiplicado por el factor de cobertura
                        k con una probabilidad correspondiente a aproximadamente del 95%.
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center">
                        <b>Autorizado por:</b>
                        @if (isset($expediente->autorizado_id))
                            {{ $expediente->autorizado->name }} {{ $expediente->autorizado->last_name }}
                        @else
                            -
                        @endif
                    </td>
                    <td colspan="5" rowspan="2" >
                        La incertidumbre típica combinada fue determinada en conformidad con
                        el documento Guía para la Expresión de la incertidumbre en las
                        mediciones (GUM).
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center">
                        <b>Código:</b>
                        @if (isset($expediente->autorizado_id))
                            {{ $expediente->autorizado->uuid }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <td colspan="9" class="text-right">Este documento ha sido firmado digitalmente y tiene validez legal de acuerdo a la Ley 4017/2010</td>
            </tfoot>
        </table>

        @include('panel.egreso.enviar_certificados_calibracion.partials.watermarks')
    </div>

    @include('panel.egreso.enviar_certificados_calibracion.partials.footer')

    <div style="page-break-after: always; margin-bottom: 2.5rem"></div>

    @include('panel.egreso.enviar_certificados_calibracion.partials.header')

    <div class="page-content">

        <table class="table my-0">
            <tbody>
                <tr>
                    <th colspan="9">7. RESULTADOS:</th>
                </tr>
                <tr>
                    <td colspan="9" class="py-0">&nbsp;</td>
                </tr>
                <tr>
                    <td style="width: 100px">&nbsp;</td>
                    <th colspan="7" class="text-center">{{$ide->magnitude}} ({{ $valoresCertificado->first()->unidad ?? '' }})</th>
                    <td style="width: 100px">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="9" class="py-0">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                    <th class="text-center border-left">IP ({{ $valoresCertificado->first()->unidad ?? '' }})</th>
                    <th class="text-center border-left">IEC ({{ $valoresCertificado->first()->unidad ?? '' }})</th>
                    <th class="text-center border-left">E ({{ $valoresCertificado->first()->unidad ?? '' }})</th>
                    <th class="text-center border-left">U ({{ $valoresCertificado->first()->unidad ?? '' }})</th>
                    <th class="text-center border-left">k</th>
                    <td colspan="2">&nbsp;</td>
                </tr>
                @foreach ($valoresCertificado as $valorCertificado)
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td class="text-center">{{ Helper::numberFormat($valorCertificado->ip) }}</td>
                        <td class="text-center">{{ Helper::numberFormat($valorCertificado->iec) }}</td>
                        <td class="text-center">{{ Helper::numberFormat($valorCertificado->e) }}</td>
                        <td class="text-center">{{ Helper::numberFormat($valorCertificado->u) }}</td>
                        <td class="text-center">{{ Helper::numberFormat($valorCertificado->k) }}</td>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="9" class="py-0">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <th colspan="7" class="text-center">RESULTADO GRÁFICO DE LA CALIBRACIÓN</th>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="7" class="">
                        <div id="div-graph" style="max-width: 830px; height: 430px; overflow: hidden;;">
                            <img src="{{ $srcGrafica }}" alt="Gráfica">
                        </div>
                    </td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="9" class="py-0"></td>
                </tr>
                <tr>
                    <th colspan="3">8. FECHA DE EMISIÓN DEL CERTIFICADO:</th>
                    <td colspan="6">{{ now()->toDateString() }}</td>
                </tr>
                <tr>
                    <td colspan="9" class="py-0">&nbsp;</td>
                </tr>
                <tr>
                    <th colspan="9" class="text-center">--- FIN DEL CERTIFICADO ---</th>
                </tr>
            </tbody>

        </table>

        @include('panel.egreso.enviar_certificados_calibracion.partials.watermarks')
    </div>

    @include('panel.egreso.enviar_certificados_calibracion.partials.footer')
</body>
</html>
