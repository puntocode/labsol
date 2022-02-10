@extends('layouts.panel')

@section('title')Expedientes de Calibración |@endsection

@section('styles')
	<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
	<div class="container-fluid">
		<h3 class="mb-8 card-label">Agenda <small class="font-weight-lighter">| Expedientes de Calibración</small></h3>

        <div class="row">
            {{-- estados link --}}
			<div class="col-lg-3">
				<div class="card card-custom card-stretch gutter-b">
					<div class="pt-5 mb-5 border-0 card-header">
						<h3 class="card-title font-weight-bolder text-dark">Estados de calibraciones</h3>
					</div>


                    <div class="pt-0 pb-5 card-body">
						<div class="card-content">
							<div class="flex-grow-1">
                                @foreach($estadosFiltro as $status)
                                    <div class="mb-10 d-flex align-items-center justify-content-between">
                                        <div class="mr-2 d-flex align-items-center">
                                            <div class="symbol symbol-40 symbol-light-{{$status->estados->color}} mr-3 flex-shrink-0">
                                                <div class="symbol-label">
                                                    <span class="svg-icon svg-icon-lg svg-icon-{{$status->estados->color}}">
                                                        <i class="fas {{$status->estados->icon}} text-{{$status->estados->color}}"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="#" class="font-size-h6 font-weight-bolder text-dark-75 text-hover-{{$status->estados->color}} estados" data-col-index="4" title="Filtrar por: Estados">{{ $status->sum }}
                                                    <div class="mt-1 font-size-sm font-weight-bold">{{$status->estados->name}}</div>
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
			<div class="col-lg-9">
				<div class="card card-custom">
					<div class="flex-wrap pt-6 pb-0 border-0 card-header d-flex justify-content-between align-items-end">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label font-weight-bolder text-dark">Actividades planificadas</span>
							<p class="mt-3 text-muted font-size-sm">{{ count($expedientes) }} Actividades planeadas</p>
						</h3>

                        <form>
                            <div class="input-icon float-left">
                                <input type="text" class="form-control" placeholder="Buscar..." id="tableInpuntSearch">
                                <span><i class="flaticon2-search-1 icon-md"></i></span>
                            </div>
                        </form>
					</div>

					<div class="pt-5 card-body">
						<ul class="mb-5 nav nav-tabs nav-bold nav-tabs-line">
							<li class="nav-item">
								<a class="nav-link active" href="#"><span class="nav-text">Agenda</span></a>
							</li>

							{{-- <li class="nav-item">
								<a class="nav-link" href="?vista=calendario"><span class="nav-text">Calendario</span></a>
							</li> --}}
						</ul>

						<div class="pt-5 tab-content">
                            <form class="mb-15">
								<div class="mb-6 row align-items-end">
                                    <div class="mb-6 col-lg-3 mb-lg-0">
                                        <label>Prioridad</label>
                                        <select class="form-control datatable-input" data-col-index="3">
                                            <option value="">Todas</option>
                                            <option value="NORMAL">NORMAL</option>
                                            <option value="URGENTE - 24Hs.">URGENTE - 24Hs.</option>
                                        </select>
                                    </div>

                                    <div class="mb-6 col-lg-3 mb-lg-0">
                                        <label>Estado de calibraciones</label>
                                        <select class="form-control datatable-input" data-col-index="4">
                                            <option value="">Todos</option>
                                            @foreach ($estados as $estado)
                                                <option value="{{$estado->name}}">{{$estado->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-3">
                                        <button class="mb-5 btn btn-primary btn-primary--icon mb-md-0" id="kt_search" title="Filtrar registros">
                                            <span><i class="fas fa-filter"></i><span>Filtrar</span></span>
                                        </button>&#160;&#160;
                                        <button class="btn btn-secondary btn-secondary--icon" id="kt_reset" title="Reiniciar filtros">
                                            <span><i class="pr-0 la la-close"></i></span>
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
                                        <th>Cliente</th>
                                        <th>Prioridad</th>
                                        <th>Estado</th>
                                        <th>Técnico asignado</th>
                                        <th>Fecha de entrega</th>
                                        <th>Calibrar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($expedientes as $i => $expediente)
                                        <tr>
                                            <td>{{$expediente->number}}</td>
                                            <td>{{$expediente->instrumentos->name}}</td>
                                            <td>{{$expediente->entradaInstrumentos->cliente->name}}</td>
                                            <td>
                                                <span class="badge badge-{{ $expediente->prioridad['color'] }} ml-5 ml-md-0 mt-2 mt-md-0">
                                                    {{ $expediente->prioridad['priority'] }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $expediente->estados->color }} ml-5 ml-md-0 mt-2 mt-md-0">
                                                    {{$expediente->estados->name}}
                                                </span>
                                            </td>

                                            <td id="text-{{ $expediente->number }}">
                                                @foreach ($expediente['tecnicos'] as $tecnicos)
                                                    <span><i class="mr-2 fas fa-user"></i>{{ $tecnicos['nombre'] }}</span><br>
                                                @endforeach
                                            </td>

                                            <td id="date-{{ $expediente->number }}">{{ $expediente->delivery_date }}</td>
                                            {{-- <td>{{$expediente->obs}}</td> --}}
                                            <td><a href="{{ route('panel.calibrar.expediente', $expediente->id) }}" class="btn btn-primary">Calibrar</a></td>
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
