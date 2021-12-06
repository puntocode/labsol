@extends('layouts.panel')

@section('title')Procedimientos |@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <h3 class="mb-8 card-label">Procedimientos <small class="font-weight-lighter">| Ficha</small></h3>
        <div class="row">
            <div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <ul class="px-0 list-unstyled">
                                <li class="mb-5">
                                    <a href="{{ route('panel.procedimientos.index') }}" class="as-text text-hover-primary" title="Ir a listado de procedimientos">
                                        <i class="mr-2 fas fa-arrow-left text-hover-primary"></i>  Ir a listado
                                    </a>
                                    <hr>
                                </li>

                                <li class="mb-5">
                                    <a href="{{ route('panel.procedimientos.create') }}" class="as-text text-hover-primary" title="Crear nuevo procedimiento">
                                        <i class="mr-2 far fa-plus-square text-hover-primary"></i> Crear nuevo
                                    </a>
                                    <hr>
                                </li>

                                <li class="mb-5">
                                    <a href="{{ route('panel.procedimientos.destroy', $procedimiento) }}" class="as-text text-hover-primary" title="Eliminar procedimiento">
                                        <i class="mr-2 fas fa-trash text-hover-primary"></i> Eliminar procedimiento
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-9 col-xl-10">
                <div class="card card-custom mb-5 px-5">

                    <div class="card-header border-0">
                        <div class="card-title pt-8 d-block">
                            <h3 class="card-title font-weight-bolder">Procedimiento {{ $procedimiento->code }}</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-9">
                                <label>Nombre</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $procedimiento->name }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Magnitud</label>
                                <span class="badge badge-info font-weight-bold">
                                    {{ isset($procedimiento->magnitud) ? $procedimiento->magnitud->name : '-' }}
                                </span>
                            </div>
                        </div>
                        <hr>

                        <div class="mt-3 row">
                            <div class="form-group col-md-3">
                                <label>Revisión</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $procedimiento->revision }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Detentor</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $procedimiento->valve }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Vigencia</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $procedimiento->validity }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Alcance Acreditado</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="badge badge-{{$procedimiento->getAlcanceColor() }} font-weight-bold">
                                        {{ $procedimiento->accreditedScope() }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 row">
                            <div class="mb-6 form-group col-md-12">
                                <h3>Instrumentos</h3>
                                <hr>
                            </div>

                            @forelse ($procedimiento->instrumentos as $instrumento)
                                <div class="form-group col-md-3">
                                    <span class="font-weight-bold"><i class="fas fa-thermometer-empty"></i> {{ $instrumento->name }}</span>
                                </div>
                            @empty
                                <div class="col-12">
                                    <span class="font-weight-bold">-- No tiene ningun instrumento --</span>
                                </div>
                            @endforelse
                        </div>


                        <div class="mt-6 row">
                            <div class="mb-6 form-group col-md-12">
                                <h3>Patrones</h3>
                                <hr>
                            </div>

                            @foreach ($procedimiento->patrones as $patron)

                                <div class="form-group col-md-4">
                                    <span class="font-weight-bold text-capitalize">
                                        <i class="far fa-clipboard"></i> {{ $patron->patron }}
                                    </span>
                                </div>

                                <div class="form-group col-md-8">
                                    @if (isset($patron['code']))
                                        @foreach ($patron->code as $codigo)
                                            {{ $codigo }} <span class="mx-2 font-weight-bold">|</span>
                                        @endforeach
                                    @endif
                                </div>

                            @endforeach


                            <div class="form-group col-md-4">
                                <span class="font-weight-bold text-capitalize">
                                    <i class="far fa-clipboard"></i> Equipos de medición ambiental
                                </span>
                            </div>

                            <div class="form-group col-10 col-md-6">
                                @foreach ($procedimiento->ambiental->code as $codigo)
                                    {{ $codigo }} <span class="mx-2 font-weight-bold">|</span>
                                @endforeach
                            </div>

                            <editar-ema :data="{{ $procedimiento->ambiental }}"></editar-ema>
                        </div>

                        <div class="row mt-6">
                            <div class="col-12">
                                <h3>Documento</h3>
                                <hr>
                                @if (isset($procedimiento->pdf))
                                    <a href="{{ $procedimiento->certificadoURL() }}" target="_blank"><i class="fas fa-file mr-3"></i>{{ $procedimiento->pdf }}</a>
                                @else
                                    <p>-- No tiene certificado cargado --</p>
                                @endif
                            </div>

                            @if($procedimiento->accredited_scope)
                                <div class="col-10 mt-4">
                                    <a href="{{ $procedimiento->acreditedScopeURL() }}" target="_blank"><i class="fas fa-file mr-3"></i>Alcance Acreditado</a>
                                </div>
                                <editar-acreditado></editar-acreditado>
                            @endif
                        </div>

                        <div class="mt-6 row">
                            <div class="text-right col-md-12">
                                <hr>
                                <a href="{{ route('panel.procedimientos.edit', $procedimiento->id) }}" class="btn btn-primary">Editar datos</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('rutas')
<script>
    const acreditado = "{{ route('panel.procedimientos.update.acreditado') }}";
    const updateRoute = "{{ route('panel.procedimientos.update.ema') }}";
    const getPatron = "{{ route('panel.patrones.index') }}";
    const getEquipos = "{{ route('panel.equipos.index') }}";

    window.routes = {
        'getEquipos': getEquipos,
        'acreditado': acreditado,
        'getPatron': getPatron,
        'update': updateRoute,
    }
</script>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(function() {
            oTable = $('#tableFacturas, #tableExpedientes').DataTable({
                responsive: true,
                "bLengthChange": false
            });

            $('#tableInpuntSearch').keyup(function() {
                oTable.search($(this).val()).draw();
            });
        });
    </script>
@endsection
