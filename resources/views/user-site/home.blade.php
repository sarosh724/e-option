@extends('user-site.index')

@section('content')
<div class="container">
    <div class="row flex-row-reverse">
        <div class="col-md-6">
            <img src="{{asset('assets/user/img/platform@3x.png')}}" width="100%" height="">
        </div>
        <div class="col-md-6">
            <div class="heroarea-right">
                <h1>Unlock your trading potential with Easy Option - where
                    simplicity meets success in the financial markets!</h1>
                <p class="m-0 my-4">Register and get your free bonus to trade on a demo account for learning</p>
                <a href="{{url('register')}}" class="btn btn-lg btn-success btn-register px-5 py-3">Registration</a>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="trading-section">
        <p class="text-capitalize text-center text-success">how to start</p>
        <h2 class="text-capitalize text-center">how it works</h2>
        <div class="row my-4">
            <div class="col-md-4">
                <div class="card py-4">
                    <img src="{{asset('assets/user/img/signup.png')}}" class="mx-auto" width="120px" height="120px">
                    <h4 class="m-0 mt-4" style="font-family: bold; color: lightgrey;">Sign up</h4>
                    <p class="m-0 mt-2" style="color: gray;">Create a free account in few seconds</p>
                    <a href="{{url('register')}}" class="link link-success mt-2">Create account</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card py-4">
                    <img src="{{asset('assets/user/img/start-trading-2@3x.png')}}" class="mx-auto" width="120px" height="120px">
                    <h4 class="m-0 mt-4" style="font-family: bold; color: lightgrey;">Practice</h4>
                    <p class="m-0 mt-2" style="color: gray;">Create demo account and start practising</p>
                    <a href="{{url('register')}}" class="link link-success mt-2">Start training with demo account</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card py-4">
                    <img src="{{asset('assets/user/img/start-trading-3@3x.png')}}" class="mx-auto" width="120px" height="120px">
                    <h4 class="m-0 mt-4" style="font-family: bold; color: lightgrey;">Deposit and trade</h4>
                    <p class="m-0 mt-2" style="color: gray;">Deposit minimal 5$ and start optimal trading</p>
                    <a href="{{url('register')}}" class="link link-success mt-2">Go to Deposit option</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row flex-row-reverse">
        <div class="col-md-6 text-center">
            <img src="{{asset('assets/user/img/appendix@3x.png')}}" style="object-fit: contain;" width="100%" height="">
        </div>
        <div class="col-md-6">
            <div class="heroarea-right">
                <h1>‘’Easy Option’’ is
                    always ready to hand</h1>
                <p class="m-0 my-3">Download our application for android or iPhone and start easy trading</p>
                <span style="color: white; margin: 0; font-size: 14px; font-family: med;">App Is Under Maintenance</span>
                <div class="text-white mb-3" style="font-size: larger; font-family: med" id="timer"></div>
                <a class="btn btn-success btn-mobile px-4 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fab fa-google-play" style="font-size: 1.5rem;"></i>
                        </div>
                        <div class="px-2">
                            <span style="font-family: regular;">Google Play</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container p-0 py-4 rounded-3 mt-2" id="about">
    <div class="row">
        <div class="col-md-3 px-5 py-3">
            <img src="{{asset('assets/user/img/dignity-1.png')}}">
            <h5 class="m-0 text-white my-3" style="font-family: bold;">Streamlined trading platform</h5>
            <p class="m-0" style="color: gray;">We have created the most simple, unique and user-friendly interface so that
                                        everyone can use this app with the ease of their mind</p>
        </div>
        <div class="col-md-3 px-5 py-3">
            <img src="{{asset('assets/user/img/dignity-2.png')}}">
            <h5 class="m-0 text-white my-3" style="font-family: bold;">Incorporated trading signals</h5>
            <p class="m-0" style="color: gray;">You can create your own effective strategy with an accuracy of 90% with the
                most precise and innovative integrated trading signals.</p>
        </div>
        <div class="col-md-3 px-5 py-3">
            <img src="{{asset('assets/user/img/dignity-3.png')}}">
            <h5 class="m-0 text-white my-3" style="font-family: bold;">Trading Indicators</h5>
            <p class="m-0" style="color: gray;">The most useful trading indicators which will boost your account balance
                are placed at one place in this app to provide the best user outcome.</p>
        </div>
        <div class="col-md-3 px-5 py-3">
            <img src="{{asset('assets/user/img/dignity-4.png')}}">
            <h5 class="m-0 text-white my-3" style="font-family: bold;">Optimal Speed</h5>
            <p class="m-0" style="color: gray;">his app runs on the latest technology which gives the users an incredible
                speed.</p>
        </div>
    </div>
    <div class="text-center mt-4">
        <a class="btn btn-success px-4 py-3" href="{{url('register')}}" style="font-family: regular; font-size: 14px;">
            Try demo account<i class="fas fa-arrow-circle-right ms-2"></i>
        </a>
    </div>
</div>

<div class="container py-3" id="faq">
    <div class="trading-section">
        <p class="text-capitalize text-center text-success">token FAQ</p>
        <h2 class="text-capitalize text-center">frequently questions</h2>
        <div class="row my-4">
            <div class="col-md-6">
                <div>
                    <img src="{{asset('assets/user/img/faq.png')}}" style="object-fit: contain;" width="100%" height="400px">
                </div>
            </div>
            <div class="col-md-6">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseOne">
                                <h5 style="font-family: med; margin: 0;">How to earn?</h5>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                Sign up and train on a demo account. It is exactly the same as real trading, but for free.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                <h5 style="font-family: med; margin: 0;">Can I trade with the phone?</h5>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body">
                                Our platform runs on the most modern technology and opens in the browser of any computer or mobile phone.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                <h5 style="font-family: med; margin: 0;">How long does it take to withdraw funds?</h5>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body">
                                On average, the withdrawal procedure takes from one to five days from the date of receipt of the corresponding request of the Client and depends only on the volume of simultaneously processed requests. The company always tries to make payments directly on the day the request is received from the Client.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                <h5 style="font-family: med; margin: 0;">What is the minimum deposit amount?</h5>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">
                            <div class="accordion-body">
                                The advantage of the Company’s trading platform is that you don’t have to deposit large amounts to your account. You can start trading by investing a small amount of money. The minimum deposit is 10 US dollars.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                                <h5 style="font-family: med; margin: 0;">What is a trading platform and why it is needed?</h5>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFive">
                            <div class="accordion-body">
                                Trading platform - a software complex that allows the Client to conduct trades (operations) using different financial instruments. It has also accesses to various information such as the value of quotations, real-time market positions, actions of the Company, etc.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false" aria-controls="panelsStayOpen-collapseSix">
                                <h5 style="font-family: med; margin: 0;">Is there any fee for depositing and withdrawing funds from the account?</h5>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingSix">
                            <div class="accordion-body">
                                No. The company does not charge any fee for either the deposit or for the withdrawal operations.<br>However, it is worth considering that payment systems can charge their fee and use the internal currency conversion rate.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
<script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<script>

    $(function() {
        updateTimer();
    });

    // Function to calculate the time remaining in seconds
    function getTimeRemaining(endTime) {
        const totalMilliseconds = Date.parse(endTime) - Date.now();
        const totalSeconds = Math.floor(totalMilliseconds / 1000);
        const days = Math.floor(totalSeconds / (3600 * 24));
        const seconds = totalSeconds % 60;
        const minutes = Math.floor((totalSeconds % 3600) / 60);
        const hours = Math.floor((totalSeconds % 86400) / 3600);

        return {
            'total': totalSeconds,
            'days': days,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
        };
    }

    // Function to update the countdown timer
    function updateTimer() {
        const endTime = new Date("October 22, 2023 23:59:59");
        function update() {
            const timeRemaining = getTimeRemaining(endTime);

            if (timeRemaining.total <= 0) {
                clearInterval(timerInterval);
                document.getElementById('timer').innerHTML = '';
            } else {
                const timerText = `${timeRemaining.days} days ${timeRemaining.hours}:${timeRemaining.minutes}:${timeRemaining.seconds}`;
                document.getElementById('timer').innerHTML = timerText;
            }
        }

        update(); // Call the function immediately to prevent a delay in displaying the timer

        const timerInterval = setInterval(update, 1000); // Update the timer every second
    }

    updateTimer(); // Start the countdown timer when the page loads

</script>
