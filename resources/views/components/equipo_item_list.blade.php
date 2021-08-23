@if(isset($equipo) && $equipo != NULL)
	<!--begin::Item-->
	<div class="d-flex mb-10">
		<!--begin::Symbol-->
		<div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
			<div class="symbol-label" style="background-image: url('{{$equipo->imagen}}')"></div>
		</div>
		<!--end::Symbol-->

		<!--begin::Title-->
		<div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 position-relative">
			<a href="#" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg" title="Ver detalles">{{$equipo->titulo}}</a>
			<span class="text-muted font-weight-bold">{{$equipo->codigo}}</span>

			<div class="position-absolute right-0">
				<i class="far fa-star mr-1 text-warning font-size-lg"></i>
			</div>

			<span class="text-muted font-weight-bold mt-2 small">
			    <span class="mr-2"><i class="far fa-user"></i> {{$equipo->usuario}}</span>
			    <span class="mr-2"><i class="far fa-building"></i> {{$equipo->area}}</span>
			    <span class="mr-2"><i class="far fa-calendar-alt"></i> {{$equipo->tasks}}</span>
			    <span><i class="fas fa-map-marker-alt"></i> {{$equipo->ubicacion}}</span>
			</span>
		</div>
		<!--end::Title-->
	</div>
	<!--end::Item-->
@endif