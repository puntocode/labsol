@extends('layouts.panel')

@section('title')Procedimientos |@endsection
@section('meta')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
        <h3 class="card-label mb-8">Procedimientos <small class="font-weight-lighter">| Documentos</small> </h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
				<div class="card card-custom card-fixed gutter-b">
					<div class="card-body ">
                        <div class="flex-grow-1">
                            <a href="{{ route('panel.procedimientos.show', $procedimiento) }}" class="as-text text-hover-primary" title="Ver detalles del procedimiento">
                                <i class="fas fa-arrow-left text-hover-primary mr-2"></i> Ir al procedimiento
                            </a>
                            <hr>
                        </div>

                        <div class="flex-grow-1">
                            <a href="{{ route('panel.procedimientos.create') }}" class="as-text text-hover-primary" title="Eliminar este Patrón">
                                <i class="far fa-plus-square text-hover-primary mr-2"></i> Nuevo procedimiento
                            </a>
                            <hr>
                        </div>

                        <div class="flex-grow-1">
                            <a href="{{ route('panel.procedimientos.index') }}" class="as-text text-hover-primary" title="Ir a listado de patrones">
                                <i class="fas fa-list text-hover-primary mr-2"></i> Ir a la Lista
                            </a>
                        </div>
					</div>
				</div>
			</div>

            <div class="col-lg-9 col-xl-10">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <div class="card-title pt-8 border-bottom w-100">
                            <h3 class="font-weight-bolder text-dark">Subida de Documentos</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <Documentos url="{{ route('panel.procedimientos.doc.store', $procedimiento->id) }}" folder="procedimientos/" category="DOCUMENTOS" />
                    </div>
                </div>

            </div>
		</div>



    </div>
@endsection
@section('rutas')
<script>
    const url = "{{ route('panel.procedimientos.doc.store', $procedimiento->id) }}";
    window.routes = {
        'url': url,
    }
</script>
@endsection
