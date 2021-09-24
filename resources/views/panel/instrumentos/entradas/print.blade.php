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

    <div id="app">
        <div class="container">
            <section class="row noPrint">
                <div class="col text-center my-10">
                    <a href="{{ route('panel.entrada-instrumentos.show', $entradaInstrumento) }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Ir al Detalle</a>
                    <button type="button" class="btn btn-primary" onclick="imprimir()"><i class="fas fa-print"></i> Imprimir</button>
                </div>
            </section>
           <cabecera-print logo="{{ asset('media/logos/logo_color_large.png') }}"></cabecera-print>
            <section class="my-5">
                @include('layouts.partials.print.entrada-instrumento-details', $entradaInstrumento)
            </section>
        </div>
    </div>


    <script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        //window.print();

        function imprimir(){
            window.print();
        }
    </script>
</body>
</html>







