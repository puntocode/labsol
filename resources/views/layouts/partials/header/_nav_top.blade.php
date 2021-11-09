<!--begin::Item-->
<li class="nav-item">
    <a href="#" class="nav-link py-4 px-6 @if (Request::is('panel') ||
        Request::is('panel/perfil/dashboard') || Request::is('panel/perfil/informes*')) active @endif" data-toggle="tab" data-target="#kt_header_tab_1" role="tab">Inicio</a>
</li>
<!--end::Item-->

@can('panel.database')
    <li class="nav-item mr-3">
        <a href="#" class="nav-link py-4 px-6 @if (Request::is('panel/clientes*')) active @endif" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">
            Clientes
        </a>
    </li>
@endcan

@can('panel.admin')

    <li class="nav-item mr-3">
        <a href="#" class="nav-link py-4 px-6 @if (Request::is('panel/entrada-instrumentos*')) active @endif" data-toggle="tab" data-target="#kt_header_tab_3" role="tab">
            Entrada Instrumentos
        </a>
    </li>

    <li class="nav-item mr-3">
        <a href="#" class="nav-link py-4 px-6 @if (Request::is('panel/expediente*')) active @endif" data-toggle="tab" data-target="#kt_header_tab_4" role="tab">
            Exp. de Calibración
        </a>
    </li>

    <li class="nav-item mr-3">
        <a href="#" class="nav-link py-4 px-6 @if (Request::is('panel/calibracion*')) active @endif" data-toggle="tab" data-target="#kt_header_tab_5" role="tab">
            Calibración
        </a>
    </li>

    <li class="nav-item mr-3">
        <a href="#" class="nav-link py-4 px-6 @if (Request::is('panel/egreso-instrumentos*') ||
            Request::is('panel/facturacion*')) active @endif" data-toggle="tab"
            data-target="#kt_header_tab_6" role="tab">
            Salida Instrumentos
        </a>
    </li>

    <!--begin::Item-->
    {{-- <li class="nav-item mr-3">
        <a href="#" class="nav-link py-4 px-6 @if (Route::currentRouteName() != 'panel.perfil.index' && (Request::is('panel/perfil/actividades*') || Request::is('panel/expedientes*'))) active @endif" data-toggle="tab"
            data-target="#kt_header_tab_4" role="tab">
            Actividades
        </a>
    </li> --}}
    <!--end::Item-->
@endcan
