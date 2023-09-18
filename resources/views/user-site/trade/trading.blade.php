<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Easy Option - @yield('page-title')</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/user/css/style3.css')}}">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Sweet alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!-- Datatable CSS -->
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">

    @yield('styles')
    <style>
        #live-acc-btn, #demo-acc-btn {
            width: 23px;
            height: 23px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #live-acc-btn, #demo-acc-btn i {
            font-size: 12px;
        }

        #live-acc-btn, #demo-acc-btn, .live-acc-label, .demo-acc-label:hover {
            cursor: pointer;
        }
        .demo-acc-label, .live-acc-label{
            font-size: 15px;
        }
        .dropdown-menu {
            min-width: 150px !important;
        }
        @media screen and (max-width: 768px) {
            #live-acc-btn, #demo-acc-btn {
                width: 18px;
                height: 18px;
            }
            .demo-acc-label, .live-acc-label{
                font-size: 12px;
            }
            #live-balance, #demo-balance {
                font-size: 12px;
            }
            #live-acc-btn, #demo-acc-btn i {
                font-size: 10px;
            }
        }
        @media screen and (max-width: 576px) {
            #live-acc-btn, #demo-acc-btn {
                width: 18px;
                height: 18px;
                margin-top: 5px;
            }
            .demo-acc-label, .live-acc-label{
                font-size: 13px;
            }
            #live-balance, #demo-balance {
                font-size: 12px;
            }
            #live-acc-btn, #demo-acc-btn i {
                font-size: 10px;
            }
        }
    </style>
</head>

<body>
<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>

        <div class="sidebar-header">
            <h3 class="m-0" style="font-family: bold;">Dashboard</h3>
        </div>

        <ul class="list-unstyled components">
            <div class="d-flex justify-content-start align-items-start px-2 mb-3">
                <div>
                    @php
                        $url = auth()->user()->photo ? auth()->user()->photo : asset('assets/user/img/user.png')
                    @endphp
                    <img src="{{$url}}" width="45px" height="45px"
                         class="rounded" style="object-fit: contain; object-position: top;">
                </div>
                <div class="pl-2">
                    <span class="d-block">{{auth()->user()->name}}</span>
                    <small class="text-secondary d-block">{{auth()->user()->email}}</small>
                </div>
            </div>

            @if(auth()->user()->is_admin)
                <li class="{{is_active_menu('admin')}}">
                    <a href="{{url('/admin')}}"><i class="fal fa-tachometer-alt mr-2"></i>Admin Dashboard</a>
                </li>
            @endif
            <li class="{{is_active_menu('dashboard')}}">
                <a href="{{url('dashboard')}}"><i class="fal fa-tachometer mr-2"></i>Dashboard</a>
            </li>
            <li class="{{is_active_menu('market')}}">
                <a href="{{url('market')}}"><i class="fal fa-analytics mr-2"></i>Market</a>
            </li>
            <li class="{{is_active_menu('deposit')}}">
                <a href="{{url('deposit')}}"><i class="fal fa-wallet mr-2"></i>Make Deposit</a>
            </li>
            <li class="{{is_active_menu('withdrawal')}}">
                <a href="{{url('withdrawal')}}"><i class="fab fa-get-pocket mr-2"></i>Get Withdrawal</a>
            </li>
            <li class="{{is_active_menu('transactions')}}">
                <a href="{{url('transactions')}}"><i class="fal fa-sort-alt mr-2"></i>Transactions</a>
            </li>
            <li class="{{is_active_menu('trade-history')}}">
                <a href="{{url('trade-history')}}"><i class="fal fa-history mr-2"></i>Trading History</a>
            </li>
            <li class="{{is_active_menu('referral')}}">
                <a href="{{url('referral')}}"><i class="fal fa-link mr-2"></i>Referrals</a>
            </li>
            <li class="{{is_active_menu('withdrawal-account')}}">
                <a href="{{url('withdrawal-account')}}"><i class="fal fa-dollar-sign mr-2"></i>Withdrawal Account</a>
            </li>
            <li class="{{is_active_menu('account')}}">
                <a href="{{url('account')}}"><i class="fal fa-user mr-2"></i>My Account</a>
            </li>
        </ul>

        <ul class="list-unstyled CTAs">
            <li>
                <a href="{{url('logout')}}" class="download">
                    <i class="fa fa-sign-out mr-2"></i>Logout
                </a>
            </li>
        </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid p-0 d-flex justify-content-between align-items-center">
                <div class="">
                    <div class="d-flex justify-content-start align-items-center">
                        <button type="button" id="sidebarCollapse" class="btn btn-outline-secondary" style="border: none !important;">
                            <i class="fas fa-align-left"></i>
                        </button>
                        <h3 class="text-white m-0 ml-1 brand-text" style="font-family: med;">Easy<span class="text-success">Option</span></h3>
{{--                        <span class="text-secondary ml-1 my-title" style="font-size: 14px;"><i>Web Trading Platform</i></span>--}}
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <div class="dropdown mr-1 p-0">
                        <button class="btn bg-black d-flex justify-content-between align-items-center btn-drp-account"
                                type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" >
                            <div class="pr-1">
                                <span><i class="fa fa-location-arrow text-success"></i></span>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-left parent-account-drp-down">
                                        <small class="m-0 d-block text-secondary account-type-text" style="font-family: med;">{{(auth()->user()->is_demo_account) ? "Demo Account" : "Live Account"}}</small>
                                        <h6 class="m-0 text-white balance-text" id="balance" style="font-family: bold;">${{sprintf("%0.2f", (auth()->user()->is_demo_account) ? auth()->user()->demo_account_balance : auth()->user()->account_balance)}}</h6>
                                    </div>
                                    <span class="pl-1 text-white"><i class="far fa-chevron-down" id="account-icon" style="font-size: 13px;"></i></span>
                                </div>
                            </div>
                        </button>
                        <div class="dropdown-menu bg-black shadow p-0" aria-labelledby="dropdownMenuButton">
                            <div class="px-3 py-2">
                                <div class="d-flex justify-content-start align-items-center">
                                    <small class="text-secondary drp-name mr-2">Name:</small>
                                    <span class="m-0 text-white text-capitalize" style="font-size: 14px; font-family: med;">{{auth()->user()->name}}</span>
                                </div>
                                <div class="d-flex justify-content-start align-items-center">
                                    <small class="text-secondary drp-name mr-2">Email:</small>
                                    <small class="m-0 text-success">{{auth()->user()->email}}</small>
                                </div>
                            </div>
                            <hr style="background: #4f4e4d; margin: 0;">

                            <div class="d-flex justify-content-start drd-box px-2 py-2">
                                <div>
                                    <label id="live-acc-btn" data-type="live"><i class="far fa-check"></i></label>
                                </div>
                                <div class="ml-2">
                                    <span class="live-acc-label text-white" data-type="live" style="font-family: med;" for="live-acc-btn">Live Account</span>
                                    <span class="text-secondary d-block" id="live-balance" style="font-family: bold;">${{sprintf("%0.2f", auth()->user()->account_balance)}}</span>
                                </div>
                            </div>
                            <hr style="background: #4f4e4d; margin: 0;">
                            <div class="d-flex justify-content-start drd-box px-2 py-2">
                                <div>
                                    <label id="demo-acc-btn" data-type="demo"><i class="far fa-check"></i></label>
                                </div>
                                <div class="ml-2">
                                    <span class="demo-acc-label text-white" data-type="demo" style="font-family: med;" for="demo-acc-btn">Demo Account</span>
                                    <span class="text-secondary d-block" id="demo-balance" style="font-family: bold;">${{sprintf("%0.2f", auth()->user()->demo_account_balance)}}</span>
                                </div>
                            </div>
                            <hr style="background: #4f4e4d; margin: 0;">
                            <div class="drd-box px-2 py-2">
                                <a href="{{url('logout')}}" class="text-danger">
                                    <i class="far fa-sign-out-alt text-danger mr-1"></i>Logout
                                </a>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-deposit btn-success text-white mr-1 p-0" data-tab="deposit"
                            style="font-family: med; font-size: 14px; padding: 11px 15px !important;">
                        <i class="fa fa-plus mr-1" style="font-size: 13px;"></i>Deposit
                    </button>

                    <button class="btn btn-withdrawal btn-secondary text-white p-0" data-tab="withdrawal"
                            style="font-family: med;font-size: 14px; padding: 11px 15px !important;">Withdrawal
                    </button>
                </div>
                {{--                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
                {{--                    <i class="fas fa-align-justify"></i>--}}
                {{--                </button>--}}

                {{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
                {{--                    <ul class="nav navbar-nav ml-auto">--}}
                {{--                        <li class="nav-item active">--}}
                {{--                            <a class="nav-link" href="#">Page</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a class="nav-link" href="#">Page</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a class="nav-link" href="#">Page</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a class="nav-link" href="#">Page</a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </div>--}}
            </div>
        </nav>

        <div class="px-2 py-2 text-white context-box">
            <div>
                <h3 class="m-0 py-1 d-inline-block border-bottom border-secondary text-success title" style="font-family: bold;">@yield('title')</h3>
            </div>
            <div>
                @yield('content')
            </div>

        </div>
        <div id="mobile-menu" class="bg-second">
            <div class="mobile-menu-content">
                <a href="{{url('dashboard')}}" class="mr-2 {{is_active_menu('dashboard')}}">
                    <i class="fal fa-tachometer"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{url('market')}}" class="{{is_active_menu('market')}}">
                    <i class="fal fa-analytics"></i>
                    <span>Market</span>
                </a>
                <a href="{{url('deposit')}}" class="ml-2 {{is_active_menu('deposit')}}">
                    <i class="fal fa-wallet"></i>
                    <span>Deposit</span>
                </a>
                <a href="{{url('withdrawal')}}" class="{{is_active_menu('withdrawal')}}">
                    <i class="fab fa-get-pocket"></i>
                    <span>Withdraw</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>

<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="{{asset('assets/user/js/jquery-1.12.4.min.js')}}"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<!-- Jquery Validate -->
<script src="{{asset('assets/user/js/jquery.validate.min.js')}}"></script>
<!-- Sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!-- Datatables JS -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- jQuery Custom Scroller CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btn-drp-account").on('click', function () {
        if ($("#account-icon").hasClass("fa-chevron-down")) {
            $("#account-icon").removeClass("fa-chevron-down");
            $("#account-icon").addClass("fa-chevron-up");
        } else {
            $("#account-icon").removeClass("fa-chevron-up");
            $("#account-icon").addClass("fa-chevron-down");
        }
    });

    $(".dropdown-menu").click(function(e){
        e.stopPropagation();
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $(document).ready(function () {
        let is_demo = {{auth()->user()->is_demo_account}};
        if (is_demo) {
            $("#live-acc-btn").css("border", "1px solid #ffffff");
            $("#live-acc-btn").css("background", "transparent");
            $("#demo-acc-btn").css("border", "1px solid #0275d8");
            $("#demo-acc-btn").css("background", "#0275d8");
            $("#demo-acc-btn i").css("color", "#ffffff");
        } else {
            $("#demo-acc-btn").css("border", "1px solid #ffffff");
            $("#demo-acc-btn").css("background", "transparent");
            $("#live-acc-btn").css("border", "1px solid #0275d8");
            $("#live-acc-btn").css("background", "#0275d8");
            $("#live-acc-btn i").css("color", "#ffffff");
        }

        $("#live-acc-btn, .live-acc-label, #demo-acc-btn, .demo-acc-label").on('click', function () {
            let type = $(this).data('type');
            if (is_demo && type == "demo") {
                return;
            }

            if (!is_demo && type == "live") {
                return;
            }

            $.ajax({
                url: "{{url('change-user-account')}}",
                type: "POST",
                data: JSON.stringify({
                    type: type,
                }),
                cache: false,
                processData: false,
                contentType: "application/json; charset=UTF-8",
                success: function (res) {
                    if (res.success == 1) {
                        window.location.reload();
                    } else {
                        toast(res.message, "error");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus+' : '+errorThrown);
                }
            });
        });

        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#dismiss, .overlay').on('click', function () {
            $('#sidebar').removeClass('active');
            $('.overlay').removeClass('active');
        });

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').addClass('active');
            $('.overlay').addClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });

    function toast(title, type) {
        let bg = "#10253c";
        if (type == "success")  bg = "#5cb85c";
        if (type == "error")    bg = "#d9534f";
        if (type == "info")     bg = "#5bc0de";
        if (type == "warning")  bg = "#f0ad4e";
        Swal.fire({
            toast: true,
            title: title,
            text: '',
            type: type,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            background: bg,
            color: '#f7f7f7'
        });
    }

    function setAccountBalance(){
        $.ajax({
            url: "{{url('get-account-balance')}}",
            type: "GET",
            cache: false,
            processData: false,
            contentType: "application/json; charset=UTF-8",
            success: function (res) {
                if (res.success == true) {
                    $('#balance').html('$<b>' + parseFloat(res.data.account_balance).toFixed(2) + '</b>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(textStatus+' : '+errorThrown);
            }
        });
    }

    @include('partials.response')
</script>
@yield('scripts');
</body>

</html>
