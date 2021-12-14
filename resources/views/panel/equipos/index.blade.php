@extends('layouts.panel')

@section('title')Equipos y Ensayos |@endsection

	@section('styles')
		<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
	@endsection

	@section('content')
		<div class="container-fluid">

            <div class="d-flex justify-content-between mb-8">
                <h3 class="card-label">Equipos y Ensayos <small class="font-weight-lighter">| Listado</small></h3>
                <a href="{{ route('panel.equipos.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear Equipo</a>
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
                    <table class="table table-separate table-head-custom collapsed" id="tableEquipos" style="width:100%">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Marca</th>
                                <th>Rango/Valor Nominal</th>
                                <th>Resolución</th>
                                <th>Error Máximo</th>
                                <th>Periodo de Cal.</th>
                                <th>Nro. de Certificado</th>
                                <th>Última Calibración</th>
                                <th>Prox. Calibración</th>
                                <th>Estado</th>
                                <th>Magnitud</th>
                                <th>Alerta de Cal.</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equipos as $i => $equipo)
                                <tr>
                                    <td>{{$equipo->code}}</td>
                                    <td>{{$equipo->description}}</td>
                                    <td>{{$equipo->brand}}</td>
                                    <td>
                                        @foreach ($equipo->rank as $rank)
                                            {{ $rank }} <br>
                                        @endforeach
                                    </td>
                                    <td>{{$equipo->resolution}}</td>
                                    <td>{{$equipo->error_max}}</td>
                                    <td>{{$equipo->calibration_period}}</td>
                                    <td>{{$equipo->certificate_no}}</td>
                                    <td>{{$equipo->last_calibration}}</td>
                                    <td>{{$equipo->next_calibration}}</td>
                                    <td><span class="badge badge-primary">{{$equipo->condition->name}}</span></td>
                                    <td><span class="badge badge-info">{{$equipo->magnitude->name}}</span></td>
                                    <td><span class="badge badge-danger">{{$equipo->alertCalibration->name}}</span></td>
                                    <td>
                                        @can('panel.database')
                                            <a href="{{ route('panel.equipos.show', $equipo) }}" class="btn btn-sm btn-clean btn-icon" title="Ver patrón">
                                                <i class="fas fa-list text-primary"></i>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

		</div>
	@endsection

	@section('scripts')
		<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>

    <script>
  		$(function() {
  			oTable = $('#tableEquipos').DataTable({
  				responsive: true,
  				"bLengthChange": false
  			});

  			$('#tableInpuntSearch').keyup(function(){
  			    oTable.search($(this).val()).draw() ;
  			});
  		});
  	</script>
	@endsection
