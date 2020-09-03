<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        {{-- Header --}}
        @include('partials.admin.header')

        {{-- Page Specific Stylesheets --}}
        @yield('stylesheets')

    </head>

    <body>

        {{-- Page Wrapper --}}
        <div class="page-wrapper chiller-theme sidebar-bg bg1 toggled">

            {{-- Sidebar --}}
            @include('partials.admin.sidebar')

            <main class="page-content">
                <div class="container-fluid">
                    {{-- Authentication Debug Component --}}
                    {{-- @component('components.debug.auth')
                    @endcomponent --}}

                    <h3>@yield('title')</h3>
                    <hr>

                    {{-- Flash Messages --}}
                    @include('partials.admin.messages')

                    @yield('content')

                    {{-- Footer --}}
                    @include('partials.admin.footer')
                </div>
            </main> <!-- /.page-content -->

        </div> <!-- /.page-wrapper -->

        <!-- Scripts -->
        @include('partials.admin.scripts')

        {{-- Page Specific Scripts --}}
        @yield('scripts')

    </body>

</html>
