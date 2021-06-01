@if(isset($card) && $card != NULL)
	<div class="col-md-6 col-lg-3 col-xl-2 nav-item">
		<a class="card card-custom {{$card->style['color']}} gutter-b card-stretch nav-link p-0" data-toggle="tab" href="#card-{{$card->id}}" style="min-height: 200px">
			<div class="card-body d-flex flex-column text-white">
				<div class="d-flex align-items-center justify-content-between flex-grow-1">
					<div class="mr-2">
						<i class="{{$card->style['icon']}} fa-2x text-white"></i>
					</div>

					<div class="font-weight-boldest font-size-h1 text-right text-white">{{$card->valor}}
						<p class="font-weight-normal font-size-sm mt-0 d-block">{{$card->descripcion}}</p>
					</div>

				</div>

				<div class="pt-8">
					<p class="h6 text-white">{{$card->titulo}}</p>
				</div>
			</div>
		</a>


	</div>
@endif
