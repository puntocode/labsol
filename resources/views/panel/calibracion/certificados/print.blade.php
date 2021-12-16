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
                    <a href="#" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Ir al Detalle</a>
                    <a href="{{ route('panel.certificados.index') }}" class="btn btn-info mx-4"><i class="fas fa-list"></i> Ir a la Lista</a>
                    <button type="button" class="btn btn-primary" onclick="imprimir()"><i class="fas fa-print"></i> Imprimir</button>
                </div>
            </section>

            @include('panel.calibracion.certificados.partials.print.header')

            <section class="my-5">
                <table class="table my-0">
                    <tbody>
                        <tr>
                            <th>1. SOLICITANTE:</th>
                            <td colspan="4">{{ $expediente->certificate }}</td>
                        </tr>
                        <tr>
                            <th>Dirección:</th>
                            <td colspan="4">{{ $expediente->certificate_adress }}</td>
                        </tr>
                        <tr>
                            <th>RUC:</th>
                            <td colspan="4">{{ $expediente->certificate_ruc }}</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="py-0">&nbsp;</td>
                        </tr>
                        <tr>
                            <th colspan="5">2. DATOS DEL EQUIPO CALIBRADO</th>
                        </tr>
                        <tr>
                            <th>Instrumento:</th>
                            <td colspan="2">{{ $expediente->instrumentos->name }}</td>
                            <th>N° de Serie:</th>
                            <td>{{ $expediente->calibracion->nro_serie }}</td>
                        </tr>
                        <tr>
                            <th>Identificación:</th>
                            <td  colspan="2">{{ $expediente->calibracion->identificacion }}</td>
                            <th>Intervalo:</th>
                            <td>
                                {{
                                    "{$expediente->calibracion->intervalo_desde} a
                                    {$expediente->calibracion->intervalo_hasta}
                                    {$expediente->calibracion->intervalo_medida}
                                "}}
                            </td>
                        </tr>
                        <tr>
                            <th>Marca:</th>
                            <td colspan="2">{{ $expediente->calibracion->marca }}</td>
                            <th>Resolución:</th>
                            <td>
                                {{"{$expediente->calibracion->resolucion} {$expediente->calibracion->resolucion_medida}"}}
                            </td>
                        </tr>
                        <tr>
                            <th>Modelo:</th>
                            <td colspan="2">{{ $expediente->calibracion->modelo }}</td>
                            <th>Tipo:</th>
                            <td>{{ $expediente->calibracion->tipo }}</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="py-0">&nbsp;</td>
                        </tr>
                        <tr>
                            <th colspan="5">3. PATRONES UTILIZADOS</th>
                        </tr>
                        <tr>
                            <th>Identificación:</th>
                            @foreach ($patrones as $patron)
                                <td>{{ $patron->code }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Descripción:</th>
                            @foreach ($patrones as $patron)
                                <td>{{ $patron->description }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Certificado:</th>
                            @foreach ($patrones as $patron)
                                <td>{{ $patron->certificate }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Próx. Calibración:</th>
                            @foreach ($patrones as $patron)
                                <td>{{ $patron->next_calibration }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td colspan="5" class="py-0">&nbsp;</td>
                        </tr>
                        <tr>
                            <th colspan="2">4. DATOS DE CALIBRACIÓN</th>
                            <th style="background-color: #FFF">&nbsp;</th>
                            <th colspan="2">5. ABREVIATURAS</th>
                        </tr>
                        <tr>
                            <th>Fecha de calibración:</th>
                            <td colspan="2">{{ $expediente->calibracion->fecha_fin }}</td>
                            <th class="text-center">IP:</th>
                            <td>Promedio de indicacion del patrón</td>
                        </tr>
                        <tr>
                            <th>Lugar de calibración:</th>
                            <td colspan="2">{{ $expediente->calibracion->lugar }}</td>
                            <th class="text-center">IEC:</th>
                            <td>Promedio de indicacion del equipo calibrado</td>
                        </tr>
                        <tr>
                            <th>Temperatura:</th>
                            <td colspan="2">{{ $expediente->calibracion->temperatura_final }} °C</td>
                            <th class="text-center">E:</th>
                            <td>Error de medición</td>
                        </tr>
                        <tr>
                            <th>Humedad Relativa:</th>
                            <td colspan="2">{{ $expediente->calibracion->humedad_final }} %</td>
                            <th class="text-center">U:</th>
                            <td>Incertidumbre de medición</td>
                        </tr>
                        <tr>
                            <th rowspan="2" class="align-middle">Procedimiento/s:</th>
                            <td colspan="2">
                                {{ $expediente->instrumentos->procedimiento[0]->code }}
                                Rev.{{ $expediente->instrumentos->procedimiento[0]->revision }}
                            </td>
                            <th class="text-center">k:</th>
                            <td>Factor de cobertura</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="py-0">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <b>Realizado por:</b>
                                {{ $tecnicoRealizador->full_name }}
                            </td>
                            <th colspan="2" style="width: 51%">6. OBSERVACIONES</th>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <b>Código:</b>
                                {{ $tecnicoRealizador->uuid }}
                            </td>
                            <td colspan="2">
                                La incertidumbre expandida de medida informada se expresa como la
                                incertidumbre de medida estándar multiplicado por el factor de cobertura
                                k con una probabilidad correspondiente a aproximadamente del 95%.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <b>Autorizado por:</b>
                            </td>
                            <td colspan="2" rowspan="2" >
                                La incertidumbre típica combinada fue determinada en conformidad con
                                el documento Guía para la Expresión de la incertidumbre en las
                                mediciones (GUM).
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <b>Código:</b>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <td colspan="5" class="text-right">Este documento ha sido firmado digitalmente y tiene validez legal de acuerdo a la Ley 4017/2010</td>
                    </tfoot>
                </table>
            </section>

            @include('panel.calibracion.certificados.partials.print.footer')

        </div>
    </div>

    <script>
        function imprimir(){
            window.print();
        }
    </script>
</body>
</html>
