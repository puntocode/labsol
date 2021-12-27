@extends('layouts.panel')

@section('title')Patrones |@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-8">
            <h3 class="card-label">Patrones <small class="font-weight-lighter">| Listado</small></h3>
            <a href="{{ route('panel.patrones.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear Patrón</a>
        </div>

        <div class="card card-custom">

            <div class="card-header border-0 my-10 d-flex justify-content-between align-items-end">
                <div class="card-title">
                    <form>
                        <div class="input-icon float-left">
                            <input type="text" class="form-control" placeholder="Buscar..." id="tableInpuntSearch">
                            <span>
                                <i class="flaticon2-search-1 icon-md"></i>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="card-toolbar">
                    @include('layouts.partials.extras.dropdown._export_list')
                </div>
            </div>

            <div class="card-body pt-0">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom collapsed" id="tablePatrones" style="width:100%">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Marca</th>
                            <th>Nro. de Certificado</th>
                            <th>Rango/Valor Nominal</th>
                            <th>Presición</th>
                            <th>Error Máximo</th>
                            <th>Periodo de Cal.</th>
                            <th>Última Calibración</th>
                            <th>Prox. Calibración</th>
                            <th>Estado</th>
                            <th>Magnitud</th>
                            <th>Alerta de Cal.</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patrones as $i => $patrone)
                            <tr>
                                <td>{{ $patrone->code }}</td>
                                <td>{{ $patrone->description }}</td>
                                <td>{{ $patrone->brand }}</td>
                                <td>{{ $patrone->certificate_no }}</td>
                                <td>
                                    @if (isset($patrone->precision) && $patrone->rank != null)
                                        @foreach ($patrone->rank as $rank)
                                            {{ $rank }} <br>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if (isset($patrone->precision) && $patrone->rank != null)
                                        @foreach ($patrone->precision as $precision)
                                            <strong>{{ $precision['title'] == 'precision' ? '' : $precision['title']  }}</strong><br>
                                            @foreach ($precision['value'] as $value)
                                                {{ $value }} <br>
                                            @endforeach
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if (isset($patrone->error_max) && $patrone->rank != null)
                                        @foreach ($patrone->error_max as $error)
                                            <strong>{{ $error['title'] == 'error' ? '' : $error['title']  }}</strong><br>
                                            @foreach ($error['value'] as $value)
                                                {{ $value }} <br>
                                            @endforeach
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $patrone->periodo }}</td>
                                <td>{{ $patrone->last_calibration?->toDateString() }}</td>
                                <td>{{ $patrone->next_calibration }}</td>
                                <td><span class="badge badge-primary">{{ $patrone->condition->name }}</span></td>
                                <td><span class="badge badge-info">{{ $patrone->magnitude->name }}</span></td>
                                <td><span class="badge badge-danger">{{ $patrone->alertaCalibracion() }}</span></td>
                                <td>
                                    @can('panel.database')
                                        <a href="{{ route('panel.patrones.show', $patrone) }}" class="btn btn-sm btn-clean btn-icon" title="Ver patrón">
                                            <i class="fas fa-list text-primary"></i>
                                        </a>
                                    @endcan
                                    {{-- @elseif(in_array('editar', $role_actions))
                                        <a href="{{ route('panel.patrones.edit', $i) }}"
                                            class="btn btn-sm btn-clean btn-icon" title="Editar patrón">
                                            <i class="la la-edit"></i>
                                        </a>
                                    @endif

                                    @if (in_array('eliminar', $role_actions))
                                        <a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon"
                                            title="Eliminar patrón">
                                            <i class="la la-trash"></i>
                                        </a>
                                    @endif --}}
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

    <script>
        $(function() {
            // oTable = $('#tablePatrones').DataTable({
            //     "scrollX": true,
            //     "autoWidth": false,
            //     scrollCollapse: true,
            //     fixedColumns: {
            //         leftColumns: 1,
            //         //rightColumns: 1
            //     }

            // }).columns.adjust().draw()

            oTable = $('#tablePatrones').DataTable({
  				responsive: true,
  				"bLengthChange": false
  			});

            $('#tableInpuntSearch').keyup(function() {
                oTable.search($(this).val()).draw();
            });
        });
    </script>
@endsection
