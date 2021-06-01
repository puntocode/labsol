@extends('layouts.panel')

@section('title')Clientes |@endsection

@section('styles')
		<link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			@foreach ($charts as $chart)
				<div class="col-md-6 col-lg-6 col-xl-4">
					@include('layouts.widgets.pie_chart', ['chart' => $chart])
				</div>
			@endforeach
			<div class="col-md-6 col-lg-6 col-xl-4">
				<div class="card card-custom gutter-b">
					<div class="card-header">
						<div class="card-title">
							<h3 class="card-label">Mapa de concentración</h3>
						</div>
					</div>
					<div class="card-body">
						<div id="pymap" style="height: 500px;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>

<script>
	// Shared Colors Definition
	const primary = '#6993FF';
	const success = '#1BC5BD';
	const info 	  = '#8950FC';
	const warning = '#FFA800';
	const danger  = '#F64E60';

	$(document).ready(function() {

		// -- Datatables --

	    $('#table_chartEstados').DataTable( {
	    	"paging":   false,
	        "info":     false,
	        "bFilter": false,
	        "footerCallback": function ( row, data, start, end, display ) {
	            var api = this.api(), data;

	            // Remove the formatting to get integer data for summation
	            var intVal = function ( i ) {
	                return typeof i === 'string' ?
	                    i.replace(/[\$,]/g, '')*1 :
	                    typeof i === 'number' ?
	                        i : 0;
	            };

	            // Total over all pages
	            total = api
	                .column( 1 )
	                .data()
	                .reduce( function (a, b) {
	                    return intVal(a) + intVal(b);
	                }, 0 );

	            // Total over this page
	            pageTotal = api
	                .column( 1, { page: 'current'} )
	                .data()
	                .reduce( function (a, b) {
	                    return intVal(a) + intVal(b);
	                }, 0 );

	            // Update footer
	            $( api.column( 1 ).footer() ).html(total);
	        }
	    });

			$('#table_chartEstadoPublico').DataTable( {
	    	"paging":   false,
	        "info":     false,
	        "bFilter": false,
	        "footerCallback": function ( row, data, start, end, display ) {
	            var api = this.api(), data;

	            // Remove the formatting to get integer data for summation
	            var intVal = function ( i ) {
	                return typeof i === 'string' ?
	                    i.replace(/[\$,]/g, '')*1 :
	                    typeof i === 'number' ?
	                        i : 0;
	            };

	            // Total over all pages
	            total = api
	                .column( 1 )
	                .data()
	                .reduce( function (a, b) {
	                    return intVal(a) + intVal(b);
	                }, 0 );

	            // Total over this page
	            pageTotal = api
	                .column( 1, { page: 'current'} )
	                .data()
	                .reduce( function (a, b) {
	                    return intVal(a) + intVal(b);
	                }, 0 );

	            // Update footer
	            $( api.column( 1 ).footer() ).html(total);
	        }
	    });

	    $('#table_chartClientes').DataTable( {
	    	"paging":   false,
	        "info":     false,
	        "bFilter": false,
	        "footerCallback": function ( row, data, start, end, display ) {
	            var api = this.api(), data;

	            // Remove the formatting to get integer data for summation
	            var intVal = function ( i ) {
	                return typeof i === 'string' ?
	                    i.replace(/[\$,]/g, '')*1 :
	                    typeof i === 'number' ?
	                        i : 0;
	            };

	            // Total over all pages
	            total = api
	                .column( 1 )
	                .data()
	                .reduce( function (a, b) {
	                    return intVal(a) + intVal(b);
	                }, 0 );

	            // Total over this page
	            pageTotal = api
	                .column( 1, { page: 'current'} )
	                .data()
	                .reduce( function (a, b) {
	                    return intVal(a) + intVal(b);
	                }, 0 );

	            // Update footer
	            $( api.column( 1 ).footer() ).html(total);
	        }
	    });

	    $('#table_chartServicios').DataTable( {
	    	"paging":   false,
	        "info":     false,
	        "bFilter": false,
	        "footerCallback": function ( row, data, start, end, display ) {
	            var api = this.api(), data;

	            // Remove the formatting to get integer data for summation
	            var intVal = function ( i ) {
	                return typeof i === 'string' ?
	                    i.replace(/[\$,]/g, '')*1 :
	                    typeof i === 'number' ?
	                        i : 0;
	            };

	            // Total over all pages
	            total = api
	                .column( 1 )
	                .data()
	                .reduce( function (a, b) {
	                    return intVal(a) + intVal(b);
	                }, 0 );

	            // Total over this page
	            pageTotal = api
	                .column( 1, { page: 'current'} )
	                .data()
	                .reduce( function (a, b) {
	                    return intVal(a) + intVal(b);
	                }, 0 );

	            // Update footer
	            $( api.column( 1 ).footer() ).html(total);
	        }
	    });


		// -- Charts --

		var _chartClientes = function () {
			const apexChartClientes = "#chartClientes";

			var options = {
				series: [38, 37, 25],
				chart: {
					width: 380,
					type: 'pie',
				},
				labels: ['Privado', 'Público', 'IPS'],
				legend: {
					position: 'bottom',
					horizontalAlign: 'left'
				},
				colors: [primary, success, warning]
			};

			var chartClientes = new ApexCharts(document.querySelector(apexChartClientes), options);
			chartClientes.render();
		}
		_chartClientes();


		var _chartServicios = function () {
			const apexChartServicios = "#chartServicios";

			var options = {
				series: [3, 56, 21, 20],
				chart: {
					width: 380,
					type: 'pie',
				},
				labels: ['Dados de baja', 'Contrato de servicios', 'Garantía', 'Sin contrato'],
				legend: {
					position: 'bottom',
					horizontalAlign: 'left'
				},
				colors: [primary, success, warning, info]
			};

			var chartServicios = new ApexCharts(document.querySelector(apexChartServicios), options);
			chartServicios.render();
		}
		_chartServicios();


		var _chartEstados = function () {
			const apexChartEstados = "#chartEstados";

			var options = {
				series: [2, 57, 22, 24],
				chart: {
					width: 380,
					type: 'pie',
				},
				labels: ['Dados de baja', 'Contrato de servicios', 'Garantía', 'Sin contrato'],
				legend: {
					position: 'bottom',
					horizontalAlign: 'left'
				},
				colors: [primary, success, warning, info]
			};

			var chartEstados = new ApexCharts(document.querySelector(apexChartEstados), options);
			chartEstados.render();
		}
		_chartEstados();


		var _chartEstadoPublico = function () {
			const apexChartEstados = "#chartEstadoPublico";

			var options = {
				series: [2, 57, 22, 24],
				chart: {
					width: 380,
					type: 'pie',
				},
				labels: ['Dados de baja', 'Contrato de servicios', 'Garantía', 'Sin contrato'],
				legend: {
					position: 'bottom',
					horizontalAlign: 'left'
				},
				colors: [primary, success, warning, info]
			};

			var chartEstados = new ApexCharts(document.querySelector(apexChartEstados), options);
			chartEstados.render();
		}
		_chartEstadoPublico();
	});
</script>

<script src="//www.amcharts.com/lib/3/ammap.js"></script>
<script src="//www.amcharts.com/lib/3/maps/js/paraguayHigh.js"></script>
<script src="//www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="//www.amcharts.com/lib/3/themes/light.js"></script>
<script src="{{asset('js/pages/features/charts/amcharts/maps.js')}}"></script>


<script type="text/javascript">
var KTamChartsChartsDemo = function() {
	var demo6 = function() {
			var map = AmCharts.makeChart("pymap", {
					"type": "map",
					"theme": "light",
					"colorSteps": 10,

					"dataProvider": {
						"map": "paraguayHigh",
						"areas": [{
							"id": "PY-ASU",
							"value": 150
						}, {
							"id": "PY-7",
							"value": 70
						}, {
							"id": "PY-1",
							"value": 15
						}, {
							"id": "PY-3",
							"value": 5
						}, {
							"id": "PY-2",
							"value": 15
						}, {
							"id": "PY-4",
							"value": 48
						}, {
							"id": "PY-5",
							"value": 26
						}, {
							"id": "PY-8",
							"value": 32
						}, {
							"id": "PY-9",
							"value": 14
						}, {
							"id": "PY-10",
							"value": 150
						}, {
							"id": "PY-11",
							"value": 105
						}, {
							"id": "PY-12",
							"value": 54
						}, {
							"id": "PY-13",
							"value": 36
						}, {
							"id": "PY-14",
							"value": 36
						}, {
							"id": "PY-15",
							"value": 16
						}, {
							"id": "PY-16",
							"value": 17
						}, {
							"id": "PY-19",
							"value": 5
						}, {
							"id": "PY-6",
							"value": 47
						}]
					},

					"areasSettings": {
							"autoZoom": true,
							"balloonText": "[[title]]: [[value]]"
					},

					"valueLegend": {
							"right": 10,
							"minValue": "5",
							"maxValue": "+100"
					},

					"export": {
							"enabled": true
					}

			});
	}
demo6();
}();
KTamChartsChartsDemo();
</script>
@endsection
