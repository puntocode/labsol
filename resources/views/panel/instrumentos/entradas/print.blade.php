<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entrada de Instrumentos</title>

    <link href="{{asset('plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

        body {
            font-family: 'Lato', sans-serif;
        }

        .table {
            table-layout: fixed;
        }

        .table tr, .table th, .table td {
            border: 3px solid #FFF !important;
        }

        .table th {
            background-color: #E4E6EF !important;
            color: #000;
        }

        .table td {
            background-color: #F3F6F9 !important;
            color: #000;
        }

        @media print {
            .noPrint{
                display:none;
            }

            .table th, .table td {
                padding: 0.5rem;
            }

            .table thead {
                display: table-header-group;
                background: white !important;
            }

            .table tfoot {
                display: table-footer-group;
            }

            .page-header, .page-header-space {
                height: 125px;
                display: block;
                background: white !important;
            }

            .page-footer, .page-footer-space {
                height: 50px;
                display: block;
                background: white !important;
            }

            .page-footer {
                position: fixed;
                bottom: 0;
                width: 100%;
            }

            .page-header {
                position: fixed;
                top: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body class="bg-white">

    <div id="app" class="container">

        <div class="page-header">
            <section class="row noPrint">
                <div class="col text-center my-10">
                    <a href="{{ route('panel.entrada-instrumentos.show', $entradaInstrumento) }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Ir al Detalle</a>
                    <a href="{{ route('panel.entrada-instrumentos.index') }}" class="btn btn-info mx-4"><i class="fas fa-list"></i> Ir a la Lista</a>
                    <button type="button" class="btn btn-primary" onclick="imprimir()"><i class="fas fa-print"></i> Imprimir</button>
                </div>
            </section>

            <section class="row justify-content-center">
                <div class="col-md-2 py-4 mx-0 d-flex align-items-center">
                    <img src="{{ asset('media/logos/logo_color_large.png') }}" alt="logo-labsol" class="img-fluid">
                </div>

                <div class="col-md-6 mx-1 px-0 d-flex justify-content-center align-items-center bg-light">
                    <span class="text-center font-bold w-100 font-size-h4">RECEPCI??N Y RETIRO DE ??TEMS DE CALIBRACI??N</span>
                </div>

                <div class="col-md-1 px-0 mx-1 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-center py-2 bg-light w-100 font-bold">C??digo</span>
                    <span class="text-center py-2 my-2 bg-light w-100 font-bold">Revisi??n</span>
                    <span class="text-center py-2 bg-light w-100 font-bold">Vigencia</span>
                </div>

                <div class="col-md-2 px-0 mx-1 d-flex flex-column justify-content-center align-items-center">
                    <span class="py-2 px-4 bg-light w-100">{{ $formulario->codigo ?? 'LS-FOR-047' }}</span>
                    <span class="py-2 px-4 my-2 bg-light w-100">{{ $formulario->revision ?? '' }}</span>
                    <span class="py-2 px-4 bg-light w-100">{{ $formulario->vigencia ?? '' }}</span>
                </div>
            </section>
        </div>

        <table class="table table-bordered">
            <thead>
               <tr>
                    <td class="page-header-space mb-8 bg-white" colspan="24" style="background: white !important;"></td>
               </tr>
            </thead>

            <tbody>
                <tr>
                    <th colspan="24" class="text-center">INFORMACI??N DEL CLIENTE</th>
                </tr>

                <tr>
                    <th colspan="5">SOLICITANTE</th>
                    <td colspan="19">{{ $entradaInstrumento->cliente->name }}</td>
                </tr>

                <tr>
                    <th colspan="5">DIRECCI??N</th>
                    <td colspan="19">{{ $entradaInstrumento->contact['direccion'] }}</td>
                </tr>

                <tr>
                    <th colspan="5">RUC</th>
                    <td colspan="8">{{ $entradaInstrumento->cliente->ruc }}</td>
                    <th colspan="3">TEL??FONO</th>
                    <td colspan="8">{{ $entradaInstrumento->contact['telefono'] }}</td>
                </tr>

                <tr>
                    <th colspan="5">CONTACTO</th>
                    <td colspan="8">{{ $entradaInstrumento->contact['nombre'] }}</td>
                    <th colspan="3">E-MAIL</th>
                    <td colspan="8">{{ $entradaInstrumento->contact['email'] }}</td>
                </tr>

                <tr><td colspan="24" style="background: white !important">&nbsp;</td></tr>

                <tr>
                    <th colspan="5">FECHA DE RECEPCI??N</th>
                    <td colspan="19">{{ date('d/m/Y - H:i', strtotime($entradaInstrumento->getRawOriginal('created_at'))) }}</td>
                </tr>

                <tr>
                    <th colspan="5" class="align-middle">RECIBIDO POR</th>
                    <td colspan="9" class="text-center align-middle">{{ $entradaInstrumento->user->fullname }}</td>
                    <td colspan="10" class="h-75px"></td>
                </tr>

                <tr>
                    <th colspan="5" rowspan="2" class="align-middle">ENTREGADO POR</th>
                    <td colspan="3" class="text-center">Nombre</td>
                    <td colspan="6" class="text-center">{{ $entradaInstrumento->delivered }}</td>
                    <td colspan="10" rowspan="2"></td>
                </tr>

                <tr>
                    <td colspan="3" class="text-center">C.I:</td>
                    <td colspan="6" class="text-center">{{ $entradaInstrumento->identification }}</td>
                </tr>

                <tr><td colspan="24" style="background: white !important">&nbsp;</td></tr>

                <tr>
                    <th colspan="24" class="text-center">CONTROL DE INGRESO DE INSTRUMENTOS</th>
                </tr>

                <tr>
                    <th colspan="3" class="text-center">CANTIDAD</th>
                    <th colspan="7" class="text-center">INSTRUMENTO</th>
                    <th colspan="14" class="text-center">N?? DE EXPEDIENTE</th>
                </tr>

                @foreach ($expedientesIngresados as $expediente)
                    <tr>
                        <td colspan="3" class="text-center">{{  $expediente->cantidad }}</td>
                        <td colspan="7" class="text-center">{{  $expediente->instrumentos->name }}</td>
                        <td colspan="14" class="text-center">{{ $expediente->abrebiarNumerosConsecutivos() }}</td>
                    </tr>
                @endforeach

                <tr><td colspan="24" style="background: white !important">&nbsp;</td></tr>

                <tr>
                    <th colspan="24" >OBSERVACI??N:</th>
                </tr>

                <tr>
                    <td colspan="24" class="h-100px">{!! $entradaInstrumento->obs_general ?? 'Ninguna' !!}</td>
                </tr>

                <tr>
                    <th colspan="24" class="text-center">PRESENTAR ESTE DOCUMENTO PARA RETIRAR LOS INSTRUMENTOS.</th>
                </tr>

                <tr><td colspan="24" style="background: white !important; height: 100px;"></td></tr>

            </tbody>

            <tfoot>
                <tr>
                    <td class="page-footer-space" colspan="24" style="background: white !important; border: 3px solid rgba(0, 0, 0, 0) !important"></td>
                </tr>
            </tfoot>
        </table>

        <div class="page-footer text-right small pr-10">
            www.labsol.com.py
            <br>
            LABSOL S.A. Tte Jara Troche N?? 346 ??? Asunci??n ??? Paraguay
            <br>
            Tel/Fax +595 21 202 846
        </div>

    </div>


    <script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        function imprimir(){
            window.print();
        }
    </script>
</body>
</html>
