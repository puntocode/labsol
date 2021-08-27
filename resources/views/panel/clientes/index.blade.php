@extends('layouts.panel')

@section('title')Clientes |@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Card-->
        <h3 class="card-label d-flex justify-content-between mb-8">
            <span>Clientes <small class="font-weight-lighter">| Listado</small></span>
            <a href="{{ route('panel.clientes.create') }}" class="btn btn-primary">Crear Cliente</a>
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

                <div class="card-title">
                    @include('layouts.partials.extras.dropdown._export_list')
                </div>
            </div>

            <div class="card-body pt-0">

                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom collapsed" id="tableClientes" style="width:100%">
                    <thead>
                        <tr>
                            <th>Razón Social</th>
                            <th>Codigo</th>
                            <th>RUC/CI</th>
                            <th class="text-center">Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $i => $cliente)
                            <tr>
                                <td>{{ $cliente->name }}</td>
                                <td>{{ $cliente->code }}</td>
                                <td>{{ $cliente->ruc }}</td>
                                <td class="text-center">
                                    <a href="{{ route('panel.clientes.ficha', $cliente->id) }}"  title="Ver registro"><i class="fas fa-list text-primary"></i><a/>
                                </td>
                                {{-- <td>
                                    <a href="{{ route('panel.clientes.ficha', $cliente->id) }}" class="btn btn-sm btn-clean btn-icon" title="Ver registro">
                                        <i class="la la-eye text-primary"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon" title="Eliminar registro">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td> --}}
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

{{-- @section('modales')
    <div class="modal fade" id="modalContacto" tabindex="-1" role="dialog" aria-labelledby="modal-contacto"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Contacto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="contacto-cliente" class="modal-body">
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

@section('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(function() {
            oTable = $('#tableClientes').DataTable({
                responsive: true,
                "bLengthChange": false
            });

            $('#tableInpuntSearch').keyup(function() {
                oTable.search($(this).val()).draw();
            });

        });

    </script>
@endsection
