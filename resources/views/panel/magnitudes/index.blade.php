@extends('layouts.panel')

@section('title')Magnitudes |@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Card-->
        <h3 class="card-label d-flex justify-content-between mb-8">
            <span>Magnitudes <small class="font-weight-lighter">| Listado</small></span>
            <a href="{{ route('panel.magnitudes.create') }}" class="btn btn-primary">Crear Magnitud</a>
        </h3>

        <div class="card card-custom">
            <div class="card-header border-0 mb-10 d-flex justify-content-between align-items-end">
                <div class="card-title">
                    <form>
                        <div class="input-icon float-left">
                            <input type="text" class="form-control" placeholder="Buscar..." id="tableInpuntSearch">
                            <span><i class="flaticon2-search-1 icon-md"></i></span>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body pt-0">

                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom collapsed" id="table" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Magnitud</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Unidad de Medida</th>
                            <th scope="col">Estado</th>
                            <th scope="col" class="text-center">Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($magnitudes as $key => $magnitud)
                            <tr>
                                <td scope="row">{{ $key+1 }}</td>
                                <td>{{ $magnitud->name }}</td>
                                <td><span class="badge badge-primary">{{ $magnitud->condition_type}}</span></td>
                                <td>
                                    @if (isset($magnitud->unit_measurement))
                                        @foreach ($magnitud->unit_measurement as $medida)
                                            <span class="mr-4">{{ $medida }}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <active estado="{{ $magnitud->status }}" url="{{ route('panel.magnitud.active', $magnitud) }}"></active>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('panel.magnitudes.edit', $magnitud->id) }}"  title="Ver registro"><i class="fas fa-edit text-primary"></i><a/>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
@endsection



@section('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(function() {
            oTable = $('#table').DataTable({
                responsive: true,
                "bLengthChange": false
            });

            $('#tableInpuntSearch').keyup(function() {
                oTable.search($(this).val()).draw();
            });

        });

    </script>
@endsection
