@extends('layouts.base.hoja-vida')

@section('title', 'Entrada Instrumento')
@section('style')
    <style>
        @media print {
        .noPrint{
            display:none;
        }
    }
    </style>
@endsection

@section('content')
    <div class="container">
        <section class="container my-5">
            <div class="row noPrint">
                <div class="col text-center">
                    <a href="{{ route('panel.entrada-instrumentos.show', $entradaInstrumento) }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Ir al Detalle</a>
                    <button type="button" class="btn btn-blue" onclick="imprimir()"><i class="fas fa-print"></i> Imprimir</button>
                </div>
            </div>
        </section>

        <section class="mt-5">
            <div class="row">
                <div class="col text-center">
                    <figure><img src="{{ asset('media/logos/logo_color_large.png') }}" alt="" width="300"></figure>
                    <h1>Entrada de Instrumento</h1>
                </div>
            </div>
        </section>
        <section class="my-5">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles</h3>
                </div>
                @include('layouts.partials.print.entrada-instrumento-details', $entradaInstrumento)
            </div>
        </section>
    </div>
@endsection

@section('rutas')
    <script>
        window.print();

        function imprimir(){
            window.print();
        }
    </script>
@endsection
