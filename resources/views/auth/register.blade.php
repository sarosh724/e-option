@extends('auth.template')

@section('page-title')
    Register
@stop

@section('content')
    <div class="d-flex align-items-center justify-content-center bg-gradient" style="height: 100vh;">
        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-10 p-4 bg-white rounded">
            <div class="text-center">
                <a href="{{url('/')}}">
                    <img src="{{asset('assets/site/img/logo-2.png')}}" alt="Logo" width="165" height="70">
                </a>
            </div>
            <form method="POST" action="{{url('register')}}" name="register-form" id="register-form">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label class="form-label required" for="username">Name</label>
                    <input type="text" class="form-control shadow-none" placeholder="name" name="name" id="username" required="">
                </div>
                <div class="form-group">
                    <label class="form-label required" for="email">Email</label>
                    <input type="email" class="form-control shadow-none" name="email" placeholder="email" id="email" required="">
                </div>
{{--                <div class="form-group">--}}
{{--                    <label class="form-label required" for="mobile_no">Mobile No</label>--}}
{{--                    <input type="number" maxlength="11" class="form-control shadow-none" placeholder="03xxxxxxxxx" name="mobile_no" id="mobile_no" required>--}}
{{--                </div>--}}
                <div class="form-group">
                    <label class="form-label required" for="password">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control shadow-none"
                               name="password" id="password" placeholder="password">
                        <div class="input-group-append">
                            <span class="input-group-text  cursor-pointer">
                                <i class="fa eye fa-eye-slash toggle-password"></i>
                            </span>
                        </div>
                    </div>
                    <label id="password-error" class="error" for="password"></label>
                </div>
                <div class="form-group">
                    <label class="form-label" for="c_password">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control shadow-none"
                               name="c_password" id="c_password" placeholder="confirm password">
                        <div class="input-group-append">
                            <span class="input-group-text cursor-pointer">
                                <i class="fa eye fa-eye-slash toggle-password-2"></i>
                            </span>
                        </div>
                    </div>
                    <label id="c_password-error" class="error" for="c_password"></label>
                </div>
                <div>
                    <button class="btn btn-sm btn-gradient btn-block">Register</button>
                </div>
            </form>
            <div class="mt-2 text-center">
                <span>
                    Already have an account?
                    <a href="{{url('/login')}}" style="text-decoration: underline;">
                        Sign In
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

        $('.toggle-password-2').click(function() {
            if(document.getElementById("c_password").type == "password"){
                $('#c_password').get(0).type= 'text'
                $(this).removeClass('fa-eye-slash')
                $(this).addClass('fa-eye')
            }else{
                $('#c_password').get(0).type= 'password'
                $(this).removeClass('fa-eye')
                $(this).addClass('fa-eye-slash')
            }
        });

        $(document).ready(function (){
            $("#register-form").validate({
                rules:{
                    username: {
                        required:true
                    },
                    gender: {
                        required:true
                    },
                    // mobile_no: {
                    //     required:true
                    // },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8,
                        maxlength: 12
                    },
                    c_password: {
                        equalTo: "#password"
                    }
                },
                messages:{
                    username: {
                        required:"Username is Required*"
                    },
                    email: {
                        required: "Email is Required*",
                        email: "Please enter Valid Email*"
                    },
                    password: {
                        required: "Password is Required*",
                        minlength: "Password must be minimum 8 characters long",
                        maxlength: "Password must be maximum 12 characters long"
                    },
                    c_password: {
                        equalTo: "Password must be equal to entered password"
                    },
                },
                submitHandler:function(form){
                    return true;
                }
            });
        });
    </script>
@stop
