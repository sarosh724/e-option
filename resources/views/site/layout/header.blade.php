<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Easy Option">

    <!-- ========== Page Title ========== -->
    <title>@yield('page-title') | Easy Option</title>

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="assets/site/img/favicon.png" type="image/x-icon">

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
    <!-- Sweet alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!-- ========== Google Fonts ========== -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- Datatable CSS -->
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">

</head>

<body class="bg-dark">
<!-- Preloader Start -->
<div class="se-pre-con"></div>
<!-- Preloader Ends -->

<!-- Header
============================================= -->
<header id="home">

    <!-- Start Navigation -->
    <nav class="navbar navbar-default navbar-fixed navbar-transparent white bootsnav">

        <!-- Start Top Search -->
        <div class="container-full">
            <div class="row">
                <div class="top-search">
                    <div class="input-group">
                        <form action="#">
                            <input type="text" name="text" class="form-control" placeholder="Search">
                            <button type="submit">
                                <i class="ti-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Top Search -->

        <div class="container-full">

            <!-- Start Attribute Navigation -->
            <div class="attr-nav extra-color">
                <ul>
                    @if (!(auth()->check()))
                        <li>
                            <a href="{{url('login')}}" class="btn-login"><i class="fa fa-sign-in-alt mr-1"></i>Login</a>
                        </li>
                        <li>
                            <a href="{{url('register')}}" class="btn-register"><i class="fa fa-sign-out-alt mr-1"></i>Register</a>
                        </li>
                    @else
                        <li>
                            <a class="btn-register">Balance: {{auth()->user()->account_balance}}$</a>
                        </li>
                        <li class="side-menu"><a href="#"><i class="fas fa-th-large"></i></a></li>
{{--                        <li>--}}
{{--                            <a href="javascript:void(0);" class="username"><small><b>{{auth()->user()->name}}</b></small></a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="{{url('logout')}}" class="btn-logout"><i class="fa fa-sign-out-alt mr-1"></i>Logout</a>--}}
{{--                        </li>--}}
                    @endif
{{--                    <li><a href="{{url('login')}}" class="font-weight-light px-0 mx-0">Login</a></li>--}}
{{--                    <li><a href="{{url('register')}}" class="font-weight-light px-0 mx-0">Register</a></li>--}}
{{--                    <li class="search"><a href="#"><i class="fas fa-search"></i></a></li>--}}

                </ul>
            </div>
            <!-- End Attribute Navigation -->

            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{url('/')}}">
                    <img src="{{asset('assets/site/img/logo-2.png')}}" class="logo logo-display" alt="Logo" width="165" height="50">
                    <img src="{{asset('assets/site/img/logo-2.png')}}" class="logo logo-scrolled" alt="Logo" width="165" height="50">
                </a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-center" data-in="#" data-out="#">
                    <li>
                        <a href="{{url('/')}}">home</a>
                    </li>
                    <li>
                        <a href="{{url('trading')}}">trading</a>
                    </li>
                    <li>
                        <a href="{{url('deposit')}}">deposit</a>
                    </li>
                    <li>
                        <a href="{{url('withdrawal')}}">withdraw</a>
                    </li>
                    <li>
                        <a href="{{url('about')}}">about us</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>

        <!-- Start Side Menu -->
        <div class="side">
            <a href="#" class="close-side"><i class="ti-close"></i></a>
            <div class="widget">
                <h4 class="title"><small><b>{{auth()->user()->name}}</b></small></h4>
                <ul>
                    <li>
                        <a class="text-info font-weight-light" href="{{url('trading')}}">
                            <i class="fas fa-chevron-right mr-1"></i>Trading
                        </a>
                    </li>
                    <li>
                        <a class="text-info font-weight-light" href="{{url('trading')}}">
                            <i class="fas fa-chevron-right mr-1"></i>Buy & Sell
                        </a>
                    </li>
                    <li>
                        <a class="text-info font-weight-light" href="{{url('deposit')}}">
                            <i class="fas fa-chevron-right mr-1"></i>Recharge
                        </a>
                    </li>
                    <li>
                        <a class="text-info font-weight-light" href="{{url('withdrawal')}}">
                            <i class="fas fa-chevron-right mr-1"></i>Make Withdrawal
                        </a>
                    </li>
                    <li>
                        <a class="text-info font-weight-light" href="{{url('deposit')}}">
                            <i class="fas fa-chevron-right mr-1"></i>Deposit History
                        </a>
                    </li>
                    <li>
                        <a class="text-info font-weight-light" href="{{url('withdrawal')}}">
                            <i class="fas fa-chevron-right mr-1"></i>Withdrawal History
                        </a>
                    </li>
                    <li>
                        <a class="text-info font-weight-light" href="{{url('settings')}}">
                            <i class="fas fa-chevron-right mr-1"></i>Withdrawal Account
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-sm btn-gradient btn-block" href="{{url('logout')}}">
                            <i class="fa fa-sign-out-alt mr-1"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
{{--            <div class="widget">--}}
{{--                <h4 class="title">Get in touch</h4>--}}
{{--                <p>--}}
{{--                    Arrived compass prepare an on as. Reasonable particular on my it in sympathize. Size now easy eat hand how. Unwilling he departure elsewhere dejection at. Heart large seems may purse means few blind.--}}
{{--                </p>--}}
{{--                <a href="#" class="btn btn-theme effect btn-sm" data-animation="animated slideInUp">Consultation</a>--}}
{{--            </div>--}}
            <div class="widget social">
                <h4 class="title">Connect With Us</h4>
                <ul class="link">
                    <li class="facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li class="pinterest"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                    <li class="dribbble"><a href="#"><i class="fab fa-dribbble"></i></a></li>
                </ul>
            </div>
        </div>
        <!-- End Side Menu -->

    </nav>
    <!-- End Navigation -->

</header>
<!-- End Header -->
