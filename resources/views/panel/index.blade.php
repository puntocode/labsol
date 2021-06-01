@extends('layouts.panel')
@section('styles')
	<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div class="container-fluid">
	<div class="row nav" id="card_icon_resume">
		@foreach ($resumen as $card)
			@include('layouts.widgets.card_icon_resume', ['card' => $card])
		@endforeach
	</div>

</div>
@endsection

@section('scripts')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>

<script>
$("#card_icon_resume .col-lg-2 .nav-link").on("click", function(){
  var id = $(this).attr("href");
  $("#cards-info > .tab-pane").removeClass("active");
  $("#card_icon_resume .nav-justified .nav-link").removeClass("active");
  $(".tab-pane" + id).addClass("active");
});

	// Shared Colors Definition
	const primary = '#6993FF';
	const success = '#1BC5BD';
	const info 	  = '#8950FC';
	const warning = '#FFA800';
	const danger  = '#F64E60';

	$(document).ready(function() {

		// -- Datatables --

	    $('#table_EquiposActivos').DataTable( {
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

		var _chartEquiposActivos = function () {
			const apexEquiposActivos = "#chartEquiposActivos";

			var options = {
				series: [38, 37],
				chart: {
					width: 380,
					type: 'pie',
				},
				labels: ['Tomógrafos', 'Angiógrafos'],
				legend: {
					position: 'bottom',
					horizontalAlign: 'left'
				},
				colors: [primary, success]
			};

			var chartEquiposActivos = new ApexCharts(document.querySelector(apexEquiposActivos), options);
			chartEquiposActivos.render();
		}
		_chartEquiposActivos();



		// -- Progress

		var _progresoMP = function () {
        var element = document.getElementById("progresoMP");
        var height = parseInt(KTUtil.css(element, 'height'));

        if (!element) {
            return;
        }

        var options = {
            series: [74],
            chart: {
                height: height,
                type: 'radialBar',
                offsetY: 0
            },
            plotOptions: {
                radialBar: {
                    startAngle: -90,
                    endAngle: 90,

                    hollow: {
                        margin: 0,
                        size: "70%"
                    },
                    dataLabels: {
                        showOn: "always",
                        name: {
                            show: true,
                            fontSize: "13px",
                            fontWeight: "700",
                            offsetY: -5,
                            color: KTApp.getSettings()['colors']['gray']['gray-500']
                        },
                        value: {
                            color: KTApp.getSettings()['colors']['gray']['gray-700'],
                            fontSize: "30px",
                            fontWeight: "700",
                            offsetY: -40,
                            show: true
                        }
                    },
                    track: {
                        background: KTApp.getSettings()['colors']['theme']['light']['primary'],
                        strokeWidth: '100%'
                    }
                }
            },
            colors: [KTApp.getSettings()['colors']['theme']['base']['primary']],
            stroke: {
                lineCap: "round",
            },
            labels: ["Cumplido"]
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    }
			_progresoMP();
	});
</script>
@endsection
