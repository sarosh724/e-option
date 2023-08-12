@extends('auth.template')

@section('page-title')
    Login
@stop

@section('content')
    <div class="d-flex align-items-center justify-content-center bg-gradient" style="height: 100vh;">
        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-10 p-4 bg-white rounded">
            <div class="mb-3 text-center">
                <a href="{{url('/')}}">
                    <img src="{{asset('assets/site/img/logo-2.png')}}" alt="Logo" width="165" height="70">
                </a>
            </div>
            <form method="POST" action="{{url('login')}}" name="login-form" id="login-form">
                @csrf
                <div class="form-group">
                    <label class="form-label required" for="username">Email</label>
                    <input type="email" class="form-control shadow-none" name="email" id="email" required="">
                </div>
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label class="form-label required" for="password">Password</label>
                        <a href="{{url('forgot')}}" style="text-decoration: underline;">
                            Forgot Password?
                        </a>
                    </div>
                    <div class="input-group">
                        <input type="password" class="form-control shadow-none"
                               name="password" id="password">
                        <div class="input-group-append">
                            <span class="input-group-text  cursor-pointer">
                                <i class="fa eye fa-eye-slash toggle-password"></i>
                            </span>
                        </div>
                    </div>
                    <label id="password-error" class="error" for="password"></label>
                </div>
                <div>
                    <button class="btn btn-sm btn-gradient btn-block">Sign In</button>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <a href="{{ url('authorized/google') }}">
                        <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
                    </a>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
            <div class="mt-2 text-center">
                <span>
                    Don't have an account?
                    <a href="{{url('register')}}" style="text-decoration: underline;">
                        Register Yourself
                    </a>
                </span>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
        $('.toggle-password').click(function() {
            if(document.getElementById("password").type == "password"){
                $('#password').get(0).type= 'text'
                $(this).removeClass('fa-eye-slash')
                $(this).addClass('fa-eye')
            }else{
                $('#password').get(0).type= 'password'
                $(this).removeClass('fa-eye')
                $(this).addClass('fa-eye-slash')
            }
        });

        $(document).ready(function (){
            $("#login-form").validate({
                rules:{
                    email: {
                        email: true,
                        required:true
                    },
                    password: {
                        required: true
                    }
                },
                messages:{
                    email: {
                        required:"Email is Required*",
                        email: "Please enter Valid Email*"
                    },
                    password: {
                        required: "Password is Required*",
                    }
                },
                submitHandler:function(form){
                    return true;
                }
            });
        });
    </script>
@stop
