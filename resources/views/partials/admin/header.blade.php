{{-- ========== Meta Data ==========--}}
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="Maine Sky Pixels - FAA Licensed Drone Operations">
<meta name="author" content="jdswebservice.com">
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- CSRF Token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Website Title --}}
<title>Maine Sky Pixels - Admin @yield('title')</title>

{{-- Favicon --}}
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

{{--****************
    Dependancies
****************--}}

{{-- Bootstrap CSS --}}
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

{{-- Font-Awesome --}}
<script src="https://kit.fontawesome.com/0d9c5a4db2.js" crossorigin="anonymous"></script>

<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

<!-- Custom Scrollbar CSS -->
<link rel="stylesheet" href="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css">

<link rel="stylesheet" href="/css/admin/admin.css?v={{ strtotime(\Carbon\Carbon::now()) }}">
<link rel="stylesheet" href="/css/admin/admin-custom.css?v={{ strtotime(\Carbon\Carbon::now()) }}">
<link rel="stylesheet" href="/css/admin/admin-themes.css?v={{ strtotime(\Carbon\Carbon::now()) }}">
<link rel="stylesheet" href="/css/admin/slate.css?v={{ strtotime(\Carbon\Carbon::now()) }}">
