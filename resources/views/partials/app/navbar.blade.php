<header class="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- header Nav Start -->
                <nav class="navbar navbar-expand-md">

                    {{-- Brand Image --}}
                    <a class="navbar-brand" href="{{ route('index') }}">
                        <img src="/imgs/drone.png" style="width: 50px; height: 50px;" alt="Logo">
                        Maine Sky Pixels
                    </a>

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <button type="button" class="navbar-toggler collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span>
                    &#x2630;</button>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav ml-auto">
                            {{-- Link --}}
                            <li class="nav-item">
                                <a href="{{ route('index') }}" class="nav-link">Home</a>
                            </li>
                            {{-- Dropdown --}}
                            <!--
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Portfolio</a>
                                <ul class="dropdown-menu">
                                    {{-- Menu Link --}}
                                    <li class="dropdown-item">
                                        <a href="#">Portfolio Filter</a>
                                    </li>
                                    {{-- Menu Link --}}
                                    <li class="dropdown-item">
                                        <a href="#">Portfolio Single</a>
                                    </li>
                                </ul>
                            </li> -->
                            {{-- Link --}}
                            <li class="nav-item">
                                <a href="#about" class="nav-link scrollto">About Us</a>
                            </li>
                            {{-- Link --}}
                            <li class="nav-item">
                                <a href="#service" class="nav-link scrollto">Services</a>
                            </li>
                            {{-- Link --}}
                            <li class="nav-item">
                                <a href="#contact" class="nav-link scrollto">Contact</a>
                            </li>
                        </ul> {{-- /nav navbar-nav ml-auto --}}
                    </div> {{-- /collapse navbar-collapse --}}
                </nav>
            </div> {{-- /col-lg-12 --}}
        </div> {{-- /row --}}
    </div> {{-- /container --}}
</header>