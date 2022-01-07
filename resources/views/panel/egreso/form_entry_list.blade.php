@extends('layouts.panel')

@section('title')Salida de instrumento |@endsection
  @section('styles')
  	<link rel="stylesheet" href="{{asset('plugins/custom/kanban/kanban.bundle.css')}}">
  @endsection
@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Salida de instrumento
			<small class="font-weight-lighter">
				Crear
			</small>
		</h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
				<div class="card card-custom card-fixed gutter-b">
					<div class="card-body ">
						<div class="flex-grow-1">
							<ul class="list-unstyled px-0">
								<li class="mb-5">
									<a href="{{route('panel.egreso.index')}}" class="as-text text-hover-primary" title="Ir a listado de instrumentos">
										<i class="fas fa-arrow-left text-hover-primary"></i>
										Ir a listado
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-9 col-xl-10">
				<!--begin::Card-->
				<div class="card card-custom mb-5">
					<div class="card-header border-0">
						<div class="card-title pt-8 d-block">
							<h3 class="card-title font-weight-bolder text-dark">Entradas de Instrumentos</h3>
						</div>
					</div>
					<div class="card-body">
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
						<table class="table table-separate table-head-custom collapsed" id="tableInstrumentos" style="width:100%">
							<thead>
								<tr>
									<th>Cliente</th>
									<th>Contacto</th>
									<th>Email</th>
									<th>Direccion</th>
									<th>Teléfono</th>
									<th>F. de Creación</th>
									<th class="text-center">Detalle</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($entradasInstrumentos as $entradaInstrumento)
									<tr>
										<td>{{ $entradaInstrumento->cliente->name }}</td>
										<td>{{ $entradaInstrumento->cliente->contact[0]['nombre'] }}</td>
										<td>{{ $entradaInstrumento->cliente->contact[0]['email'] }}</td>
										<td>{{ $entradaInstrumento->cliente->contact[0]['direccion'] }}</td>
										<td>{{ $entradaInstrumento->cliente->contact[0]['telefono'] }}</td>
										<td>{{ $entradaInstrumento->cliente->created_at->format('d-m-Y') }}</td>
										<td class="text-center">
											<a href="{{ route('panel.egreso.create', ['entrada_instrumento_id' => $entradaInstrumento]) }}"
												class="btn btn-sm btn-clean btn-icon" title="Ver detalle">
												<i class="fas fa-list text-primary"></i>
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
		</div>
	</div>
@endsection

@section('scripts')
	<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>

	<script>
		$(function() {
			oTable = $('#tableInstrumentos').DataTable({
				responsive: true,
				"bLengthChange": false
			});

			$('#tableInpuntSearch').keyup(function(){
				oTable.search($(this).val()).draw() ;
			});
		});
	</script>
@endsection
