@extends('layouts.panel')

@section('title')Usuarios |@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-8">
            <h3 class="card-label">Usuarios <small class="font-weight-lighter">| Listado</small></h3>
            <a href="{{ route('panel.usuarios.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear Usuario</a>
        </div>

        <div class="card card-custom">
            <div class="card-header border-0">
                <div class="card-title">
                </div>
                <div class="card-toolbar pt-7">
                    @include('layouts.partials.extras.dropdown._export_list')

                    @if (in_array('crear', $role_actions))
                        <!--begin::Button-->
                        <a href="{{ route('panel.usuarios.create') }}" class="btn btn-primary font-weight-bolder mb-5">
                            <i class="la la-plus"></i>Crear usuario</a>
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
                <table class="table table-separate table-head-custom collapsed" id="tableUsuarios" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre Apellido</th>
                            <th>Código</th>
                            <th>Rol</th>
                            <th>Email</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $i => $usuario)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40 symbol-light-primary flex-shrink-0">
                                            <span class="symbol-label font-weight-bold text-uppercase">{{ $usuario->abbreviation }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">{{ $usuario->fullname }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $usuario->uuid }}</td>
                                <td class="text-capitalize">{{ $usuario->rol }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    <active estado="{{ $usuario->status }}" url="{{ route('panel.usuarios.active', $usuario) }}"></active>
                                </td>
                                <td class="text-center">
                                    @can('panel.database')
                                        <a href="{{ route('panel.usuarios.edit', $usuario->id) }}" title="Editar registro">
                                            <i class="la la-edit text-primary"></i>
                                        </a>
                                        <table-delete url="{{ route('panel.usuarios.destroy', $usuario->id) }}"></table-delete>
                                    @endcan
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
            oTable = $('#tableUsuarios').DataTable({
                responsive: true,
                "bLengthChange": false
            });

            $('#tableInpuntSearch').keyup(function() {
                oTable.search($(this).val()).draw();
            });
        });
    </script>
@endsection
