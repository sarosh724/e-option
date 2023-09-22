@extends('user-site.trade.trading')

@section('page-title')
    Withdrawal Accounts
@stop

@section('title')
    Withdrawal Account
@stop

@section('content')
    <div class="card border-0 bg-self px-2">
        <div class="card-body bg-self p-1">
            <div class="row">
                <div class="col-md-6 mt-2" style="">
                    <form method="post" name="withdrawal-account-form" id="withdrawal-account-form" autocomplete="off" action="{{url('withdrawal-account')}}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label required" for="bank">Cryptocurrency</label>
                                        <input type="text" class="form-control shadow-none" name="bank" id="bank"
                                               placeholder="Crypto Currency">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label required" for="account_title">Currency</label>
                                        <input type="text" class="form-control shadow-none" name="account_name" id="account_title"
                                               placeholder="Currency">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label required" for="account_no">Wallet Address</label>
                                        <input type="text" class="form-control shadow-none" name="account_number" id="account_no"
                                               placeholder="Wallet Address">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label required" for="mobile_no">Phone Number</label>
                                        <input type="number" min="0" class="form-control shadow-none" name="phone" id="mobile_no"
                                               placeholder="xxxxxxxxxx">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div>
                                        <button class="btn btn-success px-4" type="submit">Add Account</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>

                <div class="mt-2 col-md-6">
                    <div class="card border-0">
                        <div class="card-body bg-self border border-dark p-2">
                            <div class="table-responsive p-0">
                                <table class="table table-sm data-table" id="withdrawal-account-data-table">
                                    <thead class="">
                                    <tr>
                                        <th width="20%">Crypto Currency</th>
                                        <th width="25%">Currency</th>
                                        <th width="35%">Wallet Address</th>
                                        <th width="20%">Mobile</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-dark">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')
    <script>
        $(document).ready(function () {
            $("#withdrawal-account-form").validate({
                rules:{
                    bank: {
                        required:true
                    },
                    account_title: {
                        required:true
                    },
                    account_no: {
                        required:true
                    },
                    mobile_no: {
                        required:true
                    }
                },
                messages:{
                    bank: {
                        required: "Please enter Bank*"
                    },
                    account_title: {
                        required: "Please enter Account Name*"
                    },
                    account_no: {
                        required: "Please enter Account Number*"
                    },
                    mobile_no: {
                        required: "Please enter Phone Number*"
                    }
                },
                submitHandler:function(form){
                    return true;
                }
            });

            $('#withdrawal-account-data-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                aaSorting: [[ 0, "desc" ]],
                columnsDefs: [{
                    orderable: true
                }],
                ajax: { url: "{{url('get-withdrawal-accounts')}}" },
                columns: [
                    { data: 'bank', name: 'bank' },
                    { data: 'account_name', name: 'account_name' },
                    { data: 'account_number', name: 'account_number' },
                    { data: 'phone', name: 'phone' }
                ]
            });
        });

    </script>
@stop
