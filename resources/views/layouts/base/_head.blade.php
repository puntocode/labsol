<!--begin::Head-->
<head>
	<base href="">
	<meta charset="utf-8" />
	<title>@yield('title') Panel Labsol</title>
	<meta name="description" content="Updates and statistics" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="canonical" href="https://keenthemes.com/metronic" />
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!--begin::Global Theme Styles(used by all pages)-->
	<link href="{{asset('plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('plugins/global/izitoast/css/iziToast.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
	<!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->
	@yield('styles')
	<!--end::Layout Themes-->

	@include('layouts.partials.extras._favicon')
</head>
<!--end::Head-->
