@extends('layouts.panel')

@section('title')Procedimientos |@endsection

@section('styles')
	<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
	<div class="container-fluid">

        <div class="d-flex justify-content-between mb-8">
            <h3 class="card-label">Procedimientos <small class="font-weight-lighter">| Listado</small></h3>
            <a href="{{ route('panel.procedimientos.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear Procedimiento</a>
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

				<table class="table table-separate table-head-custom collapsed" id="tableFacturacion" style="width:100%">
					<thead>
						<tr>
							<th>Códivo</th>
							<th>Nombre</th>
							<th>Revisión</th>
							<th>Vigencia</th>
							<th>Detentor</th>
							<th class="text-center">Alcance Acreditado</th>
							<th class="text-center">Detalle</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($procedimientos as $procedimiento)
							<tr>
                                <td>{{$procedimiento->code}}</td>
                                <td>{{$procedimiento->name}}</td>
                                <td>{{$procedimiento->revision}}</td>
                                <td>{{$procedimiento->validity}}</td>
                                <td>{{$procedimiento->valve}}</td>
                                <td class="text-center">
                                    <span class="badge badge-{{ $procedimiento->getAlcanceColor() }}">{{ $procedimiento->accreditedScope() }}</span>
                                </td>
								<td>
									@can('panel.database')
                                        <a href="{{ route('panel.procedimientos.show', $procedimiento) }}" class="btn btn-sm btn-clean btn-icon" title="Ver procedimiento">
                                            <i class="fas fa-list text-primary"></i>
                                        </a>
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
	<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
	<script>
		$(function() {
			oTable = $('#tableFacturacion').DataTable({
				responsive: true,
				"bLengthChange": false
			});

			$('#tableInpuntSearch').keyup(function(){
			    oTable.search($(this).val()).draw() ;
			});
		});
	</script>
@endsection
