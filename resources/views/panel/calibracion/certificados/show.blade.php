@extends('layouts.panel')

@section('title')Certificado de Calibración |@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/partials/partials.css') }}">
    <link rel="stylesheet" href="{{ asset('media/svg/icons/icomoon/style.css') }}">
@endsection


@section('content')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Card-->
        <h3 class="mb-8 card-label">Certificado de Calibración</h3>
        <div class="row">
            <div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <ul class="px-0 list-unstyled">
                                <li class="mb-5">
                                    <a href="{{ route('panel.certificados.index') }}" class="as-text text-hover-primary" title="Ir a listado de clientes">
                                        <i class="fas fa-arrow-left text-hover-primary"></i> Ir a listado
                                    </a>
                                </li>


                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.calibracion.certificados.print', $expediente->id) }}" class="as-text text-hover-primary" title="Imprimir Certificado" target="_blank">
                                        <i class="fas fa-print text-hover-primary"></i> Imprimir
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-xl-10">
                <div class="card card-custom px-5">
                    <div class="card-header border-0">
                        <div class="card-title pt-8 d-block">
                            <h3 class="card-title font-weight-bolder">Expediente {{ $expediente->number }}</h3>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        @include('panel.calibracion.certificados.partials.ficha')

                        <div class="mt-6 mb-18 row">
                            <div class="col-12 border-bottom border-primary mb-6">
                                <h3>Acciones</h3>
                            </div>

                            <estado-calibracion
                                :expediente_id="{{ $expediente->id }}"
                                :estado="{{ $expediente->estados }}">
                            </estado-calibracion>
                        </div>
                    </div>
                </div>
                <!--end::Card-->
            </div>

        </div>
    </div>
@endsection

@section('rutas')
<script>
    const ESTADO_EXPEDIENTE = "{{ route('panel.expedientes.update_estado') }}";
    const RESULT_INCERTIDUMBRE = "{{ route('panel.incertidumbre.resultado') }}";
    const VALOR_INCERTIDUMBRE = "{{ route('panel.incertidumbre.valor') }}";


    window.asset = "{{ URL::asset('')  }}";
    window.user = {{ Auth::user()->id }};
    window.routes = {
        'updateEstado': ESTADO_EXPEDIENTE,
        'resultados': RESULT_INCERTIDUMBRE,
        'incertidumbre': VALOR_INCERTIDUMBRE,
    };

</script>
@endsection






