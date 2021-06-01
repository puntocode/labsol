<!DOCTYPE html>
<html lang="es">
	@include('layouts.base._head')

	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed header-bottom-enabled page-loading">
		<!--begin::Main-->
		@include('layouts.partials.header._mobile')
		<!--end::Main-->

		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper mt-5" id="kt_wrapper">

					@include('layouts.partials.header._main_menu')

					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						@yield('content')
					</div>
					<!--begin::Content-->


					<!--begin::Footer-->
					<div class="footer bg-white d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
					        <!--begin::Copyright-->
					        <div class="text-dark order-2 order-md-1">
					            <span class="text-muted font-weight-bold mr-2">2021 ©</span>
					            <a href="https://www.porta.com.py/" target="_blank" class="text-dark-75 text-hover-primary">Porta
					                Agencia Web</a>
					        </div>
					        <!--end::Copyright-->
					        <!--begin::Nav-->
					        <div class="nav nav-dark order-1 order-md-2">
					            <a href="mailto:soporte@porta.com.py" target="_blank" class="nav-link pl-3 pr-0">Contacto</a>
					        </div>
					        <!--end::Nav-->
					    </div>
						<!--end::Container-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Page-->

		@include('layouts.partials.extras.offcanvas._user_preview')

		@yield('modales')

		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{asset('plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('js/scripts.bundle.js')}}"></script>
		<!--end::Page Vendors-->

		<script>
			$('.select-basic').select2({
   		    	minimumResultsForSearch: -1,
   		    	width: 'resolve'
  			});

  			$('.select-search').select2({
  				 width: 'resolve'
  			});

  			$('#kt_header_mobile_toggle').click(function (e) {
		        $('#kt_header_navs').addClass('header-navs-on');
		    });

		    $('.mobile-menu-close').click(function () {
		        $('#kt_header_navs').removeClass('header-navs-on');
		    });
		</script>

		@yield('scripts')
	</body>
	<!--end::Body-->
</html>
