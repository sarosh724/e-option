<div class="card border-0">
{{--    <div class="card-header">--}}
{{--        <h6 class="m-0 font-weight-bold">Create Withdrawal</h6>--}}
{{--    </div>--}}
    <div class="card-body bg-black">
        <form method="post" name="withdrawal-form" id="withdrawal-form" action="{{url('withdrawal')}}">
            @csrf
            <input type="hidden" name="user_id" value="{{auth()->id()}}">
            @if(count($accounts) < 1)
                <small class="text-danger">No withdrawal account is configure in settings. Please go to
                    <a href="{{url('settings')}}" style="text-decoration-line: underline;">settings</a></small>
            @endif
            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="form-label required" for="account">Account</label>
                    <select class="form-control bg-dark shadow-none" name="account" id="account" required>
                        <option value="">Select Account</option>
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
                    <input type="number" maxlength="11" class="form-control shadow-none" name="amount" id="amount" required>
                </div>
            </div>

            <div class="text-center">
                <button class="btn px-4 btn-success" style="font-family: med;" type="submit">Withdraw</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function (){
        $("#withdrawal-form").validate({
            rules:{
                amount: {
                    required:true,
                    min: 1
                },
                acount: {
                    required:true
                }
            },
            messages:{
                amount: {
                    required:"Please enter amount*",
                    min: "Value must be greater then 0"
                },
                account: {
                    required: "Please select Account*"
                }
            },
            submitHandler:function(form){
                return true;
            }
        });
    });
</script>
