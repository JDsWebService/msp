{{-- Closed Sidebar Bars --}}
<a id="show-sidebar" class="btn btn-sm btn-light" href="#">
    <i class="fas fa-bars"></i>
</a>
{{-- Sidebar --}}
<nav id="sidebar" class="sidebar-wrapper">

    {{-- Sidebar Content --}}
    <div class="sidebar-content">

        {{-- Branding --}}
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">{{ config('app.name', 'Laravel') }}</a>
            <div id="close-sidebar">
                <i class="fas fa-times"></i>
            </div>
        </div>

        {{-- User Information --}}
        <div class="sidebar-header">
            <div class="user-pic">
                <img class="img-responsive img-rounded" src="/imgs/admin/user.jpg" alt="User picture">
            </div>
            <div class="user-info">
                <span class="user-name">{{ Auth::user()->name }}</span>
                <span class="user-role">Administrator</span>
                <span class="user-status">
                    <i class="fa fa-circle"></i>
                    <span>Online</span>
                </span>
            </div>
        </div>

        {{-- Sidebar Menu --}}
        <div class="sidebar-menu">
            <ul>

                {{-- Header --}}
                <li class="header-menu">
                    <span>General</span>
                </li>

                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-house-user"></i>
                        <span>Admin Home</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('index') }}">
                        <i class="fas fa-home"></i>
                        <span>Site Home</span>
                    </a>
                </li>

                {{-- Dropdown --}}
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fas fa-server"></i>
                        <span>Portfolio</span>
                        {{-- <span class="badge badge-pill badge-primary">3</span> --}}
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="far fa-eye"></i> View All Images
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="far fa-plus-square"></i> Add New Image
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Header --}}
                <li class="header-menu">
                    <span>Sidebar Header</span>
                </li>
                {{-- Menu Item w/o Dropdown --}}
                <li>
                    <a href="#">
                        <i class="fa fa-calendar"></i>
                        <span>Link</span>
                    </a>
                </li>

            </ul>
        </div> <!-- ./sidebar-menu  -->

    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">

        {{--
        <div class="dropdown">

            <a href="#" class="" id="test" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-envelope"></i>
                <span class="badge badge-pill badge-success notification">7</span>
            </a>

            <div class="dropdown-menu messages" aria-labelledby="test">
                <div class="messages-header">
                    <i class="fa fa-envelope"></i>
                    Messages
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <div class="message-content">
                        <div class="pic">
                            <img src="assets/img/user.jpg" alt="">
                        </div>
                        <div class="content">
                            <div class="message-title">
                                <strong> Jhon doe</strong>
                            </div>
                            <div class="message-detail">Lorem ipsum dolor sit amet consectetur adipisicing elit. In totam explicabo</div>
                        </div>
                    </div>

                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center" href="#">View all messages</a>

            </div>
        </div>
        --}}

        {{-- Admin Settings --}}
        {{-- <div class="dropdown">
            <a href="#" class="" id="adminUserSettings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog"></i>
                <span class="badge-sonar"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="adminUserSettings">
                <a class="dropdown-item" href="#">My profile</a>
                <a class="dropdown-item" href="#">Help</a>
                <a class="dropdown-item" href="#">Setting</a>
            </div>
        </div> --}}

        {{-- Logout --}}
        <div>
            <a href="{{ route('logout') }}">
                <i class="fa fa-power-off"></i>
            </a>
        </div>

    </div> <!-- /.sidebar-footer -->

</nav>
