@extends('user-site.index')

@section('content')
    <div class="col-md-4 m-auto my-5">
        <h1 class="signin-header">Password Recovery</h1>
        <div class="singin-box rounded">
            <p class="text-white text-center mb-4">
                To change you password, please enter the email address you used when registering your account
            </p>
            <form method="POST" name="forgot-form" id="forgot-form">
                @csrf
                <div class="mb-4">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" class="form-control shadow-none" name="email" id="email" required="" placeholder="Email">
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
                <div class="d-grid">
                    <button type="submit" class="btn btn-success py-3" style="font-family: med;">
                        Confirm email<i class="fas fa-arrow-circle-right ms-2"></i>
                    </button>
                </div>
            </form>
            <div class="mt-2 text-center">
                <span class="text-white">
                    Don't have an account?
                    <a href="{{url('/register')}}" style="text-decoration: none; font-family: med; font-size: 16px;">
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
