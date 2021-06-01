<!DOCTYPE html>
<html lang="es">
    <!--begin::Head-->
    <head>
        <meta charset="utf-8" />
        <title>Panel Labsol</title>
        <meta name="description" content="Panel Administrativo Labsol" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="canonical" href="https://keenthemes.com/metronic" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <link href="{{asset('css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/pages/login/login-1.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

        <!--end::Layout Themes-->

        @include('layouts.partials.extras._favicon')

    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        <!--begin::Main-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Login-->
            <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
                <!--begin::Aside-->
                <div class="login-aside d-flex position-relative flex-column flex-row-auto justify-content-center" style="background-image: url({{asset('media/fondos/fondo-tomografia.jpeg')}}); background-repeat: no-repeat; background-size: cover">
                    <!--begin::Aside Top-->
                    <div class="d-flex flex-column-auto flex-column pt-0">
                        <h3 class="font-weight-bolder text-center text-white" style="font-size: 2.5rem">Bienvenido a <strong>Labsol</strong></h3>
                        <span class="font-weight-bold font-size-h4 text-white text-center">Panel Administrativo</span>
                    </div>
                    <!--end::Aside Top-->

                    <!--begin::Content footer-->
                    <div class="d-flex py-7 py-lg-0 aside-footer">
                        <div class="text-white font-size-lg font-weight-bolder mr-10">
                            <span class="mr-1">2021©</span>
                            <a href="http://www.porta.com.py" target="_blank" class="text-white text-hover-primary">Porta Agencia Web</a>
                        </div>
                        <a href="mailto:soporte@porta.com.py" class="text-white ml-5 font-weight-bolder font-size-lg"><i class="far fa-envelope text-white mr-2"></i> Contacto</a>
                    </div>
                    <!--end::Content footer-->
                </div>
                <!--begin::Aside-->

                <!--begin::Content-->
                <div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
                    <!--begin::Content body-->
                    <div class="d-flex flex-column-fluid flex-center">
                        <!--begin::Signin-->
                        <div class="login-form login-signin">
                            <!--begin::Form-->
                            <form class="form" novalidate="novalidate" action="#!" id="MainLogin">
                                {{ csrf_field() }}

                                <!--begin::Title-->
                                <div class="pb-13 pt-lg-0 pt-5 text-center">
                                    <img src="{{asset('media/logos/logo_color_large.png')}}" class="max-h-100px" alt="" />
                                </div>
                                <!--begin::Title-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <label class="font-size-sm font-weight-bolder text-dark">Email</label>
                                    <input class="form-control py-6 px-6" type="email" name="email" autocomplete="off" required="" />
                                    @if ($errors->has('email'))
                                        <div class="error ml40 mt20">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <div class="d-flex justify-content-between mt-n5">
                                        <label class="font-size-sm font-weight-bolder text-dark pt-5">Contraseña</label>
                                    </div>
                                    <input class="form-control py-6 px-6" type="password" name="password" autocomplete="off" required/>
                                    @if ($errors->has('password'))
                                        <div class="error ml40 mt20">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <!--end::Form group-->
                                <!--begin::Action-->
                                <div class="pb-lg-0 pb-5 text-center mb-5">
                                    <button type="submit" id="kt_login_signin_submit" class="btn btn-primary font-weight-bolder font-size-h6 my-5 mr-3">Ingresar</button>

                                    {{--<a href="{{route('panel.index')}}" id="kt_login_signin_submit" class="btn btn-primary font-weight-bolder font-size-h6 my-5 mr-3">Ingresar</a>--}}

                                </div>
                                <!--end::Action-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Signin-->
                    </div>
                    <!--end::Content body-->
                    <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0 text-center mx-auto">¿Olvidó su contraseña?
                        <a href="#!" class="text-primary font-weight-bolder font-size-lg ml-3 d-inline-block" style="text-decoration: underline;"> Recuperar</a>
                    </div>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Login-->
        </div>
        <!--end::Main-->
        <!--begin::Global Config(global config for global JS scripts)-->
        <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
        <!--end::Global Config-->

        <!--begin::Global Theme Bundle(used by all pages)-->
        <script src="{{asset('plugins/global/plugins.bundle.js')}}"></script>
        <script src="{{asset('js/scripts.bundle.js')}}"></script>
        <!--end::Global Theme Bundle-->
        <!--begin::Page Scripts(used by this page)-->
        <script src="{{--asset('js/pages/custom/login/login-general.js')--}}"></script>
        <!--end::Page Scripts-->

        <script>
            $('#MainLogin').submit(function(e){
                console.log("aja")
                e.preventDefault();
                e.stopPropagation();

                var form = $('#MainLogin').serialize();

                $.ajax( {
                    type: "POST",
                    url: "{{ route('ajax.auth.login') }}",
                    dataType:'json',
                    data: form,
                    success: function( data ) {
                        if (data.success) {
                            console.log("logueado")
                            location.href="{{route('panel.index')}}"
                        }else {
                            console.log("NO logueado")
                        }
                    },
                    error:function(data){
                        $('body').addClass("loaded");
                        console.log("ERRORS")
                    }
                } );
            });
        </script>
    </body>
    <!--end::Body-->
</html>
