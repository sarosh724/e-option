<div class="card border-0">
    <div class="card-body bg-black">
        <div class="row">
            <div class="col-md-4" style="border-right: 1px dashed #6c757d; height: 600px;">
                <h5 style="font-family: bold;" class="text-white m-0">Personal Info:</h5>
                <div class="mt-3">
                    <form method="post" name="user-form" id="user-form" action="{{url('profile')}}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{auth()->id()}}">
                        <div class="row">
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
                                <div>
                                    <button class="btn btn-success px-4" style="font-family: med;" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4" style="border-right: 1px dashed #6c757d; height: 600px;">
                <h5 style="font-family: bold;" class="text-white m-0">Security:</h5>
                <div class="mt-3">
                    <form method="post" name="change-password-form" id="change-password-form" action="{{url('change-password')}}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{auth()->id()}}">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label required" for="old_pass">Old Password</label>
                                    <input type="password" class="form-control shadow-none" name="old_pass" id="old_pass">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label required" for="new_pass">New Password</label>
                                    <input type="password" class="form-control shadow-none" name="new_pass" id="new_pass">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label required" for="c_new_pass">Confirm New Password</label>
                                    <input type="password" class="form-control shadow-none" name="c_new_pass" id="c_new_pass">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div>
                                    <button class="btn btn-success px-4" style="font-family: med;" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4" style="height: 600px;">
                <h5 style="font-family: bold;" class="text-white m-0">Withdrawal Accounts:</h5>
                <div class="mt-3">
                    <form method="post" name="withdrawal-account-form" id="withdrawal-account-form" action="{{url('withdrawal-account')}}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{auth()->id()}}">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label required" for="bank">Bank / Payment Method</label>
                                    <input type="text" class="form-control shadow-none" name="bank" id="bank"
                                           placeholder="e.g">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label required" for="account_name">Account Title</label>
                                    <input type="text" class="form-control shadow-none" name="account_name" id="account_name"
                                           placeholder="John Doe">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label required" for="account_number">Account Number</label>
                                    <input type="text" class="form-control shadow-none" name="account_number" id="account_number"
                                           placeholder="19AL353737346536">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label required" for="phone">Phone Number</label>
                                    <input type="text" class="form-control shadow-none" name="phone" id="phone"
                                           placeholder="xxxxxxxxxx">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div>
                                    <button class="btn btn-success px-4" style="font-family: med;" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
    });
</script>
