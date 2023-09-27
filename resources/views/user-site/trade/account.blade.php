@extends('user-site.trade.trading')

@section('page-title')
    My Account
@stop

@section('title')
    My Account
@stop

@section('content')
    <div class="card border-0 bg-self px-2">
        <div class="card-body bg-self p-1">
            <div class="row">
                <div class="col-md-6 account-box">
                    <h5 style="font-family: bold;" class="text-white m-0">Personal Info:</h5>
                    <div class="mt-3">
                        <form method="post" name="user-form" id="user-form" action="{{url('profile')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{auth()->id()}}">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center mt-1">
                                    @php
                                        $url = auth()->user()->photo ? auth()->user()->photo : asset('assets/user/img/user.png')
                                    @endphp
                                    <img src="{{$url}}" width="130px" height="130px" id="profile-photo"
                                         style="object-fit: cover;object-position: top;border-radius: 50%;"
                                         class="border border-muted p-1 shadow">
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label required" for="name">Name</label>
                                        <input type="text" class="form-control shadow-none" name="name" id="name"
                                               placeholder="e.g Tim David" value="{{auth()->user()->name}}">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label required" for="email">Email</label>
                                        <input type="email" class="form-control shadow-none" name="email" id="email"
                                               placeholder="xxxxxxxx@gmail.com" value="{{auth()->user()->email}}">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label" for="photo">Photo</label>
                                        <input type="file" class="form-control" name="photo" id="photo" onchange="setPhoto(this)">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div>
                                        <button class="btn btn-success px-4" type="submit">Save</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <div class="mt-3 ml-0 p-0 col-md-12 col-sm-12">
                            <div>
                                <button onclick="deleteAccount()" class="btn btn-danger px-4"><i class="fa fa-trash mr-1"></i>Delete My Account</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 account-box">
                    <h5 style="font-family: bold;" class="text-white m-0">Security:</h5>
                    <div class="mt-3">
                        <form method="post" autocomplete="off" name="change-password-form" id="change-password-form" action="{{url('change-password')}}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{auth()->id()}}">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label required" for="new_pass">New Password</label>
                                        <input type="password" class="form-control shadow-none" name="password" id="password">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label required" for="c_new_pass">Confirm New Password</label>
                                        <input type="password" class="form-control shadow-none" name="c_password" id="c_password">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div>
                                        <button class="btn btn-success px-4" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        function deleteAccount() {
            Swal.fire({
                text: "Are you sure you want to delete your account (this operation is irreversible) ?",
                type: 'warning',
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "Confirm",
                cancelButtonText: 'Cancel',
                customClass: {
                    confirmButton: "btn btn-primary mr-2",
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if(result.value){
                    $.ajax({
                        url: '{{url("user-account/delete")}}',
                        type: "DELETE",
                        dataType: "json",
                        cache: false,
                        success: function(res) {
                            if(res.success = 1){
                                toast(res.message, 'success');
                                setTimeout(function (){
                                    window.location.href = '{{url('/')}}';
                                }, 1000);
                            } else {
                                toast(res.message, 'error');
                            }
                        }
                    });
                }
            });
        }

        $(document).ready(function () {
            $("#withdrawal-account-form").validate({
                rules:{
                    bank: {
                        required:true
                    },
                    account_name: {
                        required:true
                    },
                    account_number: {
                        required:true
                    },
                    phone: {
                        required:true
                    }
                },
                messages:{
                    bank: {
                        required: "Please select Bank*"
                    },
                    account_name: {
                        required: "Please enter Account Name*"
                    },
                    account_number: {
                        required: "Please enter Account Number*"
                    },
                    phone: {
                        required: "Please select Phone Number*"
                    }
                },
                submitHandler:function(form){
                    return true;
                }
            });

            $('#password').val('');

            $("#change-password-form").validate({
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
                        equalTo: "Password must be equal to entered password"
                    },
                },
                submitHandler:function(form){
                    return true;
                }
            });
        });

        function setPhoto(ins) {
            const [file] = ins.files
            if (file) {
                var output = document.getElementById('profile-photo');
                output.src = URL.createObjectURL(file);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            }
        }
    </script>
@stop
