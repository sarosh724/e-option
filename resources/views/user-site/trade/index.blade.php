<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Easy Option | Trade</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/user/css/style4.css')}}">

    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Sweet alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!-- Datatable CSS -->
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
</head>

<body>

<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar" class="bg-dark active">
        <div class="sidebar-header p-0 py-2 mb-2">
            <h3>Easy Option</h3>
            <strong class="text-success">EO</strong>
        </div>

        <ul class="list-unstyled components p-0">
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

            <li>
                <a href="#" data-toggle="tooltip" data-placement="right" title="Support">
                    <i class="fas fa-question-circle"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="btn-trade" data-tab="trades" data-toggle="tooltip" data-placement="right" title="Trade">
                    <i class="fas fa-signal"></i>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="tooltip" data-placement="right" title="Demo">
                    <i class="fas fa-graduation-cap"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="btn-account" data-tab="account" data-toggle="tooltip" data-placement="right" title="Account">
                    <i class="fas fa-user"></i>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="tooltip" data-placement="right" title="Analytics">
                    <i class="fas fa-chart-pie"></i>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="tooltip" data-placement="right" title="Market">
                    <i class="fas fa-funnel-dollar"></i>
                </a>
            </li>
            <li>
                <a href="{{url('logout')}}" data-toggle="tooltip" data-placement="right" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>

        <ul class="list-unstyled CTAs">
            <li>
                <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
            </li>
            <li>
                <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark m-0">
            <div class="container-fluid">
                <h5 class="text-white m-0">Easy Option</h5>
                <span class="ml-4" style="color: dimgray;">Web Trading Platform</span>
{{--                <button type="button" id="sidebarCollapse" class="btn btn-info">--}}
{{--                    <i class="fas fa-align-left"></i>--}}
{{--                    <span>Toggle Sidebar</span>--}}
{{--                </button>--}}
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="#">Page</a>--}}
{{--                        </li>--}}
                    </ul>
                    <div>
                        <a href="javascript:void(0);" class="referral-link px-4 py-2 mr-1" title="get referral link" data-link="{{url('register').'?refcode='.base64_encode(auth()->user()->id)}}" style="font-family: med;font-size: 14px;"><i class="fal fa-clipboard mr-1"></i>Get Referral Link</a>
                        <a class="btn bg-black text-white px-4 py-2 mr-1" style="font-family: med;font-size: 14px;">Balance: ${{auth()->user()->account_balance}}</a>
                        <button class="btn btn-deposit btn-success text-white px-4 py-2 mr-1" data-tab="deposit"
                                style="font-family: med; font-size: 14px;">
                            <i class="fa fa-plus mr-1" style="font-size: 13px;"></i>Deposit
                        </button>
                        <button class="btn btn-withdrawal btn-secondary text-white px-4 py-2" data-tab="withdrawal"
                                style="font-family: med;font-size: 14px;">
                            Withdrawal
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <div class="px-2">
            <div class="mt-2">
                <div class="d-inline-flex justify-content-start bg-dark p-2 rounded">
                    <button class="btn btn-sm btn-dark btn-tab-item mr-3 p-2" data-tab="deposit">Deposit</button>
                    <button class="btn btn-sm btn-dark btn-tab-item mr-3 p-2" data-tab="withdrawal">Withdrawal</button>
                    <button class="btn btn-sm btn-dark btn-tab-item mr-3 p-2" data-tab="transactions">Transactions</button>
                    <button class="btn btn-sm btn-dark btn-tab-item mr-3 p-2" data-tab="trades">Trades</button>
                    <button class="btn btn-sm btn-dark btn-tab-item mr-3 p-2" data-tab="account">Account</button>
                </div>
                <div class="my-2" id="content-box">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="{{asset('assets/site/js/jquery-1.12.4.min.js')}}"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script src="{{asset('assets/site/js/jquery.validate.min.js')}}"></script>
<!-- Sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!-- Datatables JS -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- Highcharts JS -->
{{--<script src="{{asset('assets/site/highcharts/highstock.js')}}"></script>--}}
{{--<script src="{{asset('assets/site/highcharts/highstock.js')}}"></script>--}}
{{--<script src="{{asset('assets/site/highcharts/hollowcandlestick.js')}}"></script>--}}
{{--<script src="{{asset('assets/site/highcharts/accessibility.js')}}"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>--}}

<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/stock.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });

        $(".btn-deposit, .btn-withdrawal, .btn-account, .btn-trade").on('click', function () {
            let currentTab = $(this).data('tab');

            $(".btn-tab-item").each(function(){

                if ($(this).hasClass('active')) {
                    $(this).removeClass('active')
                }

                let tab = $(this).data('tab');

                if (currentTab == tab) {
                    localStorage.setItem('trade-tab', tab);
                    $(this).addClass('active');
                    loadData(currentTab);
                }
            });
        });

        $(".btn-withdrawal").on('click', function () {

        });

        $(".btn-tab-item").each(function(){
            let activeTab = localStorage.getItem('trade-tab');
            let currentTab = $(this).data('tab');
            if (currentTab == activeTab) {
                $(this).addClass('active');
                return;
            }
            if (activeTab == null) {
                if (currentTab === 'deposit') {
                    $(this).addClass('active');
                    localStorage.setItem('trade-tab', currentTab);
                }
            }
        });

        let activeTab = localStorage.getItem('trade-tab');
        let tab = activeTab == null ? 'deposit' : activeTab;
        loadData(tab);

        $(".btn-tab-item").on('click', function () {
            let tab = $(this).data('tab');
            localStorage.setItem('trade-tab', tab);
            if ($(".btn-tab-item").hasClass('active')) {
                $(".btn-tab-item").removeClass('active')
            }
            $(this).addClass('active');
            loadData(tab);
        });
    });

    function loadData(tab) {
        $.ajax({
            url: "{{url('trade')}}/" + tab,
            type: "GET",
            success: function (res) {
                $("#content-box").html(res);
            },
            error: function (error) {
                console.log('Internal Server Error');
            }
        });
    }

    function toast(title, type) {
        Swal.fire({
            toast: true,
            title: title,
            text: '',
            type: type,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            background: '#6c757d',
            color: '#ffffff'
        });
    }

    // copy referral link to clipboard

    $(".referral-link").on('click', function () {

        const textToCopy = $(this).data('link');

        const textarea = document.createElement('textarea');
        textarea.value = textToCopy;
        textarea.style.position = 'fixed';
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);

        toast('Link copied to clipboard', 'success');
    });

    @include('partials.response')
</script>
</body>

<style>
    /* Define the default link color */
    a.referral-link {
        color: #ffffff;
        text-decoration: none; /* Remove the underline if desired */
    }

    /* Change the link color when hovered over */
    a.referral-link:hover {
        color: #0d5c93; /* Change to the desired hover color */
    }

</style>

</html>
