<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HOJA DE VIDA DEL PATRÓN</title>

    <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') ?? ''}}">

    <style>
        /* latin-ext */
        @font-face {
          font-family: 'Lato';
          font-style: normal;
          font-weight: normal;
          src: url("{{ storage_path('fonts/Lato-Regular.ttf') ?? ''}}");
        }
        /* latin */
        @font-face {
          font-family: 'Lato';
          font-style: normal;
          font-weight: bold;
          src: url("{{ storage_path('fonts/Lato-Bold.ttf') ?? ''}}");
        }
    </style>

    <style>
        @page {
            margin-top: 225px;
            margin-bottom: 60px;
            margin-left: 55px;
            margin-right: 55px;
        }

        body {
            font-family: 'Lato', sans-serif;
            font-weight: normal;
            color: #000;
        }

        .bg-white { background-color: white !important; }

        .text-center { text-align: center; }

        .align-middle { vertical-align:middle !important; }

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

        table {
            border-top: 3px solid white !important;
            table-layout: fixed;
        }

        .table td, .table th {
            border: 3px solid white !important;
            color: #000;
        }

        .table td { background-color: #F3F6F9; }

        .table th { background-color: #E4E6EF; }

        header {
            position: fixed;
            left: 0px;
            top: -185px;
            right: 0px;
            height: 150px;
            text-align: center;
        }

        footer {
            position: fixed;
            left: 0px;
            bottom: -105px;
            right: 0px;
            height: 150px;
        }
    </style>
</head>
<body>
    <script type="text/php">
        if ( isset($pdf) ) {
            $y = $pdf->get_height() - 1063;
            $x = $pdf->get_width() - 132;
            $pdf->page_text($x, $y, "{PAGE_NUM} de {PAGE_COUNT}", 'Lato', 11, array(0,0,0));
        }
    </script>
    <header style="width: 100%; margin-top: 0px; margin-bottom: 10px;">
        <table class="table table-condensed">
            <tbody>
                <tr>
                    <td colspan="2" rowspan="4" style=" text-align:center; vertical-align:middle; background-color: initial;">
                        <img src="{{ public_path('media/logos/logo_color_large.png') ?? ''}}" alt="logo-labsol" >
                    </td>
                    <td colspan="4" rowspan="4" style="text-align:center; vertical-align:middle;">
                        <span style="font-size: 20px; font-weight: bold">HOJA DE VIDA DEL PATRÓN</span>
                    </td>
                    <td class="text-center" style="width: 20px">Código</td>
                    <td>{{ $patron->formulario->codigo }}</td>
                </tr>
                <tr>
                    <td class="text-center">Revisón</td>
                    <td>{{ $patron->formulario->revision }}</td>
                </tr>
                <tr>
                    <td class="text-center">Vigencia</td>
                    <td>{{ $patron->formulario->vigencia }}</td>
                </tr>
                <tr>
                    <td class="text-center">Página</td>
                    <td>&nbsp;</td>
                </tr>
                <tr><td colspan="8" class="bg-white" style="padding: 0">&nbsp;</td></tr>
            </tbody>
        </table>
    </header>

    <footer style="width: 100%;" id="footer">
        <div class="page-footer text-right small pr-10">
            www.labsol.com.py
            <br>
            LABSOL S.A. Tte Jara Troche Nº 346 – Asunción – Paraguay
            <br>
            Tel/Fax +595 21 202 846
        </div>
    </footer>

    <table class="table table-condensed">
        <tbody>
            <tr>
                <th colspan="5">Identificación</th>
                <td colspan="19">{{ $patron->code}}</td>
            </tr>

            <tr>
                <th colspan="5">Descripción</th>
                <td colspan="19">{{ $patron->description }}</td>
            </tr>

            <tr>
                <th colspan="5">Ubicación</th>
                <td colspan="19">{{ $patron->ubication }}</td>
            </tr>

            <tr>
                <th colspan="5">Marca</th>
                <td colspan="19">{{ $patron->brand }}</td>
            </tr>

            <tr>
                <th colspan="5">Modelo *</th>
                <td colspan="19">{{ $patron->model ?? '----------------' }}</td>
            </tr>

            <tr>
                <th colspan="5">Tipo</th>
                <td colspan="19">{{ collect([$patron->type, $patron->type_description])->filter()->join(' - ') }}</td>
            </tr>

            <tr>
                <th colspan="5">No de Serie *</th>
                <td colspan="19">{{ $patron->serie_number ?? '----------------' }}</td>
            </tr>

            <tr>
                <th colspan="5" rowspan="2" class="align-middle">Manual de Usuario</th>
                <th colspan="4" class="text-center">SÍ</th>
                <td colspan="4" class="text-center">{{ $patron->idioma == '-' ? '-' : 'X' }}</td>
                <th colspan="5" rowspan="2" class="text-center align-middle">Idioma del Manual *</th>
                <td colspan="6" rowspan="2" class="text-center align-middle">{{ $patron->idioma == '-' ? '----------------' : $patron->idioma }}</td>
            </tr>

            <tr>
                <th colspan="4" class="text-center">NO</th>
                <td colspan="4" class="text-center">{{ $patron->idioma == '-' ? 'X' : '-' }}</td>
            </tr>

            <tr>
                <th colspan="5">Magnitud de medición</th>
                <td colspan="19">{{ $patron->magnitude->implode('name', ', ') }}</td>
            </tr>

            <tr>
                <th colspan="5" class="align-middle">Precisión</th>
                <td colspan="19">
                    @if ($patron->title == 'EQUIPO')
                        {{ $patron->resolution }}
                    @else
                        @foreach ($patron->precision as $precision)
                            <div>{{ implode(' | ', $precision['value']) }}</div>
                        @endforeach
                    @endif
                </td>
            </tr>

            <tr><td colspan="24" class="bg-white">&nbsp;</td></tr>

            <tr>
                <th colspan="5">Sujeto a calibración</th>
                <td colspan="19">{{ $patron->calibration == 'N/A' ? 'NO' : 'SÍ' }}</td>
            </tr>

            <tr>
                <th colspan="5" rowspan="2" class="align-middle">Calibración</th>
                <th colspan="4" class="text-center">INTERNA</th>
                <td colspan="4" class="text-center">{{ in_array($patron->calibration, ['INTERNA', 'INT/EXT']) ? 'X' : '-' }}</td>
                <th colspan="5" rowspan="2" class="text-center align-middle">Procedimiento de<br>Calibración*</th>
                <td colspan="6" rowspan="2" class="text-center align-middle">{{ $patron->procedimientos->code ?? '----------------' }}</td>
            </tr>

            <tr>
                <th colspan="4" class="text-center">EXTERNA</th>
                <td colspan="4" class="text-center">{{ in_array($patron->calibration, ['EXTERNA', 'INT/EXT']) ? 'X' : '-' }}</td>
            </tr>

            <tr>
                <th colspan="5">Periodo de Calibración*</th>
                <td colspan="19">{{ $patron->periodo == '-' ? '----------------' : $patron->periodo }}</td>
            </tr>

            <tr><td colspan="24" class="bg-white">&nbsp;</td></tr>

            <tr>
                <th colspan="24" class="text-center">HISTORIAL DE CALIBRACIONES O CARACTERIZACIONES</th>
            </tr>

            <tr>
                <th class="text-center">N°</th>
                <th colspan="5" class="text-center">N° Certificado</th>
                <th colspan="4" class="text-center">Fecha de calibración</th>
                <th colspan="4" class="text-center">Próxima calibración *</th>
                <th colspan="5" class="text-center">Realizado por</th>
                <th colspan="5" class="text-center">Observaciones*</th>
            </tr>

            @forelse ($patron->historycalibrations as $calibracion)
                <tr>
                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                    <td colspan="5" class="text-center align-middle">{{ $calibracion->certificate_no }}</td>
                    <td colspan="4" class="text-center align-middle">{{ $calibracion->calibration }}</td>
                    <td colspan="4" class="text-center align-middle">{{ $calibracion->next_calibration ?? '----------------' }}</td>
                    <td colspan="5" class="text-center align-middle">{{ $calibracion->done }}</td>
                    <td colspan="5" class="text-center align-middle">{{ $calibracion->obs ?? '----------------' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="24" class="text-center">----------------</td>
                </tr>
            @endforelse

            <tr>
                <td colspan="24" class="bg-white small"><b>(*) Anular campo si carece de datos</b></td>
            </tr>

            <tr><td colspan="24" class="bg-white">&nbsp;</td></tr>

            <tr>
                <th colspan="24" class="text-center">HISTORIAL DE MANTENIMIENTO Y VERIFICACIONES INTERMEDIAS</th>
            </tr>

            <tr>
                <th class="text-center align-middle">N°</th>
                <th colspan="5" class="text-center align-middle">Descripción del mantenimiento/verificación</th>
                <th colspan="4" class="text-center align-middle">Motivo</th>
                <th colspan="4" class="text-center align-middle">Fecha de realización</th>
                <th colspan="5" class="text-center align-middle">Realizado por</th>
                <th colspan="5" class="text-center align-middle">Observaciones*</th>
            </tr>

            @forelse ($patron->historymaintenances as $mantenimiento)
                <tr>
                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                    <td colspan="5" class="text-center align-middle">{{ $mantenimiento->description }}</td>
                    <td colspan="4" class="text-center align-middle">{{ $mantenimiento->reason }}</td>
                    <td colspan="4" class="text-center align-middle">{{ $mantenimiento->maintenance_date }}</td>
                    <td colspan="5" class="text-center align-middle">{{ $mantenimiento->done }}</td>
                    <td colspan="5" class="text-center align-middle">{{ $mantenimiento->obs ?? '----------------' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="24" class="text-center">----------------</td>
                </tr>
            @endforelse

            <tr>
                <td colspan="24" class="bg-white small"><b>(*) Anular campo si carece de datos</b></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
