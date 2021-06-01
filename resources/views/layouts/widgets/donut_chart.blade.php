<!--begin::Card-->
@if(isset($chart) && $chart != NULL)
	<div class="card card-custom card-stretch gutter-b">
		<div class="card-header border-0 pt-7">
			<div class="card-title">
				<h3 class="card-label">{{$chart->titulo}}</h3>
			</div>
		</div>
		<div class="card-body">
			<!--begin::Chart-->
			<div id="{{$chart->id}}" class="d-flex justify-content-center"></div>
			<!--end::Chart-->
		</div>
	</div>
@endif
<!--end::Card-->