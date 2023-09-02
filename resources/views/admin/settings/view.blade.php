@extends('admin.templates.index')

@section('page-title')
    Settings
@stop

@section('title')
    Settings
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="post" name="setting-form" id="setting-form" action="{{url('admin/settings')}}">
                @csrf
                <input type="hidden" name="id" value="{{@$setting->id}}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label required" for="withdraw_limit">Minimum Withdraw Limit</label>
                            <input type="number" class="form-control" value="{{@$setting->withdraw_limit}}"
                                   name="withdraw_limit" id="withdraw_limit">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label required" for="referral_sign_up_amount">Referral Sign up Amount</label>
                            <input type="number" class="form-control" min="0" value="{{@$setting->referral_sign_up_amount}}"
                                   name="referral_sign_up_amount" id="referral_sign_up_amount">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label required" for="demo_account_balance">Demo Account Balance</label>
                            <input type="number" class="form-control" min="0" value="{{@$setting->demo_account_balance}}"
                                   name="demo_account_balance" id="demo_account_balance">
                        </div>
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#setting-form").validate({
                rules:{
                    withdraw_limit: {
                        required:true,
                        min: 1
                    },
                    referral_sign_up_amount: {
                        required:true,
                        min: 0
                    },
                    demo_account_balance: {
                        required:true,
                        min: 0
                    }
                },
                messages:{
                    withdraw_limit: {
                        required:"Please enter minimum withdrawal limit*",
                        min: "Value must be greater then 0"
                    },
                    referral_sign_up_amount: {
                        required:"Please enter minimum withdrawal limit*",
                        min: "Value must be greater then 0"
                    },
                    demo_account_balance: {
                        required:"Please enter demo account balance*",
                        min: "Value must be greater then 0"
                    }
                },
                submitHandler:function(form){
                    return true;
                }
            });
        });
    </script>
@stop
