<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificado de Calibración</title>

    <link href="{{asset('plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

        body {
            font-family: 'Lato', sans-serif;
        }

        table {
            table-layout: fixed;
        }

        table tr {
            border: 3px solid #FFF;
        }

        .table th {
            background-color: #E4E6EF !important;
            color: #000;
        }

        .table td {
            color: #000;
        }

        .page-content {
            position: relative;
        }

        .watermark {
            opacity: 0.1;
            position: absolute;
        }

        .watermark-center {
          top: 60%;
          left: 50%;
          transform: translate(-50%, -50%) rotate(-10deg);
        }

        .watermark-bottom-left {
          top: 94%;
          left: 13%;
          transform: translate(-50%, -50%);
          width: 25%;
          height: 25%;
        }

        .watermark-bottom-right {
          top: 99%;
          right: -7%;
          transform: translate(-50%, -50%) rotateY(180deg);
          width: 15%;
          height: 15%;
        }

        @media print {
            .noPrint {
                display:none;
            }

            .table th {
                background-color: #E4E6EF !important;
                padding: 0.5rem;
            }

            .table td {
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body class="bg-white">

    <div id="app">
        <div class="container">
            <section class="row noPrint">
                <div class="col text-center my-10">
                    <a href="{{ route('panel.certificados.show', $expediente->id) }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Ir al Detalle</a>
                    <a href="{{ route('panel.certificados.index') }}" class="btn btn-info mx-4"><i class="fas fa-list"></i> Ir a la Lista</a>
                    <button type="button" class="btn btn-primary" onclick="imprimir()"><i class="fas fa-print"></i> Imprimir</button>
                </div>
            </section>

            @include('panel.calibracion.certificados.partials.print.header')
            <div class="page-content">
                <section class="my-5">
                    <table class="table my-0">
                        <tbody>
                            <tr>
                                <th style="width: 155px">1. SOLICITANTE:</th>
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
                                <td colspan="9" class="py-0">&nbsp;</td>
                            </tr>
                            <tr>
                                <th colspan="9">2. DATOS DEL EQUIPO CALIBRADO</th>
                            </tr>
                            <tr>
                                <th>Instrumento:</th>
                                <td colspan="3">{{ $expediente->instrumentos->name }}</td>
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
                                <td colspan="9" class="py-0">&nbsp;</td>
                            </tr>
                            <tr>
                                <th colspan="9">3. PATRONES UTILIZADOS</th>
                            </tr>
                            <tr>
                                <td colspan="9" class="p-0">
                                    <table>
                                        <tbody>
                                            <tr class="border-top-0 border-left-0">
                                                <th style="width: 155px">Identificación:</th>
                                                @foreach ($patrones as $patron)
                                                    <td class="text-center border-top-0">{{ $patron->code }}</td>
                                                @endforeach
                                            </tr>
                                            <tr class="border-left-0">
                                                <th class="align-middle">Descripción:</th>
                                                @foreach ($patrones as $patron)
                                                    <td class="text-center">{{ $patron->description }}</td>
                                                @endforeach
                                            </tr>
                                            <tr class="border-left-0">
                                                <th class="align-middle">Certificado:</th>
                                                @foreach ($patrones as $patron)
                                                    <td class="text-center">{{ $patron->certificate_no }}</td>
                                                @endforeach
                                            </tr>
                                            <tr class="border-bottom-0 border-left-0">
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
                                <td colspan="9" class="py-0">&nbsp;</td>
                            </tr>
                            <tr>
                                <th colspan="3">4. DATOS DE CALIBRACIÓN</th>
                                <th style="background-color: #FFF">&nbsp;</th>
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
                                <th rowspan="2" class="align-middle">Procedimiento/s:</th>
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
                                <td colspan="9" class="py-0">&nbsp;</td>
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
                                        {{ $expediente->autorizado->name }} {{ $expediente->autorizado->last_name }}
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
                </section>

                <img class="watermark watermark-center" src="{{ asset('media/watermarks/certificado-centro.png') }}" alt="Labsol">
                <img class="watermark watermark-bottom-left" src="{{ asset('media/watermarks/certificado-esquina.png') }}" alt="">
                <img class="watermark watermark-bottom-right" src="{{ asset('media/watermarks/certificado-esquina.png') }}" alt="">
            </div>
            @include('panel.calibracion.certificados.partials.print.footer')

            <div style="page-break-after: always; margin-bottom: 2.5rem"></div>

            @include('panel.calibracion.certificados.partials.print.header')
            <div class="page-content">
                <section class="my-5">
                    <table class="table my-0">
                        <tbody>
                            <tr>
                                <th colspan="9">7. RESULTADOS:</th>
                            </tr>
                            <tr>
                                <td colspan="9" class="py-0">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <th colspan="7" class="text-center">{{$ide->magnitude}} ({{ $valoresCertificado->first()->unidad ?? '' }})</th>
                                <td>&nbsp;</td>
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
                                    <div id="div-graph" style="max-width: 830px; height: 600px; margin: 0 auto;"></div>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="9" class="py-0">&nbsp;</td>
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
                            <tr>
                                <td colspan="9" class="py-0">&nbsp;</td>
                            </tr>
                        </tbody>

                    </table>
                </section>

                <img class="watermark watermark-center" src="{{ asset('media/watermarks/certificado-centro.png') }}" alt="Labsol">
                <img class="watermark watermark-bottom-left" src="{{ asset('media/watermarks/certificado-esquina.png') }}" alt="">
                <img class="watermark watermark-bottom-right" src="{{ asset('media/watermarks/certificado-esquina.png') }}" alt="">
            </div>
            @include('panel.calibracion.certificados.partials.print.footer')
        </div>
    </div>

    <script src="https://cdn.plot.ly/plotly-2.6.3.min.js"></script>

    <script>
        function imprimir(){
            window.print();
        }

        document.addEventListener("DOMContentLoaded", function() {

            xAxisTitle = '<b>{{$ide->magnitude}} ({{ $valoresCertificado->first()->unidad ?? '' }})</b>'

            xData = {{ $valoresCertificado->pluck('ip') }}
            yData = {{ $valoresCertificado->pluck('e') }}
            errorYData = {{ $valoresCertificado->pluck('u') }}

            divGraph = document.getElementById('div-graph');

            Plotly.newPlot(
                divGraph,
                [{
                    x: xData,
                    y: yData,
                    error_y: {
                        type: 'data',
                        array: errorYData,
                        visible: true
                    },
                    type: 'scatter',
                    marker: {
                      color: 'rgb(0, 0, 0)',
                    }
                }],
                {
                    xaxis: {
                      title: xAxisTitle,
                    },
                    yaxis: {
                      title: '<b>Error + Incertidumbre</b>',
                    }
                },
                {
                    displayModeBar: false,
                }
            );
        });

    </script>
</body>
</html>
