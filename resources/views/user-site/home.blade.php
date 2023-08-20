@extends('user-site.index')

@section('content')
<div class="container" id="about">
    <div class="row">
        <div class="col-md-6">
            <img src="{{asset('assets/user/img/platform@3x.png')}}" width="100%" height="">
        </div>
        <div class="col-md-6">
            <div class="heroarea-right">
                <h1>Innovative platform for <br> small investments</h1>
                <p class="m-0 my-4">Register and get $ 10,000 on a demo <br> account for learning to trade</p>
                <a href="{{url('register')}}" class="btn btn-lg btn-success btn-register px-5 py-3">Registration</a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{asset('assets/user/img/appendix@3x.png')}}" width="100%" height="">
        </div>
        <div class="col-md-6">
            <div class="heroarea-right">
                <h1>Mobile application is <br> always ready to hand</h1>
                <p class="m-0 my-4">Download our user-friendly application for <br>iPhone or Android and start trading!</p>
                <a href="{{url('register')}}" class="btn btn-lg btn-mobile">
                    <div>
                        <i class="fab fa-google-play" style="font-size: 1.9rem;"></i>
                    </div>
                    <div class="p-2">
                        <p style="color: dimgray; margin: 0; font-size: 14px; text-align: left; font-family: med;">Available on</p>
                        <p class="m-0 mt-1" style="color: lightgrey !important; font-family: bold;">Google Play</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container" id="faq">
    <div class="trading-section">
        <h1 class="text-white">Start trading</h1>
        <h3 style="color: dimgray;">3 steps</h3>
        <div class="row mb-4">
            <div class="col-md-4 text-center mt-4 mb-4">
                <img src="{{asset('assets/user/img/start-trading-1@3x.png')}}" width="120px" height="120px">
                <h4 class="mt-4" style="font-family: bold; color: lightgrey;">Sign up</h4>
                <p style="color: gray;">Open an account for free in just a <br> few minutes</p>
                <a class="btn mt-4" style="background-color: rgba(110,110,110,0.3); color: #0a58ca; padding: 8px 26px;">Trade on demo <br> account in 1 click</a>
            </div>
            <div class="col-md-4 text-center mt-4 mb-4">
                <img src="{{asset('assets/user/img/start-trading-2@3x.png')}}" width="120px" height="120px">
                <h4 class="mt-4" style="font-family: bold; color: lightgrey;">Practice</h4>
                <p style="color: gray;">Get your skills better with a demo <br> account and training materials</p>
                <a class="btn mt-4" style="background-color: rgba(110,110,110,0.3); color: #0a58ca; padding: 8px 26px;">Start training with demo <br> account</a>
            </div>
            <div class="col-md-4 text-center mt-4 mb-4">
                <img src="{{asset('assets/user/img/start-trading-3@3x.png')}}" width="120px" height="120px">
                <h4 class="mt-4" style="font-family: bold; color: lightgrey;">Deposit and trade</h4>
                <p style="color: gray;">Over 410 instruments and a minimum <br>  deposit of $5 for optimal trading</p>
                <a class="btn mt-4" style="background-color: rgba(110,110,110,0.3); color: #0a58ca; padding: 8px 26px;">Go to Deposit option</a>
            </div>
        </div>
    </div>
</div>
@stop
