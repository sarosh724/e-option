@extends('site.templates.index')

@section('content')
    @include('site.sections.breadcrumb', ['title' => 'deposit'])

    <div class="container py-1 mb-2">
        <div class="row">
            <div class="col-md-6 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Create Deposit</h6>
                    </div>
                    <div class="card-body">
                        <form method="post" name="deposit-form" id="deposit-form" action="{{url('deposit')}}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{auth()->id()}}">
                            <div class="form-group">
                                <label class="form-label required" for="amount">Amount</label>
                                <input type="number" maxlength="11" class="form-control shadow-none" name="amount" id="amount" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label required" for="payment_method">Payment Method</label>
                                <select class="form-control shadow-none" name="payment_method" id="payment_method" onchange="showPaymentMethodDetail(this)"
                                        required="required">
                                    <option value="">Select Payment Method</option>
                                    @if(count($payment_methods) > 0)
                                        @foreach($payment_methods as $method)
                                            <option value="{{$method->id}}">{{$method->bank}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <label id="payment_method-error" class="error" for="payment_method"></label>
                            </div>
                            <div id="detail-box">
                                <small class="text-success">Here is Account Details where you can send money.<br>Once Admin approve deposit, you can do trading. Thank you</small>
                                <div class="form-group">
                                    <label class="form-label required" for="bank">Bank</label>
                                    <input type="text" readonly class="form-control shadow-none" name="bank" id="bank">
                                </div>
                                <div class="form-group">
                                    <label class="form-label required" for="account_name">Account Name</label>
                                    <input type="text" readonly class="form-control shadow-none" name="account_name" id="account_name">
                                </div>
                                <div class="form-group">
                                    <label class="form-label required" for="account_number">Account Number</label>
                                    <input type="text" readonly class="form-control shadow-none" name="account_number" id="account_number">
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-gradient btn-block" type="submit">Deposit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Deposit History</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-info table-hover" id="data-table">
                                <thead class="">
                                <tr>
                                    <th width="35%">Date</th>
                                    <th width="35%">Amount</th>
                                    <th width="30%">Status</th>
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
            $("#detail-box").hide();
            $("#bank").val('');
            $("#account_name").val('');
            $("#account_number").val('');

            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                stateSave: true,
                ajax: { url: "{{url('deposit')}}" },
                columns: [
                    { data: 'date', name: 'date' },
                    { data: 'amount', name: 'amount' },
                    { data: 'status', name: 'status' },
                ]
            });

            $("#deposit-form").validate({
                rules:{
                    amount: {
                        required:true,
                        min: 1
                    },
                    payment_method: {
                        required:true
                    }
                },
                messages:{
                    amount: {
                        required:"Please enter amount*",
                        min: "Value must be greater then 0"
                    },
                    payment_method: {
                        required: "Please select Payment Method*"
                    }
                },
                submitHandler:function(form){
                    return true;
                }
            });
        });

        async function showPaymentMethodDetail(cwt) {
            let method = $("#"+cwt.id).val();
            let details = await getDetail(method);
            $("#bank").val(details.bank);
            $("#account_name").val(details.account_title);
            $("#account_number").val(details.account_no);
            $("#detail-box").slideDown();
        }

        function getDetail(id) {
            return $.ajax({
                url: "{{url('payment-method')}}" + '/' + id,
                type: 'GET',
                dataType: 'json',
                contentType: 'application/json; charset=utf-8',
                success: async function (data) {
                },
                error: function (error) {
                }
            });
        }
    </script>
@stop
