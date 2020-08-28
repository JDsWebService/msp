<!-- footer Start -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-manu">
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">How it works</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Terms</a></li>
                    </ul>
                </div>
                <p class="copyright">
                    &copy; {{ config('app.name', 'Maine Sky Pixels') }} {{ \Carbon\Carbon::now()->year }} - All Rights Reserved
                    <br>
                    Developed by <a href="http://jdswebservice.com/" target="_blank">JD's Web Service</a>
                    <span class="text-muted">#1319099</span>
                </p>
            </div>
        </div>
    </div>
</footer>