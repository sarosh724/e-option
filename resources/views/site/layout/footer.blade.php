<!-- Start Footer
    ============================================= -->
<footer class="bg-dark text-light">
    <div class="container">
        <div class="f-items default-padding">
            <div class="row">
                <div class="col-lg-4 col-md-6 item">
                    <div class="f-item about">
                        <img src="assets/site/img/logo-light.png" alt="Logo">
                        <p>
                            Required honoured trifling eat pleasure man relation. Assurance yet bed was improving furniture man. Distrusts delighted
                        </p>
                        <div class="address">
                            <ul>
                                <li>
                                    <div class="icon">
                                        <i class="flaticon-email"></i>
                                    </div>
                                    <div class="info">
                                        <h5>Email:</h5>
                                        <span>support@validtemplates.com</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="flaticon-call"></i>
                                    </div>
                                    <div class="info">
                                        <h5>Phone:</h5>
                                        <span>+44-20-7328-4499</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="single-item col-lg-2 col-md-6 item">
                    <div class="f-item link">
                        <h4 class="widget-title">Department</h4>
                        <ul>
                            <li>
                                <a href="#">Medecine & Health</a>
                            </li>
                            <li>
                                <a href="#">Dental Care</a>
                            </li>
                            <li>
                                <a href="#">Eye Treatment</a>
                            </li>
                            <li>
                                <a href="#">Children Chare</a>
                            </li>
                            <li>
                                <a href="#">Traumatology</a>
                            </li>
                            <li>
                                <a href="#">X-ray</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="single-item col-lg-2 col-md-6 item">
                    <div class="f-item link">
                        <h4 class="widget-title">Usefull Links</h4>
                        <ul>
                            <li>
                                <a href="departments.html">Departments</a>
                            </li>
                            <li>
                                <a href="doctors.html">Doctors</a>
                            </li>
                            <li>
                                <a href="blogs.html">Blogs</a>
                            </li>
                            <li>
                                <a href="#">About Us</a>
                            </li>
                            <li>
                                <a href="#">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="single-item col-lg-4 col-md-6 item" id="contact-section">
                    <div class="f-item branches">
                        <div class="branches">
                            <ul>
                                <li>
                                    <strong>USA Branches:</strong>
                                    <span>4992 Bryan Avenue, Prior Lake, Minnesota <br> Phone: 651-379-4698</span>
                                </li>
                                <li>
                                    <strong>Central Branches:</strong>
                                    <span>2001 Kia Magentis, Prior Lake, Minnesota <br> Phone: 651-379-4698</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Start Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-center">
                <div class="col-md-6">
                    <p>Copyright &copy;  2020. Designed by <a href="#">validtemplatess</a></p>
                </div>
                <div class="col-md-6 text-right social">
                    <ul>
                        <li>
                            <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
                        </li>
                        <li>
                            <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
                        </li>
                        <li>
                            <a href="#"><i class="fab fa-youtube"></i> Youtube</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Bottom -->
</footer>
<!-- End Footer -->

<!-- jQuery Frameworks
============================================= -->
<script src="{{asset('assets/site/js/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('assets/site/js/popper.min.js')}}"></script>
<script src="{{asset('assets/site/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/site/js/equal-height.min.js')}}"></script>
<script src="{{asset('assets/site/js/jquery.appear.js')}}"></script>
<script src="{{asset('assets/site/js/jquery.easing.min.js')}}"></script>
<script src="{{asset('assets/site/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/site/js/modernizr.custom.13711.js')}}"></script>
<script src="{{asset('assets/site/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/site/js/wow.min.js')}}"></script>
<script src="{{asset('assets/site/js/progress-bar.min.js')}}"></script>
<script src="{{asset('assets/site/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/site/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('assets/site/js/count-to.js')}}"></script>
<script src="{{asset('assets/site/js/YTPlayer.min.js')}}"></script>
{{--<script src="{{asset('assets/site/js/jquery.nice-select.min.js')}}"></script>--}}
<script src="{{asset('assets/site/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/site/js/bootsnav.js')}}"></script>
<script src="{{asset('assets/site/js/main.js')}}"></script>
<!-- Sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!-- Datatables JS -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    function toast(title, type) {
        Swal.fire({
            toast: true,
            title: title,
            text: '',
            type: type,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000
        });
    }
</script>
<script>
    @include('partials.response')
</script>
@yield('scripts')
</body>
</html>
