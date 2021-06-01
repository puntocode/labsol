@extends('layouts.panel')

@section('title')Equipos |@endsection

	@section('content')
		<div class="container-fluid">
			<div class="row">
				{{--@foreach ($charts as $chart)
				<div class="col-md-6 col-lg-4">
				@include('layouts.widgets.pie_chart', ['chart' => $chart])
			</div>
		@endforeach--}}

		<div class="col-md-6 col-lg-6 col-xl-6">
			@include('layouts.widgets.donut_chart', ['chart' => $chart])
		</div>
		<div class="col-md-6 col-lg-8 col-xl-6">
			<div class="card card-custom gutter-b">
				<!--begin::Header-->
				<div class="card-header border-0 py-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label font-weight-bolder text-dark">Operatividad mensual</span>
					</h3>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body py-0">
					<!--begin::Table-->
					<div class="table-responsive">
						<table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
							<thead>
								<tr class="text-left">
									<th style="min-width: 200px">Equipo</th>
									<th style="min-width: 150px">Días Operativos</th>
									<th style="min-width: 150px">Ocupación</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="pl-0">
										<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Equipo 1</a>
									</td>
									<td>
										<span class="text-dark-75 font-weight-bolder d-block font-size-lg">30</span>
									</td>
									<td>
										<div class="d-flex flex-column w-100 mr-2">
											<div class="d-flex align-items-center justify-content-between mb-2">
												<span class="text-muted mr-2 font-size-sm font-weight-bold">100%</span>
												<span class="text-muted font-size-sm font-weight-bold">Uptime</span>
											</div>
											<div class="progress progress-xs w-100">
												<div class="progress-bar bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</td>
								</tr>
								<tr>

									<td class="pl-0">
										<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Equipo 1</a>
									</td>
									<td>
										<span class="text-dark-75 font-weight-bolder d-block font-size-lg">15</span>
									</td>
									<td>
										<div class="d-flex flex-column w-100 mr-2">
											<div class="d-flex align-items-center justify-content-between mb-2">
												<span class="text-muted mr-2 font-size-sm font-weight-bold">50%</span>
												<span class="text-muted font-size-sm font-weight-bold">Uptime</span>
											</div>
											<div class="progress progress-xs w-100">
												<div class="progress-bar bg-success" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</td>
								</tr>

							</tbody>
						</table>
					</div>
					<!--end::Table-->
				</div>
				<!--end::Body-->
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script>
	// Shared Colors Definition
	const primary = '#6993FF';
	const success = '#1BC5BD';
	const info 	  = '#8950FC';
	const warning = '#FFA800';
	const danger  = '#F64E60';

	$(document).ready(function() {

		// -- Charts --

		var _chartEquipos = function () {
			const apexChartEquipos = "#chartEquipos";
			var options = {
				series: [5, 11, 20],
				chart: {
					width: 380,
					type: 'donut',
					events: {
						dataPointSelection: function(event, chartContext, config) {
							var cantidad = config.w.config.series[config.dataPointIndex]
							var nombre = config.w.config.labels[config.dataPointIndex]
						}
					}
				},
				labels: ['Inoperativos', 'En espera de repuestos', 'Operativos'],
				legend: {
					position: 'bottom',
					horizontalAlign: 'left'
				},
				colors: [danger, warning, success]
			};

			var chartEquipos = new ApexCharts(document.querySelector(apexChartEquipos), options);
			chartEquipos.render();
		}

		_chartEquipos();

	});
</script>
@endsection
