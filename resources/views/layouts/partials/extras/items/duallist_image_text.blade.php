@if($item != NULL)
	<div class="duallist-item d-flex align-items-center @if($item->disponibilidad != 'disponible') not-draggable @endif">
	    <div class="symbol symbol-success mr-3">
	        <span class="symbol-label font-size-h4">{{$item->abreviatura}}</span>
	    </div>

	    <div class="d-flex flex-column align-items-start">
	        <span class="text-dark-50 font-weight-bold mb-1">{{$item->nombre}}</span>
	        <span class="label label-inline label-light-{{$item->disponibilidad=='disponible' ? 'success' : 'danger'}} font-weight-bold">{{$item->disponibilidad}}</span>
	    </div>
	</div>
@endif