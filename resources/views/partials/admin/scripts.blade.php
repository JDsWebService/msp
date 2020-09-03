<!-- Main jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- Bootstrap 4 -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
<!-- Tilt.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>
<!-- Parallax -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-parallax/1.1.3/jquery-parallax-min.js"></script>
<!-- lightbox -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.2/js/lightbox.min.js"></script>
<!-- Slick Carousel -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<!-- Portfolio Filtering -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/filterizr/2.2.4/jquery.filterizr.min.js"></script>
<!-- Smooth Scroll js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scroll/16.1.3/smooth-scroll.min.js"></script>
<!-- Form Validation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

{{-- Admin Template Specific JS --}}
<script src="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="/js/admin/admin.js?v={{ strtotime(\Carbon\Carbon::now()) }}"></script>

{{-- FileUpload Script --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#fileUpload').change(function (e) {
            var fileName = e.target.files[0].name;
            $('#fileUploadPTag').text("Uploading file: " + fileName);
        });
    });
</script>
