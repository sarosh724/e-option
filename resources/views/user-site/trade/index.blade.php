{{--<!DOCTYPE html>--}}
{{--<html>--}}

{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--    <title>Easy Option | Trade</title>--}}

{{--    <!-- Bootstrap CSS CDN -->--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">--}}
{{--    <!-- Our Custom CSS -->--}}
{{--    <link rel="stylesheet" href="{{asset('assets/user/css/style4.css')}}">--}}

{{--    <!-- Font Awesome JS -->--}}
{{--    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />--}}
{{--    <!-- Sweet alert -->--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">--}}
{{--    <!-- Datatable CSS -->--}}
{{--    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">--}}

{{--    <style>--}}
{{--        #live-acc-btn, #demo-acc-btn {--}}
{{--            width: 23px;--}}
{{--            height: 23px;--}}
{{--            border-radius: 50%;--}}
{{--            display: flex;--}}
{{--            justify-content: center;--}}
{{--            align-items: center;--}}
{{--        }--}}

{{--        #live-acc-btn, #demo-acc-btn i {--}}
{{--            font-size: 12px;--}}
{{--        }--}}

{{--        #live-acc-btn, #demo-acc-btn, .live-acc-label, .demo-acc-label:hover {--}}
{{--            cursor: pointer;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}

{{--<body>--}}

{{--<div class="wrapper">--}}
{{--    <!-- Sidebar  -->--}}
{{--    <nav id="sidebar" class="bg-dark">--}}
{{--        <div class="sidebar-header p-0 py-2 mb-2">--}}
{{--            <h3>Easy Option</h3>--}}
{{--            <strong class="text-success">EO</strong>--}}
{{--        </div>--}}

{{--        <ul class="list-unstyled components p-0">--}}
{{--            <li class="active">--}}
{{--                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">--}}
{{--                    <i class="fas fa-home"></i>--}}
{{--                    Home--}}
{{--                </a>--}}
{{--                <ul class="collapse list-unstyled" id="homeSubmenu">--}}
{{--                    <li>--}}
{{--                        <a href="#">Home 1</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#">Home 2</a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="#">Home 3</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}

{{--            <li>--}}
{{--                <a href="#" data-toggle="tooltip" data-placement="right" title="Support">--}}
{{--                    <i class="far fa-question-circle"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="javascript:void(0);" class="btn-trade" data-tab="trades" data-toggle="tooltip" data-placement="right" title="Trade">--}}
{{--                    <i class="far fa-signal"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#" data-toggle="tooltip" data-placement="right" title="Demo">--}}
{{--                    <i class="far fa-graduation-cap"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="javascript:void(0);" class="btn-account" data-tab="account" data-toggle="tooltip" data-placement="right" title="Account">--}}
{{--                    <i class="far fa-user"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#" data-toggle="tooltip" data-placement="right" title="Analytics">--}}
{{--                    <i class="far fa-chart-pie"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="javascript:void(0);" class="btn-market" data-tab="market" data-toggle="tooltip" data-placement="right" title="Market">--}}
{{--                    <i class="far fa-funnel-dollar"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="{{url('logout')}}" data-toggle="tooltip" data-placement="right" title="Logout">--}}
{{--                    <i class="far fa-sign-out-alt"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}

{{--        <ul class="list-unstyled CTAs">--}}
{{--            <li>--}}
{{--                <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </nav>--}}

{{--    <!-- Page Content  -->--}}
{{--    <div id="content">--}}

{{--        <nav class="navbar navbar-expand-lg navbar-dark bg-dark m-0 p-0 py-2">--}}
{{--            <div class="container-fluid">--}}
{{--                <button type="button" id="sidebarCollapse" class="btn btn-sm bg-transparent">--}}
{{--                    <i class="fas fa-align-left text-white"></i>--}}
{{--                    <span>Toggle Sidebar</span>--}}
{{--                </button>--}}
{{--                <h5 class="text-white m-0">Easy Option</h5>--}}
{{--                <span class="ml-4" style="color: dimgray;">Web Trading Platform</span>--}}
{{--                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                    <i class="fas fa-align-justify"></i>--}}
{{--                </button>--}}

{{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--                    <ul class="nav navbar-nav ml-auto">--}}
{{--                        <li>--}}
{{--                            <a href="javascript:void(0);" class="referral-link px-4 mr-1 btn" title="Get Referral Link"--}}
{{--                               data-link="{{url('register').'?refcode='.base64_encode(auth()->user()->id)}}" style="font-family: med;font-size: 14px;">--}}
{{--                                <i class="fal fa-clipboard mr-1"></i>Get Referral Link--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                    <div class="d-flex justify-content-end align-items-center">--}}

{{--                            <div class="dropdown mr-1 p-0">--}}
{{--                                <button class="btn bg-black d-flex justify-content-between align-items-center btn-drp-account p-0"--}}
{{--                                        type="button" id="dropdownMenuButton" data-toggle="dropdown"--}}
{{--                                        aria-haspopup="true" aria-expanded="false" style="padding: 4.5px 15px !important;">--}}
{{--                                    <div class="pr-1">--}}
{{--                                        <span><i class="fa fa-location-arrow text-success"></i></span>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <div class="d-flex justify-content-between align-items-center">--}}
{{--                                            <div class="text-left px-3">--}}
{{--                                                <small class="m-0 d-block text-secondary" style="font-size: 11px; font-family: med;">{{(auth()->user()->is_demo_account) ? "Demo Account" : "Live Account"}}</small>--}}
{{--                                                <h6 class="m-0 text-white" id="balance" style="font-family: bold;">${{sprintf("%0.2f", (auth()->user()->is_demo_account) ? auth()->user()->demo_account_balance : auth()->user()->account_balance)}}</h6>--}}
{{--                                            </div>--}}
{{--                                            <span class="pl-1 text-white"><i class="far fa-chevron-down" id="account-icon" style="font-size: 13px;"></i></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </button>--}}
{{--                                <div class="dropdown-menu bg-black shadow p-0" style="min-width: 250px;" aria-labelledby="dropdownMenuButton">--}}
{{--                                    <div class="px-3 py-2">--}}
{{--                                        <div class="d-flex justify-content-start align-items-center">--}}
{{--                                            <small class="text-secondary mr-2 d-block">Name:</small>--}}
{{--                                            <p class="m-0 text-white text-capitalize" style="font-size: 14px; font-family: med;">{{auth()->user()->name}}</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex justify-content-start align-items-center">--}}
{{--                                            <small class="text-secondary mr-2 d-block">Email:</small>--}}
{{--                                            <span class="m-0 text-success">{{auth()->user()->email}}</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <hr style="background: #4f4e4d; margin: 0;">--}}

{{--                                    <div class="d-flex justify-content-start px-3 py-2">--}}
{{--                                        <div>--}}
{{--                                            <label id="live-acc-btn" data-type="live"><i class="far fa-check"></i></label>--}}
{{--                                        </div>--}}
{{--                                        <div class="ml-2">--}}
{{--                                            <span class="live-acc-label text-white" data-type="live" style="font-size: 15px; font-family: med;" for="live-acc-btn">Live Account</span>--}}
{{--                                            <span class="text-secondary d-block" id="live-balance" style="font-family: bold;">${{sprintf("%0.2f", auth()->user()->account_balance)}}</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <hr style="background: #4f4e4d; margin: 0;">--}}
{{--                                    <div class="d-flex justify-content-start px-3 py-2">--}}
{{--                                        <div>--}}
{{--                                            <label id="demo-acc-btn" data-type="demo"><i class="far fa-check"></i></label>--}}
{{--                                        </div>--}}
{{--                                        <div class="ml-2">--}}
{{--                                            <span class="demo-acc-label text-white" data-type="demo" style="font-size: 15px; font-family: med;" for="demo-acc-btn">Demo Account</span>--}}
{{--                                            <span class="text-secondary d-block" id="demo-balance" style="font-family: bold;">${{sprintf("%0.2f", auth()->user()->demo_account_balance)}}</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <hr style="background: #4f4e4d; margin: 0;">--}}
{{--                                    <div class="px-3 py-2">--}}
{{--                                        <a href="{{url('logout')}}" class="text-danger">--}}
{{--                                            <i class="far fa-sign-out-alt text-danger mr-1"></i>Logout--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <button class="btn btn-deposit btn-success text-white mr-1 p-0" data-tab="deposit"--}}
{{--                                    style="font-family: med; font-size: 14px; padding: 11px 15px !important;">--}}
{{--                                <i class="fa fa-plus mr-1" style="font-size: 13px;"></i>Deposit--}}
{{--                            </button>--}}

{{--                            <button class="btn btn-withdrawal btn-secondary text-white p-0" data-tab="withdrawal"--}}
{{--                                    style="font-family: med;font-size: 14px; padding: 11px 15px !important;">Withdrawal--}}
{{--                            </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}

{{--        <div class="px-2">--}}
{{--            <div class="mt-2">--}}
{{--                <div class="d-inline-flex justify-content-start bg-dark p-2 rounded">--}}
{{--                    <button class="btn btn-sm btn-dark btn-tab-item mr-3 p-2" data-tab="market">Market</button>--}}
{{--                    <button class="btn btn-sm btn-dark btn-tab-item mr-3 p-2" data-tab="deposit">Deposit</button>--}}
{{--                    <button class="btn btn-sm btn-dark btn-tab-item mr-3 p-2" data-tab="withdrawal">Withdrawal</button>--}}
{{--                    <button class="btn btn-sm btn-dark btn-tab-item mr-3 p-2" data-tab="transactions">Transactions</button>--}}
{{--                    <button class="btn btn-sm btn-dark btn-tab-item mr-3 p-2" data-tab="trades">Trades</button>--}}
{{--                    <button class="btn btn-sm btn-dark btn-tab-item mr-3 p-2" data-tab="account">Account</button>--}}
{{--                    <button class="btn btn-sm btn-dark btn-tab-item mr-3 p-2" data-tab="referral">Referrals</button>--}}
{{--                </div>--}}
{{--                <div class="my-2" id="content-box">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<!-- jQuery CDN - Slim version (=without AJAX) -->--}}
{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
{{--<script src="{{asset('assets/site/js/jquery-1.12.4.min.js')}}"></script>--}}
{{--<!-- Popper.JS -->--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>--}}
{{--<!-- Bootstrap JS -->--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>--}}
{{--<script src="{{asset('assets/site/js/jquery.validate.min.js')}}"></script>--}}
{{--<!-- Sweet alert -->--}}
{{--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>--}}
{{--<!-- Datatables JS -->--}}
{{--<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>--}}
{{--<!-- Highcharts JS -->--}}
{{--<script src="{{asset('assets/site/highcharts/highstock.js')}}"></script>--}}
{{--<script src="{{asset('assets/site/highcharts/highstock.js')}}"></script>--}}
{{--<script src="{{asset('assets/site/highcharts/hollowcandlestick.js')}}"></script>--}}
{{--<script src="{{asset('assets/site/highcharts/accessibility.js')}}"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>--}}

{{--<script src="https://cdn.amcharts.com/lib/5/index.js"></script>--}}
{{--<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>--}}
{{--<script src="https://cdn.amcharts.com/lib/5/stock.js"></script>--}}
{{--<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>--}}
{{--<script src="https://cdn.amcharts.com/lib/5/themes/Responsive.js"></script>--}}
{{--<script src="https://cdn.amcharts.com/lib/5/themes/Dark.js"></script>--}}

{{--<script type="text/javascript">--}}
{{--    $.ajaxSetup({--}}
{{--        headers: {--}}
{{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--        }--}}
{{--    });--}}

{{--    $(".dropdown-menu").click(function(e){--}}
{{--        e.stopPropagation();--}}
{{--    });--}}

{{--    $(function () {--}}
{{--        $('[data-toggle="tooltip"]').tooltip()--}}
{{--    });--}}

{{--    $(document).ready(function () {--}}
{{--        let is_demo = {{auth()->user()->is_demo_account}};--}}
{{--        if (is_demo) {--}}
{{--            $("#live-acc-btn").css("border", "1px solid #ffffff");--}}
{{--            $("#live-acc-btn").css("background", "transparent");--}}
{{--            $("#demo-acc-btn").css("border", "1px solid #0275d8");--}}
{{--            $("#demo-acc-btn").css("background", "#0275d8");--}}
{{--            $("#demo-acc-btn i").css("color", "#ffffff");--}}
{{--        } else {--}}
{{--            $("#demo-acc-btn").css("border", "1px solid #ffffff");--}}
{{--            $("#demo-acc-btn").css("background", "transparent");--}}
{{--            $("#live-acc-btn").css("border", "1px solid #0275d8");--}}
{{--            $("#live-acc-btn").css("background", "#0275d8");--}}
{{--            $("#live-acc-btn i").css("color", "#ffffff");--}}
{{--        }--}}

{{--        $("#live-acc-btn, .live-acc-label, #demo-acc-btn, .demo-acc-label").on('click', function () {--}}
{{--            let type = $(this).data('type');--}}
{{--            if (is_demo && type == "demo") {--}}
{{--                return;--}}
{{--            }--}}

{{--            if (!is_demo && type == "live") {--}}
{{--                return;--}}
{{--            }--}}

{{--            $.ajax({--}}
{{--                url: "{{url('change-user-account')}}",--}}
{{--                type: "POST",--}}
{{--                data: JSON.stringify({--}}
{{--                    type: type,--}}
{{--                }),--}}
{{--                cache: false,--}}
{{--                processData: false,--}}
{{--                contentType: "application/json; charset=UTF-8",--}}
{{--                success: function (res) {--}}
{{--                    if (res.success == 1) {--}}
{{--                        window.location.reload();--}}
{{--                    } else {--}}
{{--                        toast(res.message, "error");--}}
{{--                    }--}}
{{--                },--}}
{{--                error: function(jqXHR, textStatus, errorThrown) {--}}
{{--                    alert(textStatus+' : '+errorThrown);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--        // $("#demo-acc-btn, .demo-acc-label").on('click', function () {--}}
{{--        //     alert("demo account")--}}
{{--        // });--}}
{{--        function changeWidth() {--}}
{{--            let width = $(window).width();--}}
{{--            if (width > 440) {--}}
{{--                $("#sidebarCollapse").hide();--}}
{{--                if (!$("#sidebar").hasClass("active")) {--}}
{{--                    $("#sidebar").addClass("active");--}}
{{--                }--}}
{{--            } else {--}}
{{--                $("#sidebarCollapse").show();--}}
{{--                if ($("#sidebar").hasClass("active")) {--}}
{{--                    $("#sidebar").removeClass("active");--}}
{{--                }--}}
{{--            }--}}
{{--        }--}}

{{--        changeWidth();--}}
{{--        $(window).resize(changeWidth);--}}

{{--        $('#sidebarCollapse').on('click', function () {--}}
{{--            $('#sidebar').toggleClass('active');--}}
{{--        });--}}

{{--        $(".btn-drp-account").on('click', function () {--}}
{{--           if ($("#account-icon").hasClass("fa-chevron-down")) {--}}
{{--               $("#account-icon").removeClass("fa-chevron-down");--}}
{{--               $("#account-icon").addClass("fa-chevron-up");--}}
{{--           } else {--}}
{{--               $("#account-icon").removeClass("fa-chevron-up");--}}
{{--               $("#account-icon").addClass("fa-chevron-down");--}}
{{--           }--}}
{{--        });--}}

{{--        $(".btn-deposit, .btn-withdrawal, .btn-account, .btn-trade, .btn-market, .btn-referral").on('click', function () {--}}
{{--            let currentTab = $(this).data('tab');--}}

{{--            $(".btn-tab-item").each(function(){--}}

{{--                if ($(this).hasClass('active')) {--}}
{{--                    $(this).removeClass('active')--}}
{{--                }--}}

{{--                let tab = $(this).data('tab');--}}

{{--                if (currentTab == tab) {--}}
{{--                    localStorage.setItem('trade-tab', tab);--}}
{{--                    $(this).addClass('active');--}}
{{--                    loadData(currentTab);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--        $(".btn-withdrawal").on('click', function () {--}}

{{--        });--}}

{{--        $(".btn-tab-item").each(function(){--}}
{{--            let activeTab = localStorage.getItem('trade-tab');--}}
{{--            let currentTab = $(this).data('tab');--}}
{{--            if (currentTab == activeTab) {--}}
{{--                $(this).addClass('active');--}}
{{--                return;--}}
{{--            }--}}
{{--            if (activeTab == null) {--}}
{{--                if (currentTab === 'deposit') {--}}
{{--                    $(this).addClass('active');--}}
{{--                    localStorage.setItem('trade-tab', currentTab);--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}

{{--        let activeTab = localStorage.getItem('trade-tab');--}}
{{--        let tab = activeTab == null ? 'deposit' : activeTab;--}}
{{--        loadData(tab);--}}

{{--        $(".btn-tab-item").on('click', function () {--}}
{{--            let tab = $(this).data('tab');--}}
{{--            localStorage.setItem('trade-tab', tab);--}}
{{--            if ($(".btn-tab-item").hasClass('active')) {--}}
{{--                $(".btn-tab-item").removeClass('active')--}}
{{--            }--}}
{{--            $(this).addClass('active');--}}
{{--            loadData(tab);--}}
{{--        });--}}
{{--    });--}}

{{--    function loadData(tab) {--}}
{{--        $.ajax({--}}
{{--            url: "{{url('trade')}}/" + tab,--}}
{{--            type: "GET",--}}
{{--            success: function (res) {--}}
{{--                $("#content-box").html(res);--}}
{{--            },--}}
{{--            error: function (error) {--}}
{{--                console.log('Internal Server Error');--}}
{{--            }--}}
{{--        });--}}
{{--    }--}}

{{--    function toast(title, type) {--}}
{{--        Swal.fire({--}}
{{--            toast: true,--}}
{{--            title: title,--}}
{{--            text: '',--}}
{{--            type: type,--}}
{{--            position: 'top-end',--}}
{{--            showConfirmButton: false,--}}
{{--            timer: 3000,--}}
{{--            background: '#6c757d',--}}
{{--            color: '#ffffff'--}}
{{--        });--}}
{{--    }--}}

{{--    function setAccountBalance(){--}}
{{--        $.ajax({--}}
{{--            url: "{{url('get-account-balance')}}",--}}
{{--            type: "GET",--}}
{{--            cache: false,--}}
{{--            processData: false,--}}
{{--            contentType: "application/json; charset=UTF-8",--}}
{{--            success: function (res) {--}}
{{--                if (res.success == 1) {--}}
{{--                    if (res.data.is_demo_account) {--}}
{{--                        $('#balance').html(parseFloat(res.data.demo_account_balance).toFixed(2));--}}
{{--                        $('#demo-balance').html(parseFloat(res.data.demo_account_balance).toFixed(2));--}}
{{--                    } else {--}}
{{--                        $('#balance').html(parseFloat(res.data.account_balance).toFixed(2));--}}
{{--                        $('#live-balance').html(parseFloat(res.data.account_balance).toFixed(2));--}}
{{--                    }--}}
{{--                }--}}
{{--            },--}}
{{--            error: function(jqXHR, textStatus, errorThrown) {--}}
{{--                alert(textStatus+' : '+errorThrown);--}}
{{--            }--}}
{{--        });--}}
{{--    }--}}

{{--    // copy referral link to clipboard--}}

{{--    $(".referral-link").on('click', function () {--}}

{{--        const textToCopy = $(this).data('link');--}}

{{--        const textarea = document.createElement('textarea');--}}
{{--        textarea.value = textToCopy;--}}
{{--        textarea.style.position = 'fixed';--}}
{{--        document.body.appendChild(textarea);--}}
{{--        textarea.select();--}}
{{--        document.execCommand('copy');--}}
{{--        document.body.removeChild(textarea);--}}

{{--        toast('Link copied to clipboard', 'success');--}}
{{--    });--}}

{{--    @include('partials.response')--}}
{{--</script>--}}
{{--</body>--}}

{{--<style>--}}
{{--    /* Define the default link color */--}}
{{--    a.referral-link {--}}
{{--        color: #ffffff;--}}
{{--        text-decoration: none; /* Remove the underline if desired */--}}
{{--    }--}}

{{--    /* Change the link color when hovered over */--}}
{{--    a.referral-link:hover {--}}
{{--        color: #0d5c93; /* Change to the desired hover color */--}}
{{--    }--}}

{{--</style>--}}

{{--</html>--}}
