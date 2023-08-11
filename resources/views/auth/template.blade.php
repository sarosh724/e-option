<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <!-- ========== Page Title ========== -->
    <title>@yield('page-title') | E-Option</title>
    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="{{asset('assets/s/hostel-finder-logo.png')}}" type="image/x-icon">

    <!-- ========== Start Stylesheet ========== -->
    <link href="{{asset('assets/site/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/site/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/site/css/themify-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/site/css/flaticon-set.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/site/css/magnific-popup.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/site/css/owl.carousel.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/site/css/owl.theme.default.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/site/css/animate.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/site/css/bootsnav.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/site/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/site/css/responsive.css')}}" rel="stylesheet" />
    <!-- ========== End Stylesheet ========== -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="{{asset('assets/site/js/html5/html5shiv.min.js')}}"></script>
    <script src="{{asset('assets/site/js/html5/respond.min.js')}}"></script>
    <![endif]-->

    <!-- ========== Google Fonts ========== -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;600;700;800&display=swap" rel="stylesheet">

</head>

<body>
<!-- Preloader Start -->
<div class="se-pre-con"></div>
<!-- Preloader Ends -->

@yield('content')

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
<script src="{{asset('assets/site/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/site/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/site/js/bootsnav.js')}}"></script>
<script src="{{asset('assets/site/js/main.js')}}"></script>
@yield('scripts')
