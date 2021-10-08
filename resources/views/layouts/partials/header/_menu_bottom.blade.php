<!--begin::Bottom-->
<div class="header-bottom">
	<!--begin::Container-->
	<div class="container-fluid">
		<!--begin::Header Menu Wrapper-->
		<div class="header-navs header-navs-left" id="kt_header_navs">
			<span class="mobile-menu-close position-absolute">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
					<line x1="18" y1="6" x2="6" y2="18"></line>
					<line x1="6" y1="6" x2="18" y2="18"></line>
				</svg>
			</span>

			<!--begin::Tab Navs(for tablet and mobile modes)-->
			<ul class="header-tabs mt-10 p-5 p-lg-0 d-flex d-lg-none nav nav-bold nav-tabs" role="tablist">
				@include('layouts.partials.header._nav_top')
			</ul>
			<!--begin::Tab Navs-->

			<!--begin::Tab Content-->
			<div class="tab-content">
				<!--begin::Tab Pane Home-->
				<div class="tab-pane py-5 p-lg-0 @if (Request::is('panel') || Request::is('panel/perfil/dashboard') || Request::is('panel/perfil/informes*')) show active @endif" id="kt_header_tab_1">
					<!--begin::Menu-->
					<div class="header-menu header-menu-mobile header-menu-layout-default">
						<!--begin::Nav-->
						<ul class="menu-nav">
							<li class="menu-item @if (Request::is('panel') || Request::is('panel/perfil/dashboard')) menu-item-active @endif" aria-haspopup="true">
								<a href="{{route('panel.index')}}" class="menu-link" title="Ir a dashboard principal">
									<span class="menu-text">Dashboard</span>
								</a>
							</li>
						</ul>
						<!--end::Nav-->
					</div>
					<!--end::Menu-->
				</div>
				<!--begin::Tab Pane Home-->

				<!--begin::Tab Pane Clientes-->
				<div class="tab-pane py-5 p-lg-0 @if (Request::is('panel/clientes*')) show active @endif" id="kt_header_tab_2">
					<div class="header-menu header-menu-mobile header-menu-layout-default">
						<ul class="menu-nav">
							<li class="menu-item @if (Request::is('panel/clientes')) menu-item-active @endif" aria-haspopup="true">
								<a href="{{route('panel.clientes.index')}}" class="menu-link">
									<span class="menu-text">Listar clientes</span>
								</a>
							</li>
                            <li class="menu-item @if (Route::currentRouteName() == 'panel.clientes.create') menu-item-active @endif" aria-haspopup="true">
                                <a href="{{route('panel.clientes.create')}}" class="menu-link">
                                    <span class="menu-text">Crear cliente</span>
                                </a>
                            </li>
						</ul>
					</div>
				</div>
				<!--begin::Tab Pane Clientes -->

				<!--begin::Tab Pane Equipos-->
				<div class="tab-pane py-5 p-lg-0 @if (Request::is('panel/entrada-instrumentos*')) show active @endif" id="kt_header_tab_3">
					<!--begin::Menu-->
					<div class="header-menu header-menu-mobile header-menu-layout-default">
						<!--begin::Nav-->
						<ul class="menu-nav">
							<li class="menu-item @if (Route::currentRouteName() == 'panel.entrada-instrumentos.index') menu-item-active @endif" aria-haspopup="true">
								<a href="{{route('panel.entrada-instrumentos.index')}}" class="menu-link" title="Ir al listado de equipos">
									<span class="menu-text">Listar entradas</span>
								</a>
							</li>
							@can('panel.admin')
							<li class="menu-item @if (Route::currentRouteName() == 'panel.entrada-instrumentos.create') menu-item-active @endif" aria-haspopup="true">
								<a href="{{route('panel.entrada-instrumentos.create')}}" class="menu-link" title="Ir al listado de equipos">
									<span class="menu-text">Crear entradas</span>
								</a>
							</li>
							@endcan
						</ul>
						<!--end::Nav-->
					</div>
					<!--end::Menu-->
				</div>
				<!--begin::Tab Pane Equipos -->

				<!--begin::Tab Pane Expedientes -->

				<div class="tab-pane py-5 p-lg-0 @if (Request::is('panel/expediente*') || Request::is('panel/perfil/actividades*')) show active @endif" id="kt_header_tab_4">
					<!--begin::Menu-->
					<div class="header-menu header-menu-mobile header-menu-layout-default">
						<!--begin::Nav-->
						<ul class="menu-nav">
							@can('panel.admin')
                                <li class="menu-item @if (Route::currentRouteName() == 'panel.expedientes.index') menu-item-active @endif" aria-haspopup="true">
                                    <a href="{{route('panel.expedientes.index')}}" class="menu-link" title="Ir al listado de expedientes">
                                        <span class="menu-text">Listar expedientes</span>
                                    </a>
                                </li>

                                <li class="menu-item @if (Route::currentRouteName() == 'panel.expedientes.asignar') menu-item-active @endif" aria-haspopup="true">
                                    <a href="{{route('panel.expedientes.asignar')}}" class="menu-link" title="Asignar Técnicos a Expedientes">
                                        <span class="menu-text">Asignar Técnicos</span>
                                    </a>
                                </li>
							@endcan

							<li class="menu-item @if (Route::currentRouteName() == 'panel.expedientes.agenda' || Request::is('panel/expedientes/agendamientos*')) menu-item-active @endif" aria-haspopup="true">
								<a href="{{route('panel.expedientes.agenda')}}" class="menu-link" title="Explorar el calendario">
									<span class="menu-text">Agenda</span>
								</a>
							</li>

							@can('panel.tecnico')
								<li class="menu-item @if (Request::is('panel/perfil/actividades*')) menu-item-active @endif" aria-haspopup="true">
									<a href="{{route('panel.perfil.actividades.index')}}" class="menu-link" title="Ir al mis actividades asignadas">
										<span class="menu-text">Mis Actividades</span>
									</a>
								</li>
							@endcan
						</ul>
						<!--end::Nav-->
					</div>
					<!--end::Menu-->
				</div>


				<!--begin::Tab Pane Técnicos -->
				<div class="tab-pane py-5 p-lg-0 @if (Request::is('panel/calibracion*')) show active @endif" id="kt_header_tab_5">
					<!--begin::Menu-->
					<div class="header-menu header-menu-mobile header-menu-layout-default">
						<!--begin::Nav-->
						<ul class="menu-nav">

							@can('panel.admin')
								<li class="menu-item @if (Route::currentRouteName() == 'panel.calibracion.create') menu-item-active @endif" aria-haspopup="true">
									<a href="{{route('panel.calibracion.create')}}" class="menu-link" title="Crear calibración">
										<span class="menu-text">Crear Calibración</span>
									</a>
								</li>
							@endcan

								<li class="menu-item @if (Route::currentRouteName() == 'panel.calibracion.certificados.index') menu-item-active @endif" aria-haspopup="true">
									<a href="{{route('panel.calibracion.certificados.index')}}" class="menu-link" title="Ver certificados">
										<span class="menu-text">Certificados</span>
									</a>
								</li>
						</ul>
						<!--end::Nav-->
					</div>
					<!--end::Menu-->
				</div>
				<!--begin::Tab Pane  -->
				<div class="tab-pane py-5 p-lg-0 @if (Request::is('panel/egreso-instrumentos*') || Request::is('panel/facturacion*')) show active @endif" id="kt_header_tab_6">
					<!--begin::Menu-->
					<div class="header-menu header-menu-mobile header-menu-layout-default">
						<!--begin::Nav-->
						<ul class="menu-nav">
							<li class="menu-item @if (Route::currentRouteName() == 'panel.egreso.index') menu-item-active @endif" aria-haspopup="true">
								<a href="{{route('panel.egreso.index')}}" class="menu-link" title="Ir al listado de egresos">
									<span class="menu-text">Listar egresos</span>
								</a>
							</li>

							@can('panel.admin')
								<li class="menu-item @if (Route::currentRouteName() == 'panel.egreso.create') menu-item-active @endif" aria-haspopup="true">
									<a href="{{route('panel.egreso.create')}}" class="menu-link" title="Crear egreso">
										<span class="menu-text">Crear egreso</span>
									</a>
								</li>
							@endcan

							@can('panel.admin')
								<li class="menu-item @if (Route::currentRouteName() == 'panel.facturacion.index') menu-item-active @endif" aria-haspopup="true">
									<a href="{{route('panel.facturacion.index')}}" class="menu-link" title="Facturación">
										<span class="menu-text">Facturación</span>
									</a>
								</li>
							@endcan
						</ul>
						<!--end::Nav-->
					</div>
					<!--end::Menu-->
				</div>

			</div>
			<!--end::Tab Content-->
		</div>
		<!--end::Header Menu Wrapper-->
	</div>
	<!--end::Container-->
</div>
<!--end::Bottom-->
