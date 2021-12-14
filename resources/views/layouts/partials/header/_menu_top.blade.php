<!--begin::Top-->
<div class="header-top">
	<!--begin::Container-->
	<div class="container-fluid">
		<!--begin::Left-->
		<div class="mr-3 d-none d-lg-flex align-items-center">
			<!--begin::Logo-->
			<a href="{{route('panel.index')}}" class="mr-5">
				<img alt="Logo" src="{{asset('media/logos/logo_color_large.png')}}" class="max-h-30px" />
			</a>
			<!--end::Logo-->

			<!--begin::Tab Navs(for desktop mode)-->
			<ul class="header-tabs nav align-self-end font-size-lg" role="tablist">
				@include('layouts.partials.header._nav_top')
			</ul>
			<!--begin::Tab Navs-->
		</div>
		<!--end::Left-->

		@include('layouts.partials.header._menu_topbar')

	</div>
	<!--end::Container-->
</div>
<!--end::Top-->
