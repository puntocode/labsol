@extends('layouts.panel')

@section('title')Certificados |@endsection

@section('styles')
	<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!--begin::Container-->
	<div class="container-fluid">
		<!--begin::Card-->
		<h3 class="card-label mb-8">Certificados <small class="font-weight-lighter">| Listado</small></h3>

		<div class="card card-custom">
			<div class="card-header border-0">
				<div class="card-title">
				</div>
				<div class="card-toolbar pt-7">
					@include('layouts.partials.extras.dropdown._export_list')

					{{-- @if(in_array('crear', $role_actions))
						<!--begin::Button-->
						<a href="{{route('panel.calibracion.certificados.create')}}" class="btn btn-primary font-weight-bolder mb-5">
						<i class="la la-plus"></i>Crear Calibración</a>
						<!--end::Button-->
					@endif --}}
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
				<table class="table table-separate table-head-custom collapsed" id="tableExpedientes" style="width:100%">
					<thead>
						<tr>
							<th>N° Exp</th>
							<th>Solicitante</th>
							<th>Instrumento</th>
							<th>Fecha calibración</th>
							<th class="text-center">Detalle</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($expedientes as $expediente)
							<tr>
								<td>{{$expediente->number}}</td>
								<td>{{$expediente->certificate}}</td>
								<td>{{$expediente->instrumentos->name}}</td>
								<td>{{$expediente->calibracion->fecha_fin}}</td>
								<td class="text-center">
									<a href="{{ route('panel.calibracion.certificados.print', $expediente->id) }}" class="btn btn-sm btn-clean btn-icon" title="Imprimir detalles">
										<i class="fas fa-print text-primary"></i>
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

@section('scripts')
	<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>

	<script>
		$(function() {
			oTable = $('#tableExpedientes').DataTable({
				responsive: true,
				"bLengthChange": false
			});

			$('#tableInpuntSearch').keyup(function(){
			    oTable.search($(this).val()).draw() ;
			});
		});
	</script>
@endsection
