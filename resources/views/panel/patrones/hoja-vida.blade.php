@extends('layouts.base.hoja-vida')

@section('title', 'Patron')

@section('content')
    <hoja-vida :array="{{ $patron }}"></hoja-vida>
@endsection

@section('rutas')
    <script>
        const showRoute = "{{ route('panel.patrones.show', $patron->id) }}";
        const logo = "{{ asset('media/logos/logo_color_large.png') }}"

        window.routes = {
            'show' : showRoute,
            'logo' : logo
        }
    </script>
@endsection
