<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en">
<head>
	@include('partials.auth.header')
</head>
    <body>

    {{-- Preloader --}}
    @include('partials.app.preloader')

        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-form-title" style="background-image: url('/imgs/hero_background.png');">
                        <span class="login100-form-title-1">
                            @yield('title')
                        </span>
                    </div>

                    @include('partials.auth.messages')

                    @yield('content')
                </div>
            </div>
        </div>

    @include('partials.auth.scripts')

    </body>
</html>
