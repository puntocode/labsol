@extends('layouts.panel')

@section('title')Expedientes |@endsection

@section('styles')
	<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{asset('plugins/custom/kanban/kanban.bundle.css')}}">
@endsection

@section('content')
	<div class="container-fluid">
        <div class="mb-6 row">
            <div class="col-12">
                <h3 class="mb-8 card-label">Expedientes <small class="font-weight-lighter">| Listado de todos los expedientes</small></h3>
            </div>
        </div>

		<div class="card card-custom">
			<div class="pt-12 card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <form class="pt-8">
                            <div class="float-left input-icon">
                                <input type="text" class="form-control" placeholder="Buscar..." id="tableInpuntSearch">
                                <span><i class="flaticon2-search-1 icon-md"></i></span>
                            </div>
                        </form>
                    </div>
                    <div class="p-8 col-lg-9 p-lg-0">
                        <form class="mb-15">
                            <div class="d-flex flex-column flex-lg-row align-items-lg-end">
                                <div class="mb-6 mr-5 mb-lg-0 flex-fill">
                                    <label>Prioridad</label>
                                    <select class="form-control datatable-input" data-col-index="5">
                                        <option value="">Todas</option>
                                        <option value="NORMAL">NORMAL</option>
                                        <option value="URGENTE - 24HS.">URGENTE - 24HS.</option>
                                    </select>
                                </div>

                                <div class="mb-6 mr-5 mb-lg-0 flex-fill">
                                    <label>Estado</label>
                                    <select class="form-control datatable-input" data-col-index="4">
                                        <option value="">Todas</option>
                                        @foreach ($estados as $estado)
                                            <option value="{{ $estado->name }}">{{$estado->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-6 mr-5 mb-lg-0 flex-fill">
                                    <label>Plazo de entrega</label>
                                    <input type="text" class="form-control datatable-input" id="fecha_entrega" readonly="readonly" data-col-index="7">
                                </div>

                                <div class="mb-6 mr-5 mb-lg-0 flex-fill">
                                    <label>Modalidad</label>
                                    <select class="form-control datatable-input" data-col-index="0">
                                        <option value="">Todas</option>
                                        <option value="LS-">LS</option>
                                        <option value="LSI-">LSi</option>
                                    </select>
                                </div>

                                <div class="mr-5 flex-fill">
                                    <button class="btn btn-primary btn-primary--icon" id="kt_search" title="Filtrar registros">
                                        <span><i class="fas fa-filter"></i>Filtrar</span>
                                    </button>&#160;&#160;
                                    <button class="btn btn-secondary btn-secondary--icon" id="kt_reset" title="Reiniciar filtros">
                                        <i class="pr-0 la la-close"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


				<!--begin: Datatable-->
				<table class="table table-separate table-head-custom collapsed" id="kt_datatable" style="width:100%">
					<thead>
						<tr>
							<th>N° Exp</th>
							<th>Cliente</th>
							<th>Instrumento</th>
							<th>Servicio</th>
							<th>Estado</th>
							{{-- <th>Observaciones</th> --}}
							<th>Prioridad</th>
							<th>Técnico asignado</th>
							<th>Fecha de entrega</th>
							<th class="text-center">Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($expedientes as $expediente)
							<tr>
								<td>{{$expediente->number}}</td>
								<td>{{$expediente->certificate}}</td>
								<td>{{$expediente->instrumentos->name}}</td>
								<td>{{$expediente->service}}</td>
								<td>
                                    <span class="badge badge-{{ $expediente->estados->color }} ml-5 ml-md-0 mt-2 mt-md-0">
                                        {{ $expediente->estados->name }}
                                    </span>
                                </td>
                                {{-- <td>{{$expediente->obs}}</td> --}}
								<td>
                                    <span class="badge badge-{{ $expediente->prioridad['color'] }} ml-5 ml-md-0 mt-2 mt-md-0">
                                        {{ $expediente->prioridad['priority'] }}
                                    </span>
								</td>
                                <td>
                                    @if (isset($expediente['tecnicos']))
                                        @foreach ($expediente['tecnicos'] as $tecnicos)
                                            <span><i class="mr-2 fas fa-user"></i>{{ $tecnicos['nombre'] }}</span><br>
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



@section('scripts')
	<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('js/pages/crud/datatables/search-options/advanced-search.js')}}"></script>
    <script>
        $('#fecha_entrega').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            format: 'dd/mm/yyyy'
        });
    </script>
@endsection
