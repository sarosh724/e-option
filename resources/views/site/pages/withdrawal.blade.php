@extends('site.templates.index')

@section('content')
    @include('site.sections.breadcrumb', ['title' => 'Withdraw'])

    <div class="container py-1 mb-2">
        <div class="row">
            <div class="col-md-6 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Create Withdrawal</h6>
                    </div>
                    <div class="card-body">
                        <form method="post" name="withdrawal-form" id="withdrawal-form" action="{{url('withdrawal')}}">
                            @csrf
                            <input type="hidden" name="user_id" value="">

                            <div class="form-group">
                                <label class="form-label required" for="account">Account</label>
                                <select class="form-control shadow-none" name="account" id="account" required>
                                    <option value="">Select Account</option>
                                    @if(count($accounts) > 0)
                                        @foreach($accounts as $account)
                                            <option value="{{$account->id}}">{{$account->payment_method?->name}}</option>
                                        @endforeach
                                    @endif
                                    <option value="paypal">Paypal</option>
                                    <option value="jazzcash">Jazzcash</option>
                                    <option value="sadapay">Sadapay</option>
                                    <option value="alfalah">Alfalah Bank</option>
                                    <option value="hbl">HBL</option>
                                    <option value="easypaisa">Easypaisa</option>
                                </select>
                                <label id="account-error" class="error" for="account"></label>
                            </div>
                            <div class="form-group">
                                <label class="form-label required" for="amount">Amount</label>
                                <input type="number" maxlength="11" class="form-control shadow-none" name="amount" id="amount" required>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-gradient btn-block" type="submit">Withdraw</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Withdrawal History</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-info table-hover" id="data-table">
                                <thead class="">
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table></table>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function (){
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                stateSave: true,
                ajax: { url: "{{url('withdrawal')}}" },
                columns: [
                    { data: 'date', name: 'date' },
                    { data: 'amount', name: 'amount' },
                    { data: 'status', name: 'status' },
                ]
            });

            $("#withdrawal-form").validate({
                rules:{
                    amount: {
                        required:true
                    },
                    acount: {
                        required:true
                    }
                },
                messages:{
                    amount: {
                        required:"Please enter amount*"
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
@stop
