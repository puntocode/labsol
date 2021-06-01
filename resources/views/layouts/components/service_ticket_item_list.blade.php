@if(isset($ticket) && $ticket != NULL)
	<div class="d-flex align-items-center mb-5 py-3 mr-5 item-left-border">
		<!--begin::Bullet-->
		<span class="bullet bullet-bar bg-success align-self-stretch"></span>
		<!--end::Bullet-->
		
		<!--begin::Text-->
		<div class="d-flex flex-column flex-grow-1 pl-5">
			<a href="{{!isset($view_mode) || $view_mode ==  NULL ? route('panel.serviceTickets.edit', $ticket->id - 1) : route('panel.serviceTickets.show', $ticket->id - 1)}}" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1" title="Ver detalles de Ticket">{{$ticket->asunto}}</a>
			<span class="text-muted font-weight-bold status-icons d-flex flex-wrap flex-column flex-md-row">
				<span class="d-inline mr-3 mt-1 mb-3 mb-md-1"><i class="fas fa-tag"></i> Artis Q.zen biplane</span>
				<span class="d-inline mr-3 mt-1 mb-3 mb-md-1"><i class="fas fa-columns"></i> {{$ticket->nro_serie}}</span>
				<span class="d-inline mr-3 mt-1 mb-3 mb-md-1"><i class="far fa-user"></i> {{$ticket->tecnico}}</span>
				<span class="d-inline mr-3 mt-1 mb-3 mb-md-1"><i class="far fa-clock"></i> {{$ticket->fecha_creacion }}. {{$ticket->hora_creacion}}</span>
				<span class="d-inline mr-3 mt-1 mb-3 mb-md-1 text-uppercase"><i class="fas fa-info"></i> {{$ticket->estatus_llamada}}</span>
			</span>
		</div>
		<!--end::Text-->

		<span class="badge 
			@if($ticket->prioridad == 'baja') 
				badge-success 
			@elseif($ticket->prioridad = 'media') 
				badge-warning 
			@else
				badge-danger
			@endif 
			ml-5 ml-md-0 mt-2 mt-md-0">{{$ticket->prioridad}}</span>
	</div>
@endif