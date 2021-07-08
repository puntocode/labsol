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
    <li class="nav-item mr-3">
        <a href="#" class="nav-link py-4 px-6 @if (Request::is('panel/calibracion*')) active @endif" data-toggle="tab" data-target="#kt_header_tab_5" role="tab">
            Calibración
        </a>
    </li>
@endcan

@if (\Auth::user()->hasAnyRole(['administrador', 'jefatura_calibracion', 'secretaria', 'jefatura_calidad']))

    <!--begin::Item-->
    <li class="nav-item mr-3">
        <a href="#" class="nav-link py-4 px-6 @if (Request::is('panel/entrada-instrumentos*')) active @endif" data-toggle="tab" data-target="#kt_header_tab_3" role="tab">
            Entrada Instrumentos
        </a>
        </>
        <!--end::Item-->
        <!--begin::Item-->
    <li class="nav-item mr-3">
        <a href="#" class="nav-link py-4 px-6 @if (Request::is('panel/expedientes*')) active @endif" data-toggle="tab" data-target="#kt_header_tab_4" role="tab">
            Expedientes de Calibración
        </a>
    </li>
    <!--end::Item-->
    {{-- @if (\Auth::user()->hasAnyRole(['administrador', 'jefatura_calibracion', 'tecnico', 'jefatura_calidad']))
        <!--begin::Item-->
        <li class="nav-item mr-3">
            <a href="#" class="nav-link py-4 px-6 @if (Request::is('panel/calibracion*')) active @endif" data-toggle="tab" data-target="#kt_header_tab_5" role="tab">
                Calibración
            </a>
        </li>
        <!--end::Item-->
    @endif --}}
    <!--begin::Item-->
    <li class="nav-item mr-3">
        <a href="#" class="nav-link py-4 px-6 @if (Request::is('panel/egreso-instrumentos*') ||
            Request::is('panel/facturacion*')) active @endif" data-toggle="tab"
            data-target="#kt_header_tab_6" role="tab">
            Salida de instrumento
        </a>
    </li>
    <!--end::Item-->


@elseif(\Auth::user()->hasRole('tecnico'))
    <!--begin::Item-->
    <li class="nav-item mr-3">
        <a href="#" class="nav-link py-4 px-6 @if (Route::currentRouteName()
            !='panel.perfil.index' && (Request::is('panel/perfil/actividades*') ||
            Request::is('panel/expedientes*'))) active @endif" data-toggle="tab"
            data-target="#kt_header_tab_4" role="tab">
            Actividades
        </a>
    </li>
    <!--end::Item-->
@endif
