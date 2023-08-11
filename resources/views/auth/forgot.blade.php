@extends('auth.template')

@section('page-title')
    Forgot Password
@stop

@section('content')
    <div class="d-flex align-items-center justify-content-center bg-gradient" style="height: 100vh;">
        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-10 p-4 bg-white rounded">
            <div class="mb-3 text-center">
                <a href="index.html">
                    <img src="{{asset('assets/site/img/logo-2.png')}}" alt="Logo" width="165" height="70">
                </a>
            </div>
            <form method="POST" name="forgot-form" id="forgot-form">
                <div class="form-group">
                    <label class="form-label required" for="email">Email</label>
                    <input type="email" class="form-control shadow-none" name="email" id="email" required="">
                </div>
                <div>
                    <button class="btn btn-sm btn-gradient btn-block">Forgot Password</button>
                </div>
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
        $(document).ready(function (){
            $("#forgot-form").validate({
                rules:{
                    email: {
                        required:true,
                        email: true
                    }
                },
                messages:{
                    email: {
                        required:"Email is Required*",
                        email: "Please enter valid email address"
                    }
                },
                submitHandler:function(form){
                    return true;
                }
            });
        });
    </script>
@stop
