@extends('layouts.panel')

@section('title')Expedientes |@endsection

@section('styles')
	<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{asset('plugins/custom/kanban/kanban.bundle.css')}}">
@endsection

@section('content')
	<div class="container-fluid">
        <div class="row mb-6">
            <div class="col-12 d-flex justify-content-between align-items-start">
                <h3 class="card-label mb-8">Expedientes <small class="font-weight-lighter">| Listado</small></h3>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalTecnicos"><i class="fas fa-users pr-2"></i>Asignar Técnicos</button>
            </div>
        </div>

		<div class="card card-custom">
			<div class="card-body pt-12">
                <form class="mb-15">
					<div class="row mb-6 align-items-end">
						<div class="col-lg-2 mb-lg-0 mb-6">
							<label>Prioridad</label>
							<select class="form-control datatable-input" data-col-index="5">
								<option value="">Todas</option>
								<option value="NORMAL">NORMAL</option>
								<option value="URGENTE - 24HS.">URGENTE - 24HS.</option>
							</select>
						</div>

						<div class="col-lg-2 mb-lg-0 mb-6">
							<label>Estado</label>
							<select class="form-control datatable-input" data-col-index="3">
								<option value="">Todas</option>
								@foreach ($estados as $estado)
									<option value="{{ $estado->name }}">{{$estado->name}}</option>
								@endforeach
							</select>
						</div>

						<div class="col-lg-2 mb-lg-0 mb-6">
							<label>Plazo de entrega</label>
							<input type="text" class="form-control datatable-input" id="fecha_entrega" readonly="readonly" data-col-index="7">
						</div>

						<div class="col-lg-2 mb-lg-0 mb-6">
							<label>Modalidad</label>
							<select class="form-control datatable-input" data-col-index="0">
								<option value="">Todas</option>
								<option value="LS">LS</option>
								<option value="LSI">LSi</option>
							</select>
						</div>

						<div class="col-lg-3">
							<button class="btn btn-primary btn-primary--icon" id="kt_search" title="Filtrar registros">
								<span><i class="fas fa-filter"></i>Filtrar</span>
							</button>&#160;&#160;
							<button class="btn btn-secondary btn-secondary--icon" id="kt_reset" title="Reiniciar filtros">
								<i class="la la-close pr-0"></i>
                            </button>
						</div>
					</div>
				</form>

				<!--begin: Datatable-->
				<table class="table table-separate table-head-custom collapsed" id="kt_datatable" style="width:100%">
					<thead>
						<tr>
							<th>N° Exp</th>
							<th>Instrumento</th>
							<th>Servicio</th>
							<th>Estado</th>
							<th>Observaciones</th>
							<th>Prioridad</th>
							<th>Técnico asignado</th>
							<th>Fecha de entrega</th>
							<th class="text-center">Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($expedientes as $i => $expediente)
							<tr>
								<td>{{$expediente->number}}</td>
								<td>{{$expediente->servicios->instrumento->name}}</td>
								<td>{{$expediente->servicios->service}}</td>
								<td>
                                    <span class="badge badge-{{ $expediente->estados->color }} ml-5 ml-md-0 mt-2 mt-md-0">
                                        {{$expediente->estados->name}}
                                    </span>
                                </td>
                                <td>{{$expediente->servicios->obs}}</td>
								<td>
                                    <span class="badge badge-{{ $expediente->servicios->prioridad['color'] }} ml-5 ml-md-0 mt-2 mt-md-0">
                                        {{ $expediente->servicios->prioridad['prioridad'] }}
                                    </span>
								</td>
								<td id="text-{{ $expediente->number }}">
									@if($expediente['tecnicos'] == NULL)
                                        <button class="btn btn-primary btn-modal-at" id="{{ $expediente->number }}" data-number="{{ $expediente->number }}" data-toggle="modal" data-target="#modal-tecnico">Asignar Técnico</button>
                                    @else
										@foreach ($expediente['tecnicos'] as $tecnicos)
                                            <span><i class="fas fa-user mr-2"></i>{{ $tecnicos['nombre'] }}</span><br>
                                        @endforeach
									@endif
								</td>
								<td id="date-{{ $expediente->number }}">{{ $expediente->delivery_date }}</td>
								<td class="text-center">
                                    <a href="{{route('panel.expedientes.show', $expediente->id)}}" class="btn btn-sm btn-clean btn-icon" title="Editar registro">
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
	</div>
@endsection

@section('modales')
	<div class="modal fade" id="modalTecnicos" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <asignar-tecnicos :data="{{$expedientes}}"></asignar-tecnicos>
	    </div>
	</div>

    <div class="modal fade" id="modal-tecnico" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <asignar-tecnico :data="null"></asignar-tecnico>
	    </div>
	</div>
@endsection


@section('rutas')
    <script>
        const updateTecnicos = "{{ route('panel.expedientes.update_tecnicos') }}";
        const tecnicos = "{{ route('panel.usuarios.tecnicos') }}";
        window.routes = {
            'updateTecnicos': updateTecnicos,
            'tecnicos': tecnicos,
        }
    </script>
@endsection


@section('scripts')
	<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('js/pages/crud/datatables/search-options/advanced-search.js')}}"></script>
    <script>
        $('#fecha_entrega').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            format: 'dd/mm/yyyy'
        });

        $('.btn-modal-at').on('click', function(){
            const numero = $(this).data('number');
            $('#nro-expediente').html(numero);
        })
    </script>
@endsection
