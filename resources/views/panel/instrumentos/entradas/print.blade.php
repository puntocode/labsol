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
        @media print {
            .noPrint{
                display:none;
            }
        }
    </style>
</head>
<body class="bg-white">
    <div class="container">
        <section class="row noPrint my-5">
            <div class="col text-center">
                <a href="{{ route('panel.entrada-instrumentos.show', $entradaInstrumento) }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Ir al Detalle</a>
                <button type="button" class="btn btn-light-primary" onclick="imprimir()"><i class="fas fa-print"></i> Imprimir</button>
            </div>
        </section>

        <section class="d-flex my-5">
            <div class="row justify-content-center w-100">
                <div class="col-md-3 py-4 mx-0">
                <img src="{{ asset('media/logos/logo_color_large.png') }}" alt="logo-labsol" class="img-fluid">
                </div>
                <div class="col-md-3 mx-1 px-0 d-flex justify-content-center align-items-center bg-light">
                    <span class="text-center font-bold w-100">RECEPCIÓN DE ITEMS DE CALIBRACIÓN</span>
                </div>
                <div class="col-md-2 px-0 mx-1 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-center py-2 bg-light w-100 font-bold">Código</span>
                    <span class="text-center py-2 my-2 bg-light w-100 font-bold">Revision</span>
                    <span class="text-center py-2 bg-light w-100 font-bold">Vigencia</span>
                </div>
                <div class="col-md-2 px-0 mx-1 d-flex flex-column justify-content-center align-items-center">
                    <span class="text-center py-2 bg-light w-100">{{ $entradaInstrumento->type}}-FOR-047</span>
                    <span class="text-center py-2 my-2 bg-light w-100">-</span>
                    <span class="text-center py-2 bg-light w-100">-</span>
                </div>
            </div>
        </section>

        <section class="my-5">
            @include('layouts.partials.print.entrada-instrumento-details', $entradaInstrumento)
        </section>
    </div>

    <script>
        window.print();

        function imprimir(){
            window.print();
        }
    </script>
</body>
</html>







