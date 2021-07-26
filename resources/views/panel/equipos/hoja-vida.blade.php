@extends('layouts.base.hoja-vida')

@section('title', 'Equipo')

@section('content')
    <hoja-vida :array="{{ $equipo }}"></hoja-vida>
@endsection

@section('rutas')
    <script>
        const showRoute = "{{ route('panel.equipos.show', $equipo->id) }}";
        const logo = "{{ asset('media/logos/logo_color_large.png') }}"

        window.routes = {
            'show' : showRoute,
            'logo' : logo
        }
    </script>
@endsection
