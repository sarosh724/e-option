@extends('user-site.trade.trading')

@section('page-title')
    Withdrawal Accounts
@stop

@section('title')
    Withdrawal Account
@stop

@section('content')
    <div class="card border-0">
        <div class="card-body bg-self shadow-sm p-0 px-2 py-3">
            <div class="row">
                <div class="col-md-6 mt-2" style="">
                    <div class="mt-3">
                        <form method="post" name="withdrawal-account-form" id="withdrawal-account-form" autocomplete="off" action="{{url('withdrawal-account')}}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
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
                                        <label class="form-label required" for="account_title">Account Title</label>
                                        <input type="text" class="form-control shadow-none" name="account_title" id="account_title"
                                               placeholder="John Doe">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label required" for="account_no">Account Number</label>
                                        <input type="text" class="form-control shadow-none" name="account_no" id="account_no"
                                               placeholder="19AL353737346536">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label required" for="mobile_no">Phone Number</label>
                                        <input type="number" min="0" class="form-control shadow-none" name="mobile_no" id="mobile_no"
                                               placeholder="xxxxxxxxxx">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div>
                                        <button class="btn btn-success px-4" style="font-family: med;" type="submit">Add Account</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-3 col-md-6">
                    <div class="card border-0">
                        <div class="card-body bg-self border border-dark">
                            <div class="table-responsive p-0">
                                <table class="table table-sm data-table" id="withdrawal-account-data-table">
                                    <thead class="">
                                    <tr>
                                        <th width="20%">Bank</th>
                                        <th width="25%">Account Title</th>
                                        <th width="35%">Account Number</th>
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
