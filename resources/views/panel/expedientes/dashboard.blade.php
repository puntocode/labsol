@extends('layouts.panel')

@section('title')Service Tickets |@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-5">
				<div class="card card-custom gutter-b card-stretch">
					<!--begin::Header-->
					<div class="card-header border-0 pt-5">
						<div class="card-title">
							<div class="card-label">
								<div class="font-weight-bolder">Tickets del día</div>
								<div class="font-size-sm text-muted mt-2">54 Tickets</div>
							</div>
						</div>
					</div>
					<!--end::Header-->

					<!--begin::Body-->
					<div class="card-body d-flex flex-column">
						<div class="row">
							<div class="col-md-8">
								<!--begin::Chart-->
								<div id="chartTickets"></div>
								<!--end::Chart-->
							</div>

							<!--begin::Items-->
							<div class="col-md-4 mt-5">
								<div class="d-flex align-items-center mr-2 mb-5">
									<!--begin::Symbol-->
									<div class="symbol symbol-45 symbol-light-danger mr-4 flex-shrink-0">
										<div class="symbol-label">
											<span class="svg-icon svg-icon-lg svg-icon-danger">
												<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo1/dist/../src/media/svg/icons/Home/Library.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													        <rect x="0" y="0" width="24" height="24"/>
													        <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"/>
													        <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) " x="16.3255682" y="2.94551858" width="3" height="18" rx="1"/>
													    </g>
													</svg><!--end::Svg Icon-->
												</span>
											</span>
										</div>
									</div>
									<!--end::Symbol-->

									<!--begin::Title-->
									<div>
										<div class="font-size-h4 text-dark-75 font-weight-bolder">24</div>
										<div class="font-size-md text-muted font-weight-bold mt-1">En cola</div>
									</div>
									<!--end::Title-->
								</div>

								<div class="d-flex align-items-center mr-2 mb-5">
									<!--begin::Symbol-->
									<div class="symbol symbol-45 symbol-light-warning mr-4 flex-shrink-0">
										<div class="symbol-label">
											<span class="svg-icon svg-icon-lg svg-icon-warning">
												<span class="svg-icon svg-icon-primary svg-icon-2x">
													<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo1/dist/../src/media/svg/icons/Home/Clock.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													        <rect x="0" y="0" width="24" height="24"/>
													        <path d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z" fill="#000000" opacity="0.3"/>
													        <path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" fill="#000000"/>
													    </g>
													</svg>
													<!--end::Svg Icon-->
												</span>
											</span>
										</div>
									</div>
									<!--end::Symbol-->

									<!--begin::Title-->
									<div>
										<div class="font-size-h4 text-dark-75 font-weight-bolder">10</div>
										<div class="font-size-md text-muted font-weight-bold mt-1">En curso</div>
									</div>
									<!--end::Title-->
								</div>

								<div class="d-flex align-items-center mr-2 mb-5">
									<!--begin::Symbol-->
									<div class="symbol symbol-45 symbol-light-success mr-4 flex-shrink-0">
										<div class="symbol-label">
											<span class="svg-icon svg-icon-lg svg-icon-success">
												<span class="svg-icon svg-icon-primary svg-icon-2x">
													<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo1/dist/../src/media/svg/icons/Communication/Clipboard-check.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													        <rect x="0" y="0" width="24" height="24"/>
													        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
													        <path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000"/>
													        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
													    </g>
													</svg>
													<!--end::Svg Icon-->
												</span>
											</span>
										</div>
									</div>
									<!--end::Symbol-->

									<!--begin::Title-->
									<div>
										<div class="font-size-h4 text-dark-75 font-weight-bolder">30</div>
										<div class="font-size-md text-muted font-weight-bold mt-1">Planificadas</div>
									</div>
									<!--end::Title-->
								</div>
							</div>
							<!--end::Items-->
						</div>
					</div>
					<!--end::Body-->
				</div>
			</div>

			<div class="col-md-7">
				<div class="card card-custom card-stretch gutter-b">
					<!--begin::Header-->
					<div class="card-header border-0 pt-5">
						<h3 class="card-title font-weight-bolder text-dark">Tickets</h3>

						<div class="card-toolbar mt-0 justify-content-between w-100">
							<p class="font-size-sm mb-5 text-muted">54 Service-Tickets</p>

							<div>
								@include('layouts.partials.extras.dropdown._filter_list')
								@include('layouts.partials.extras.dropdown._export_list')
								<a href="{{route('panel.serviceTickets.index')}}" class="btn btn-primary text-white">Ver todas</a>
							</div>
						</div>
						<!--end::Header-->

						<!--begin::Body-->
						<div class="card-body pt-2 px-0 overflow-auto" style="max-height: 50vh">
							@foreach ($tickets_abiertos as $ticket_abierto)
								@include('layouts.components.service_ticket_item_list', ['ticket' => $ticket_abierto, 'view_mode' => isset($view_mode) ? $view_mode : null])
							@endforeach
						</div>
					</div>
					<!--end::Body-->
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xl-4">
				<!--begin::List Widget 1-->
				<div class="card card-custom card-stretch gutter-b">
					<!--begin::Header-->
					<div class="card-header border-0 pt-5">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label font-weight-bolder text-dark">Disponibilidad</span>
							<span class="text-muted mt-3 font-weight-bold font-size-sm">{{$total_tecnicos}} Técnicos</span>
						</h3>
					</div>
					<!--end::Header-->

					<!--begin::Body-->
					<div class="card-body pt-8">
						<!--begin::Item-->
						<div id="chartDisponibilidad" class="d-flex justify-content-center"></div>
					</div>
					<!--end::Body-->
				</div>
				<!--end::List Widget 1-->
			</div>

			<div class="col-xl-4">
				<!--begin::List Widget 3-->
				<div class="card card-custom bg-light card-stretch gutter-b">
					<!--begin::Header-->
					<div class="card-header border-0 pt-5 mb-10">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label font-weight-bolder text-dark">Técnicos disponibles</span>
							<span class="text-muted mt-3 font-weight-bold font-size-sm">{{$total_disponibles}} Técnicos</span>
						</h3>
					</div>
					<!--end::Header-->

					<!--begin::Body-->
					<div class="card-body pt-2 list-tecnicos">
						@forelse ($tecnicos_disponibles as $i => $tecnico_disponible)
							@include('layouts.partials.extras.items.duallist_image_text', ['item' => $tecnico_disponible])
						@empty
							<p class="text-center">- No hay técnicos disponibles -</p>
						@endforelse
					</div>
					<!--end::Body-->
				</div>
				<!--end::List Widget 3-->
			</div>

			<div class="col-xl-4">
				<!--begin::List Widget 3-->
				<div class="card card-custom card-stretch gutter-b">
					<!--begin::Header-->
					<div class="card-header border-0 pt-5 mb-10">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label font-weight-bolder text-dark">Técnicos no disponibles</span>
							<span class="text-muted mt-3 font-weight-bold font-size-sm">{{$total_no_disponibles}} Técnicos</span>
						</h3>
					</div>
					<!--end::Header-->

					<!--begin::Body-->
					<div class="card-body pt-2 list-tecnicos">
						@forelse ($tecnicos_no_disponibles as $i => $tecnico_no_disponible)
							@include('layouts.partials.extras.items.duallist_image_text', ['item' => $tecnico_no_disponible])
						@empty
							<p class="text-center">- Todos los técnicos están disponibles -</p>
						@endforelse
					</div>
					<!--end::Body-->
				</div>
				<!--end::List Widget 3-->
			</div>

			<div class="col-xl-4">
				<!--begin::List Widget 1-->
				<div class="card card-custom card-stretch gutter-b">
					<!--begin::Header-->
					<div class="card-header border-0 pt-5">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label font-weight-bolder text-dark">Estado de los tickets</span>
							<span class="text-muted mt-3 font-weight-bold font-size-sm">60 Tickets</span>
						</h3>
					</div>
					<!--end::Header-->

					<!--begin::Body-->
					<div class="card-body pt-8">
						<!--begin::Item-->
						<div id="chartEstadoTickets" class="d-flex justify-content-center"></div>
					</div>
					<!--end::Body-->
				</div>
				<!--end::List Widget 1-->
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

	$(document).ready(function(){
		var _chartTickets = function () {

			const apexChartTickets = "#chartTickets";
			var options = {
				series: [10, 24, 30],
				chart: {
					height: 350,
					type: 'radialBar',
				},
				plotOptions: {
					radialBar: {
						dataLabels: {
							name: {
								fontSize: '22px',
							},
							value: {
								fontSize: '16px',
							},
							total: {
								show: true,
								label: 'Total',
								formatter: function (w) {
									// By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
									return 64
								}
							}
						}
					}
				},
				labels: ['En curso', 'En cola', 'Planificadas'],
				colors: [warning, danger, success]
			};

			var chartTickets = new ApexCharts(document.querySelector(apexChartTickets), options);
			chartTickets.render();
		}

		_chartTickets();


		var _chartDisponibilidad = function () {
			const apexChartDisponibilidad = "#chartDisponibilidad";

			var options = {
				series: [9, 2],
				chart: {
					width: 380,
					type: 'pie',
				},
				labels: ['Disponibles', 'No disponibles'],
				legend: {
					position: 'bottom',
					horizontalAlign: 'left'
				},
				colors: [success, danger]
			};

			var chartDisponibilidad = new ApexCharts(document.querySelector(apexChartDisponibilidad), options);
			chartDisponibilidad.render();
		}
		_chartDisponibilidad();

		var _chartEstadoTickets = function () {
			const apexChartDisponibilidad = "#chartEstadoTickets";

			var options = {
				series: [9, 2, 15, 2, 3],
				chart: {
					width: 380,
					type: 'pie',
				},
				labels: ['Cerrados', 'En espera de repuestos ', 'Abiertos', 'En espera de Diagnóstico', 'Pendientes'],
				legend: {
					position: 'bottom',
					horizontalAlign: 'left'
				},
				colors: [success, danger, info, primary, warning]
			};

			var chartEstadoTickets = new ApexCharts(document.querySelector(apexChartDisponibilidad), options);
			chartEstadoTickets.render();
		}
		_chartEstadoTickets();
	});
</script>
@endsection
