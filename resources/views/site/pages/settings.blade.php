@extends('site.templates.index')

@section('page-title')
    Settings
@stop

@section('content')
    @include('site.sections.breadcrumb', ['title' => 'settings'])

    <div class="container mb-2">
        <div class="mt-2">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Withdrawal Accounts</h6>
                </div>
                <div class="card-body">
                    <form method="post" name="withdrawal-account-form" id="withdrawal-account-form" action="{{url('withdrawal-account')}}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{auth()->id()}}">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label required" for="bank">Bank / Payment Method</label>
                                    <input type="text" class="form-control shadow-none" name="bank" id="bank"
                                           placeholder="e.g Sadapay">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label required" for="account_name">Account Title</label>
                                    <input type="text" class="form-control shadow-none" name="account_name" id="account_name"
                                        placeholder="John Doe">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label required" for="account_number">Account Number</label>
                                    <input type="text" class="form-control shadow-none" name="account_number" id="account_number"
                                        placeholder="PK19AL353737346536">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label required" for="phone">Phone Number</label>
                                    <input type="text" class="form-control shadow-none" name="phone" id="phone"
                                        placeholder="xxxxxxxxxx">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div>
                                    <button class="btn btn-sm btn-gradient" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive mt-3">
                        <table class="table table-sm table-info table-hover" id="accounts-data-table">
                            <thead class="">
                            <tr>
                                <th width="25%">Bank</th>
                                <th>Account Name</th>
                                <th>Account Number</th>
                                <th>Phone</th>
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
@stop

@section('scripts')
    <script>
        $(document).ready(function (){
            $('#accounts-data-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                stateSave: true,
                ajax: { url: "{{url('withdrawal-accounts')}}" },
                columns: [
                    { data: 'bank', name: 'bank' },
                    { data: 'account_name', name: 'account_name' },
                    { data: 'account_number', name: 'account_number' },
                    { data: 'phone', name: 'phone' }
                ]
            });

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
@stop
