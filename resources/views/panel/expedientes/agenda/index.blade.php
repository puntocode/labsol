@extends('layouts.panel')

@section('title')Expedientes de Calibración |@endsection

@section('styles')
	<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
	<div class="container-fluid">
		<h3 class="card-label mb-8">Agenda <small class="font-weight-lighter">| Expedientes de Calibración</small></h3>

        <div class="row">
            {{-- estados link --}}
			<div class="col-md-4 col-lg-3">
				<div class="card card-custom card-stretch gutter-b">
					<div class="card-header border-0 pt-5 mb-5">
						<h3 class="card-title font-weight-bolder text-dark">Estados de calibraciones</h3>
					</div>


                    <div class="card-body pb-5 pt-0">
						<div class="card-content">
							<div class="flex-grow-1">
                                @foreach($estadosSum as $status)
                                    <div class="d-flex align-items-center justify-content-between mb-10">
                                        <div class="d-flex align-items-center mr-2">
                                            <div class="symbol symbol-40 symbol-light-{{$status->estados->color}} mr-3 flex-shrink-0">
                                                <div class="symbol-label">
                                                    <span class="svg-icon svg-icon-lg svg-icon-{{$status->estados->color}}">
                                                        <i class="fas {{$status->estados->icon}} text-{{$status->estados->color}}"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="#" class="font-size-h6 font-weight-bolder text-dark-75 text-hover-{{$status->estados->color}} estados" data-col-index="4" title="Filtrar por: Estados">{{ $status->sum }}
                                                    <div class="font-size-sm font-weight-bold mt-1">{{$status->estados->name}}</div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
							</div>
						</div>
					</div>
				</div>
			</div>

            {{-- Tabla --}}
			<div class="col-md-8 col-lg-9">
				<div class="card card-custom">
					<div class="card-header flex-wrap border-0 pt-6 pb-0">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label font-weight-bolder text-dark">Actividades planificadas</span>
							<p class="text-muted font-size-sm mt-3">{{ count($expedientes) }} Actividades planeadas</p>
						</h3>
					</div>

					<div class="card-body pt-5">
						<ul class="nav nav-tabs nav-bold nav-tabs-line mb-5">
							<li class="nav-item">
								<a class="nav-link active" href="#"><span class="nav-text">Agenda</span></a>
							</li>

							<li class="nav-item">
								<a class="nav-link" href="?vista=calendario"><span class="nav-text">Calendario</span></a>
							</li>
						</ul>

						<div class="tab-content pt-5">
                            <form class="mb-15">
								<div class="row mb-6 align-items-end">
                                    <div class="col-lg-3 mb-lg-0 mb-6">
                                        <label>Prioridad</label>
                                        <select class="form-control datatable-input" data-col-index="3">
                                            <option value="">Todas</option>
                                            <option value="NORMAL">NORMAL</option>
                                            <option value="URGENTE - 24Hs.">URGENTE - 24Hs.</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-3 mb-lg-0 mb-6">
                                        <label>Estado de calibraciones</label>
                                        <select class="form-control datatable-input" data-col-index="4">
                                            <option value="">Todos</option>
                                            @foreach ($estados as $estado)
                                                <option value="{{$estado->name}}">{{$estado->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-3">
                                        <button class="btn btn-primary btn-primary--icon mb-5 mb-md-0" id="kt_search" title="Filtrar registros">
                                            <span><i class="fas fa-filter"></i><span>Filtrar</span></span>
                                        </button>&#160;&#160;
                                        <button class="btn btn-secondary btn-secondary--icon" id="kt_reset" title="Reiniciar filtros">
                                            <span><i class="la la-close pr-0"></i></span>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <!--begin: Datatable-->
                            <table class="table table-separate table-head-custom collapsed" id="kt_datatable">
                                <thead>
                                    <tr>
                                        <th>N° Exp</th>
                                        <th>Instrumento</th>
                                        <th>Servicio</th>
                                        <th>Prioridad</th>
                                        <th>Estado</th>
                                        <th>Técnico asignado</th>
                                        <th>Fecha de entrega</th>
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($expedientes as $i => $expediente)
                                        <tr>
                                            <td>{{$expediente->number}}</td>
                                            <td>{{$expediente->servicios->instrumento->name}}</td>
                                            <td>{{$expediente->servicios->service}}</td>
                                            <td>
                                                <span class="badge badge-{{ $expediente->servicios->prioridad['color'] }} ml-5 ml-md-0 mt-2 mt-md-0">
                                                    {{ $expediente->servicios->prioridad['prioridad'] }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $expediente->estados->color }} ml-5 ml-md-0 mt-2 mt-md-0">
                                                    {{$expediente->estados->name}}
                                                </span>
                                            </td>
                                            <td id="text-{{ $expediente->number }}">
                                                @foreach ($expediente['tecnicos'] as $tecnicos)
                                                    <span><i class="fas fa-user mr-2"></i>{{ $tecnicos['nombre'] }}</span><br>
                                                @endforeach
                                            </td>
                                            <td id="date-{{ $expediente->number }}">{{ $expediente->delivery_date }}</td>
                                            <td>{{$expediente->servicios->obs}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">-- No hay registros --</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!--end: Datatable-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
    <script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('js/pages/crud/datatables/search-options/advanced-search.js')}}"></script>
@endsection
