@extends('layouts.panel')

@section('title')Incertidumbre |@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-8">
            <h3 class="card-label">Incertidumbres <small class="font-weight-lighter">| Listado</small></h3>
            <a href="{{ route('panel.incertidumbre.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear Incertidumbre</a>
        </div>

        <div class="card card-custom">
            <div class="card-header border-0">
                <div class="card-title">
                </div>
                <div class="card-toolbar pt-7">
                    @if (in_array('crear', $role_actions))
                        <!--begin::Button-->
                        <a href="{{ route('panel.incertidumbre.create') }}" class="btn btn-primary font-weight-bolder mb-5">
                            <i class="la la-plus"></i>Crear valor</a>
                        <!--end::Button-->
                    @endif
                </div>
            </div>

            <div class="card-body pt-0">
                <!--begin: Search Form-->
                <form class="mb-15">
                    <div class="input-icon float-left">
                        <input type="text" class="form-control" placeholder="Buscar..." id="tableInpuntSearch">
                        <span>
                            <i class="flaticon2-search-1 icon-md"></i>
                        </span>
                    </div>
                </form>
                <!--end: Search form-->

                <!--begin: Datatable-->
                <table class="table table-separate table-bordered table-head-custom collapsed " id="tableIncertidumbre"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>Contribución</th>
                            <th>Tipo</th>
                            <th>Nombre</th>
                            <th>Distribución</th>
                            <th>Fórmula</th>
                            <th>Fuente</th>
                            <th>Divisor</th>
                            <th>Grados de libertad</th>
                            <th>Coeficiente</th>
                            <th>Contribución</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($incertidumbres as $incertidumbre)
                            <tr>
                                <td>{{ $incertidumbre->contribucion }}</td>
                                <td>{{ $incertidumbre->tipo }}</td>
                                <td>{{ $incertidumbre->nombre }}</td>
                                <td>{{ $incertidumbre->distribucion }}</td>
                                <td><img src="{{ asset("media/formulas/$incertidumbre->formula.jpg") }}" alt="{{ $incertidumbre->formula }}" width='64px'></td>
                                <td>{{ $incertidumbre->fuente }}</td>
                                <td>{{ $incertidumbre->divisor }}</td>
                                <td>{{ $incertidumbre->grados_libertad_for }}</td>
                                <td>{{ $incertidumbre->coeficiente }}</td>
                                <td>{{ $incertidumbre->contribucion_du }}</td>
                                <td nowrap="nowrap">
                                    @if (in_array('ver', $role_actions))
                                        <a href="{{ route('panel.incertidumbre.show', $incertidumbre) }}"
                                            class="btn btn-sm btn-clean btn-icon" title="Ver Incertidumbre">
                                            <i class="fas fa-list text-primary"></i>
                                        </a>
                                    @endif

                                    @if(in_array('editar', $role_actions))
                                        <a href="{{ route('panel.incertidumbre.edit', $incertidumbre) }}"
                                            class="btn btn-sm btn-clean btn-icon" title="Editar Incertidumbre">
                                            <i class="la la-edit"></i>
                                        </a>
                                    @endif

                                    @if (in_array('eliminar', $role_actions))
                                        <a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon"
                                            title="Eliminar valor">
                                            <i class="la la-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('js/pages/crud/datatables/basic/headers.js') }}"></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

    <script>
        $(function() {
            oTable = $('#tableIncertidumbre').DataTable({
                responsive: true,
                "bLengthChange": false
            });

            $('#tableInpuntSearch').keyup(function() {
                oTable.search($(this).val()).draw();
            });
        });
    </script>
@endsection
