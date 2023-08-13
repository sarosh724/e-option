@extends('auth.template')

@section('page-title')
    Reset Password
@stop

@section('content')
    <div class="d-flex align-items-center justify-content-center bg-gradient" style="height: 100vh;">
        <!-- Fixed BG -->
        <div class="fixed-bg" style="background-image: url(assets/site/img/shape/9.png);"></div>
        <!-- Fixed BG -->
        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-10 p-4 bg-white rounded">
            <div class="mb-3 text-center">
                <a href="index.html">
                    <img src="{{asset('assets/site/img/logo-2.png')}}" alt="Logo" width="165" height="70">
                </a>
            </div>
            <form method="POST" name="reset-form" id="reset-form">
                <div class="form-group">
                    <label class="form-label required" for="password">Password</label>
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
                <div class="form-group">
                    <label class="form-label" for="c_password">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control shadow-none"
                               name="c_password" id="c_password">
                        <div class="input-group-append">
                            <span class="input-group-text cursor-pointer">
                                <i class="fa eye fa-eye-slash toggle-password-2"></i>
                            </span>
                        </div>
                    </div>
                    <label id="c_password-error" class="error" for="c_password"></label>
                </div>
                <div>
                    <button class="btn btn-sm btn-gradient btn-block">Reset Password</button>
                </div>
            </form>
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
            $("#reset-form").validate({
                rules:{
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
                    password: {
                        required: "Password is Required*",
                        minlength: "Password must be minimum 8 characters long",
                        maxlength: "Password must be maximum 12 characters long"
                    },
                    c_password: {
                        equalTo: "Password must be equal to New Password"
                    },
                },
                submitHandler:function(form){
                    return true;
                }
            });
        });
    </script>
@stop
