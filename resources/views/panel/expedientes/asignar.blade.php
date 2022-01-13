@extends('layouts.panel')

@section('title')Expedientes |@endsection

@section('styles')
	<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{asset('plugins/custom/kanban/kanban.bundle.css')}}">
@endsection

@section('content')
	<expediente-tecnicos></expediente-tecnicos>
@endsection


@section('rutas')
    <script>
        const TECNICOS = "{{ route('panel.usuarios.tecnicos') }}";
        const UPDATE_TECNICOS = "{{ route('panel.expedientes.update_tecnicos') }}";
        const EXPEDIENTE_ESPERA = "{{ route('panel.expedientes.espera') }}";

        window.routes = {
            'tecnicos': TECNICOS,
            'expedientes': EXPEDIENTE_ESPERA,
            'updateTecnicos': UPDATE_TECNICOS,
        }
    </script>
@endsection

