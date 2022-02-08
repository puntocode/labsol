@extends('layouts.panel')

@section('title')Entrada Instrumentos |@endsection

	@section('styles')
		<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
	@endsection

	@section('content')
		<div class="container-fluid">
			<h3 class="card-label mb-8">Entrada Instrumentos <small class="font-weight-lighter">| Listado</small></h3>

			<div class="card card-custom">
				<div class="card-header border-0">
					<div class="card-title">
					</div>
					<div class="card-toolbar pt-7">
						@include('layouts.partials.extras.dropdown._export_list')

						@if(in_array('crear', $role_actions))
							<!--begin::Button-->
							<a href="{{route('panel.entrada-instrumentos.create')}}" class="btn btn-primary font-weight-bolder mb-5">
							<i class="la la-plus"></i>Crear entrada</a>
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
					<table class="table table-separate table-head-custom collapsed" id="tableInstrumentos" style="width:100%">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th>Cliente</th>
								<th>Contacto</th>
								<th>Email</th>
								<th>Dirección</th>
								<th>Teléfono</th>
								<th>F. de Creación</th>
								<th class="text-center">Detalle</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($entradaInstrumento as $i => $entrada)
								<tr>
                                    <th scope="row">{{ $i+1 }}</th>
									<td>{{$entrada->cliente->name}}</td>
									<td>{{$entrada->contact['nombre']}}</td>
									<td>{{$entrada->contact['email']}}</td>
									<td>{{$entrada->contact['direccion']}}</td>
									<td>{{$entrada->contact['telefono']}}</td>
									<td>{{$entrada->created_at}}</td>
									<td class="text-center">
                                        <a href="{{ route('panel.entrada-instrumentos.show', $entrada) }}" class="btn btn-sm btn-clean btn-icon" title="Ver Entrada Instrumento">
                                            <i class="fas fa-list text-primary"></i>
                                        </a>
                                        <a href="{{ route('panel.entrada-instrumentos.print', $entrada) }}" class="btn btn-sm btn-clean btn-icon" title="Imprimir detalles" target="_blank">
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
