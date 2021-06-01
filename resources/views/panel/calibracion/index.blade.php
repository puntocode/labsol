@extends('layouts.panel')

@section('title')Calibración |@endsection

@section('styles')
	<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!--begin::Container-->
	<div class="container-fluid">
		<!--begin::Card-->
		<h3 class="card-label mb-8">Calibración <small class="font-weight-lighter">| Listado</small></h3>

		<div class="card card-custom">
			<div class="card-header border-0">
				<div class="card-title">
				</div>
				<div class="card-toolbar pt-7">
					@include('layouts.partials.extras.dropdown._export_list')

					@if(in_array('crear', $role_actions))
						<!--begin::Button-->
						<a href="{{route('panel.calibracion.create')}}" class="btn btn-primary font-weight-bolder mb-5">
						<i class="la la-plus"></i>Crear Calibración</a>
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
				<table class="table table-separate table-head-custom collapsed" id="tableExpedientes" style="width:100%">
					<thead>
						<tr>
							<th>N° Exp</th>
							<th>Solicitante</th>
							<th>Instrumento</th>
							<th>Patrones</th>
							<th>Fecha calibración</th>
							<th>Lugar</th>
							<th>Temperatura</th>
							<th>Humedad relativa</th>
							<th>Procedimiento</th>
							<th>Observaciones</th>
							<th>Fecha culminación</th>
							<th>Temperatura final</th>
							<th>Humedad relativa final</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($calibraciones as $i => $calibracion)
							<tr>
								<td>{{$calibracion->nro_expediente}}</td>
								<td>{{$calibracion->solicitante}}</td>
								<td>{{$calibracion->instrumento}}</td>
								<td>{{$calibracion->patrones}}</td>
								<td>{{$calibracion->fecha_calibracion}}</td>
								<td>{{$calibracion->lugar}}</td>
								<td>{{$calibracion->temperatura}}</td>
								<td>{{$calibracion->humedad_relativa}}</td>
								<td>{{$calibracion->procedimiento}}</td>
								<td>{{$calibracion->observaciones}}</td>
								<td>{{$calibracion->fecha_fin}}</td>
								<td>{{$calibracion->temperatura_final}}</td>
								<td>{{$calibracion->humedad_final}}</td>

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
