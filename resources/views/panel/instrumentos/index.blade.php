@extends('layouts.panel')

@section('title')Instrumentos |@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Card-->
        <h3 class="card-label d-flex justify-content-between mb-8">
            <span>Instrumentos <small class="font-weight-lighter">| Listado</small></span>
            <a href="{{ route('panel.instrumentos.create') }}" class="btn btn-primary">Crear Instrumentos</a>
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
                            <th scope="col">Instrumento</th>
                            <th scope="col">Estado</th>
                            <th scope="col" class="text-center">Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($instrumentos as $instrumento)
                            <tr>
                                <td scope="row">{{ $instrumento->id }}</td>
                                <td>{{ $instrumento->name }}</td>
                                <td>
                                    <active estado="{{ $instrumento->status }}" url="{{ route('panel.instrumento.active', $instrumento) }}"></active>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('panel.instrumentos.edit', $instrumento->id) }}"  title="Ver registro"><i class="fas fa-edit text-primary"></i><a/>
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
