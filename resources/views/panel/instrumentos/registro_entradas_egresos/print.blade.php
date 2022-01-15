<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RECEPCIÓN Y RETIRO DE ÍTEMS DE CALIBRACIÓN</title>

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
            margin-top: 200px;
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
            top: -160px;
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
                        <img src="{{ public_path('media/logos/logo_color_large.png') }}" alt="logo-labsol" >
                    </td>
                    <td colspan="4" rowspan="4" style="text-align:center; vertical-align:middle;">
                        <span style="font-size: 20px; font-weight: bold">RECEPCIÓN Y RETIRO DE ÍTEMS DE CALIBRACIÓN</span>
                    </td>
                    <td class="text-center" style="width: 20px">Código</td>
                    <td>LS-FOR-047</td>
                </tr>
                <tr>
                    <td class="text-center">Revisón</td>
                    <td>04</td>
                </tr>
                <tr>
                    <td class="text-center">Vigencia</td>
                    <td>{{ now()->toDateString() }}</td>
                </tr>
                <tr>
                    <td class="text-center">Página</td>
                    <td>&nbsp;</td>
                </tr>
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
            <tr><td colspan="24" class="bg-white">&nbsp;</td></tr>

            <tr>
                <th colspan="24" class="text-center">INFORMACIÓN DEL CLIENTE</th>
            </tr>

            <tr>
                <th colspan="5">SOLICITANTE</th>
                <td colspan="19">{{ $entradaInstrumento->cliente->name }}</td>
            </tr>

            <tr>
                <th colspan="5">DIRECCIÓN</th>
                <td colspan="19">{{ $entradaInstrumento->contact['direccion'] }}</td>
            </tr>

            <tr>
                <th colspan="5">RUC</th>
                <td colspan="8">{{ $entradaInstrumento->cliente->ruc }}</td>
                <th colspan="3">TELÉFONO</th>
                <td colspan="8">{{ $entradaInstrumento->contact['telefono'] }}</td>
            </tr>

            <tr>
                <th colspan="5">CONTACTO</th>
                <td colspan="8">{{ $entradaInstrumento->contact['nombre'] }}</td>
                <th colspan="3">E-MAIL</th>
                <td colspan="8">{{ $entradaInstrumento->contact['email'] }}</td>
            </tr>

            <tr><td colspan="24" class="bg-white">&nbsp;</td></tr>

            <tr>
                <th colspan="5">FECHA DE RECEPCIÓN</th>
                <td colspan="19">{{ date('d/m/Y H:i:s', strtotime($entradaInstrumento->getRawOriginal('created_at'))) }}</td>
            </tr>

            <tr>
                <th colspan="5" class="align-middle">RECIBIDO POR</th>
                <td colspan="9" class="text-center align-middle" style="">{{ $entradaInstrumento->user->fullname }}</td>
                <td colspan="10" style="height: 65px"></td>
            </tr>

            <tr>
                <th colspan="5" rowspan="2" class="align-middle">ENTREGADO POR</th>
                <td colspan="3" class="text-center">Nombre</td>
                <td colspan="6" class="text-center">{{ $entradaInstrumento->delivered }}</td>
                <td colspan="10" rowspan="2">&nbsp;</td>
            </tr>

            <tr>
                <td colspan="3" class="text-center">C.I:</td>
                <td colspan="6" class="text-center">{{ $entradaInstrumento->identification }}</td>
            </tr>

            <tr><td colspan="24" class="bg-white">&nbsp;</td></tr>

            <tr>
                <th colspan="24" class="text-center">CONTROL DE INGRESO DE INSTRUMENTOS</th>
            </tr>

            <tr>
                <th colspan="3" class="text-center">CANTIDAD</th>
                <th colspan="7" class="text-center">INSTRUMENTO</th>
                <th colspan="14" class="text-center">N° DE EXPEDIENTE</th>
            </tr>

            @foreach ($expedientesIngresados as $expediente)
                <tr>
                    <td colspan="3" class="text-center">{{  $expediente->cantidad }}</td>
                    <td colspan="7" class="text-center">{{  $expediente->instrumentos->name }}</td>
                    <td colspan="14" class="text-center">{{ $expediente->abrebiarNumerosConsecutivos() }}</td>
                </tr>
            @endforeach

            <tr><td colspan="24" class="bg-white">&nbsp;</td></tr>

            <tr>
                <th colspan="24" >OBSERVACIÓN:</th>
            </tr>

            <tr>
                <td colspan="24">{{ $entradaInstrumento->obs_general ?? 'Ninguna' }}</td>
            </tr>

            <tr>
                <th colspan="24" class="text-center">PRESENTAR ESTE DOCUMENTO PARA RETIRAR LOS INSTRUMENTOS.</th>
            </tr>

            @foreach ($egresoInstrumentos as $egresoInstrumento)
                <tr><td colspan="24" class="bg-white">&nbsp;</td></tr>
                <tr><td colspan="24" class="bg-white">&nbsp;</td></tr>

                <tr>
                    <th colspan="24" class="text-center">CONTROL DE EGRESO DE INSTRUMENTOS</th>
                </tr>

                <tr>
                    <th colspan="5">TIPO DE RETIRO</th>
                    <td colspan="19" style="text-transform: uppercase;">{{ $egresoInstrumento->tipo_retiro }}</td>
                </tr>

                <tr>
                    <th colspan="5">FECHA DE RETIRO</th>
                    <td colspan="19">{{ $egresoInstrumento->fecha->format('d/m/Y H:i:s') }}</td>
                </tr>

                <tr>
                    <th colspan="3" class="text-center">CANTIDAD</th>
                    <th colspan="7" class="text-center">INSTRUMENTO</th>
                    <th colspan="14" class="text-center">N° DE EXPEDIENTE</th>
                </tr>

                @foreach ($egresoInstrumento->expedientesEgresados as $expediente)
                    <tr>
                        <td colspan="3" class="text-center">{{  $expediente->cantidad }}</td>
                        <td colspan="7" class="text-center">{{  $expediente->instrumentos->name }}</td>
                        <td colspan="14" class="text-center">{{ $expediente->abrebiarNumerosConsecutivos() }}</td>
                    </tr>
                @endforeach

                <tr><td colspan="24" class="bg-white" style="border: 0px withe solid !important;">&nbsp;</td></tr>

                <tr>
                    <td colspan="24" class="bg-white" style="border-top: 0px white solid !important;  border-left: 0 !important; border-right: 0 !important">
                        <table class="table table-condensed">
                            <tbody>
                                <tr>
                                    <th colspan="5" class="align-middle" style="border-left: 0 !important; border-top: 0 !important;">
                                        ENTREGADO POR
                                    </th>
                                    <td colspan="9" class="text-center align-middle" style="border-top: 0 !important;"">{{ $egresoInstrumento->entregadoPor->fullname }}</td>
                                    <td colspan="10" style="height: 65px; border-top: 0 !important; border-right: 0 !important;">&nbsp;</td>
                                </tr>

                                <tr>
                                    <th colspan="5" rowspan="2" class="align-middle" style="border-left: 0 !important; border-bottom: 0 !important;">
                                        RECIBÍ CONFORME
                                    </th>
                                    <td colspan="3" class="text-center">Nombre</td>
                                    <td colspan="6" class="text-center">{{ $egresoInstrumento->recibido_por }}</td>
                                    <td colspan="10" rowspan="2" style="border-right: 0 !important; border-bottom: 0 !imporant;">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td colspan="3" class="text-center" style="border-bottom: 0 !important;">C.I:</td>
                                    <td colspan="6" class="text-center" style="border-bottom: 0 !important;">{{ $egresoInstrumento->identificacion }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
