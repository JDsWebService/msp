{{-- ========== Meta Data ==========--}}
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="Maine Sky Pixels - FAA Licensed Drone Operations">
<meta name="author" content="jdswebservice.com">
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- CSRF Token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Website Title --}}
<title>Maine Sky Pixels - @yield('title')</title>

{{-- Favicon --}}
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />

{{--****************
    Dependancies
****************--}}

{{-- Bootstrap 4 CSS --}}
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
{{-- jQuery Megnific Popup --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
{{-- Slick Carousel --}}
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
{{-- Ionic Icon Css --}}
<link rel="stylesheet" href="/plugins/app/Ionicons/css/ionicons.min.css">
{{-- animate.css --}}
{{--<link rel="stylesheet" href="/plugins/app/animate-css/animate.css">--}}
{{-- Google ReCAPTCHA --}}
<script src="https://www.google.com/recaptcha/api.js"></script>

{{-- Main Stylesheet --}}
<link rel="stylesheet" href="/css/app/style.css?v={{ strtotime(\Carbon\Carbon::now()) }}">
{{-- Preloader --}}
<link rel="stylesheet" href="/css/app/preloader.css?v={{ strtotime(\Carbon\Carbon::now()) }}">
{{-- Overrides --}}
<link rel="stylesheet" href="/css/app/overrides.css?v={{ strtotime(\Carbon\Carbon::now()) }}">

