@extends('user-site.trade.trading')

@section('page-title')
    Withdrawals
@stop

@section('title')
    Get Withdrawal
@stop

@section('content')
    <div class="card border-0 bg-self px-2">
        <div class="card-body bg-self p-1">
            @if(auth()->user()->is_demo_account)
                <div class="alert alert-danger">
                    <b>Note:</b><span class="ml-1">Sorry, you cannot make <b>Withdraw</b> from demo account.</span>
                </div>
            @endif
            <form method="post" name="withdrawal-form" id="withdrawal-form" action="{{url('withdrawal')}}">
                @csrf
                <input type="hidden" name="user_id" value="{{auth()->id()}}">
                @if(count($accounts) < 1)
                    <small class="text-danger">No withdrawal account is configure in settings. Please go to Account menu to set the withdrawal account.</small>
                @endif
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label class="form-label required" for="account">Payment Method</label>
                        <select class="form-control bg-dark shadow-none" name="account" id="account" required>
                            <option value="">Select Payment Method</option>
                            @if(count($accounts) > 0)
                                @foreach($accounts as $account)
                                    <option value="{{$account->id}}">{{$account->bank}}</option>
                                @endforeach
                            @endif
                        </select>
                        <label id="account-error" class="error" for="account"></label>
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="form-label required" for="amount">Amount</label>
                        <input type="number" maxlength="11" class="form-control shadow-none" name="amount" id="amount"
                               placeholder="0" required>
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn px-4 btn-success" type="submit" {{(auth()->user()->is_demo_account) ? "disabled" : ""}}>Withdraw</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function (){
            $("#withdrawal-form").validate({
                rules:{
                    amount: {
                        required:true,
                        min: 1
                    },
                    account: {
                        required:true
                    }
                },
                messages:{
                    amount: {
                        required:"Please enter amount*",
                        min: "Value must be greater then 0"
                    },
                    account: {
                        required: "Please select Payment method*"
                    }
                },
                submitHandler:function(form){
                    return true;
                }
            });
        });
    </script>
@stop
