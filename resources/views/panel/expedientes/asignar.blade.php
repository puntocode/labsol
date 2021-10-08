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
        const updateTecnicos = "{{ route('panel.expedientes.update_tecnicos') }}";
        const tecnicos = "{{ route('panel.usuarios.tecnicos') }}";
        const expedienteEspera = "{{ route('panel.expedientes.espera') }}";

        window.routes = {
            'updateTecnicos': updateTecnicos,
            'tecnicos': tecnicos,
            'expedientes': expedienteEspera
        }
    </script>
@endsection

