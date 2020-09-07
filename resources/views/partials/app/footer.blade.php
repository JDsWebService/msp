<!-- footer Start -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-manu">
                    <ul>
                        <li><a href="#about" class="scrollto">About Us</a></li>
                        <li><a href="#contact" class="scrollto">Contact Us</a></li>
                        <li><a href="#service" class="scrollto">Services</a></li>
                    </ul>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-4">
                        <img src="/imgs/droners_badge.png" alt="" class="w-50 img-fluid mb-2">
                        <p class="copyright">
                            &copy; {{ config('app.name', 'Maine Sky Pixels') }} {{ \Carbon\Carbon::now()->year }} - All Rights Reserved
                            <br>
                            Developed by <a href="http://jdswebservice.com/" target="_blank">JD's Web Service</a>
                            <span class="text-muted">#1319099</span>
                            <br>
                            @guest
                                <a href="{{ route('login') }}">Webmaster Login</a>
                            @endguest
                            @auth
                                <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                            @endauth
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
