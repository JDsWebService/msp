<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<head>
    @include('partials.app.header')
</head>

<body id="body">

    {{-- Navigation Bar --}}
    @include('partials.app.navbar')

    {{-- Content Pulled From Page --}}
    @yield('content')
    
    {{-- Footer --}}
    @include('partials.app.footer')

    {{-- App Scripts --}}
    @include('partials.app.scripts')

</body>

</html>
