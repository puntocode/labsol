@extends('layouts.panel')

@section('title')Clientes |@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Card-->
        <h3 class="card-label mb-8">Clientes <small class="font-weight-lighter">| Listado</small></h3>

        <div class="card card-custom">
            <div class="card-header border-0">
                <div class="card-title">
                </div>
                <div class="card-toolbar pt-7">
                    @include('layouts.partials.extras.dropdown._export_list')

                    @if (in_array('crear', $role_actions))
                        <!--begin::Button-->
                        <a href="{{ route('panel.clientes.create') }}" class="btn btn-primary font-weight-bolder mb-5">
                            <i class="la la-plus"></i>Agregar Cliente</a>
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
                <table class="table table-separate table-head-custom collapsed" id="tableClientes" style="width:100%">
                    <thead>
                        <tr>
                            <th>Razón Social</th>
                            <th>Codigo</th>
                            <th>RUC/CI</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Contacto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $i => $cliente)
                            <tr>
                                <td>{{ $cliente->name }}</td>
                                <td>{{ $cliente->code }}</td>
                                <td>{{ $cliente->ruc }}</td>
                                <td>{{ $cliente->adress }}</td>
                                <td>{{ $cliente->phone }}</td>
                                <td><span class="badge badge-primary contacto" data-id="{{ $cliente->code }}">Contacto</span></td>
                                <td>
                                    <a href="{{ route('panel.clientes.ficha', $cliente->id) }}" class="btn btn-sm btn-clean btn-icon" title="Ver registro">
                                        <i class="la la-eye text-primary"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon" title="Eliminar registro">
                                        <i class="la la-trash"></i>
                                    </a>
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

@section('modales')
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
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

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


            const jsonCliente = @json($clientes);
            console.log(jsonCliente);

            $('.contacto').on('click', function(){
                const id = $(this).data('id');
                const cliente = jsonCliente.find(customer => customer.code == id);
                const contact = cliente.contact;
                if(contact.length > 0){
                    cargarContactoHTML(contact);
                    jQuery.noConflict();
                    $('#modalContacto').modal('show');
                }
            })

            function cargarContactoHTML(contact){
                let html = '';
                contact.forEach(contacto => {
                    let name      = contacto.nombre;
                    let email     = contacto.email || '-'
                    let phone     = contacto.telefono || '-'
                    let arrayName = name.split(' ')
                    if(arrayName.length == 3 || arrayName.length == 4) arrayName = (arrayName[0]+' '+arrayName[2]).split(' ')
                    if(arrayName.length == 5) arrayName = (arrayName[0]+' '+arrayName[3]).split(' ')
                    let abr = arrayName[0].substring(0,1)+' '+arrayName[1].substring(0,1)

                    html += /*html*/
                    `<div class="card p-2 mt-3">
                        <div  class="card-body d-flex p-3">
                            <div class="symbol symbol-50 symbol-light-primary flex-shrink-0 mr-3">
                                <span class="symbol-label font-weight-bold h4 text-uppercase">${abr.toUpperCase()}</span>
                            </div>
                            <div class="d-block">
                                <h4>${name}</h4>
                                <p class="mb-2"><span class="mr-3"><i class="fas fa-envelope-square mr-1"></i>${email}</span></p>
                                <span class="text-black-50"><i class="fas fa-mobile-alt mr-1"></i>${phone}</span>
                            </div>
                        </div>
                    </div>`
                });
                $('#contacto-cliente').html(html)
            }

        });

    </script>
@endsection
