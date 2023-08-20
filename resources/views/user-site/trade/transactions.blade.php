<div class="row">
    <div class="col-md-6">
        <div class="card border-0">
            <div class="card-header bg-success">
                <h6 class="m-0" style="font-family: med;">Deposit History</h6>
            </div>
            <div class="card-body bg-black border border-dark">
                <div class="table-responsive p-0">
                    <table class="table table-sm table-dark table-striped table-hover" id="deposit-data-table">
                        <thead>
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
    <div class="col-md-6">
        <div class="card border-0">
            <div class="card-header bg-success">
                <h6 class="m-0" style="font-family: med;">Withdrawal History</h6>
            </div>
            <div class="card-body bg-black border border-dark">
                <div class="table-responsive p-0">
                    <table class="table table-sm table-dark table-striped table-hover" id="withdrawal-data-table">
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

<script>
    $(document).ready(function () {
        $('#deposit-data-table').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            aaSorting: [[ 0, "desc" ]],
            columnsDefs: [{
                orderable: true
            }],
            ajax: { url: "{{url('deposit')}}" },
            columns: [
                { data: 'date', name: 'date' },
                { data: 'amount', name: 'amount' },
                { data: 'status', name: 'status' },
            ]
        });

        $('#withdrawal-data-table').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            aaSorting: [[0, "desc"]],
            columnsDefs: [{
                orderable: true
            }],
            ajax: {url: "{{url('withdrawal')}}"},
            columns: [
                {data: 'date', name: 'date'},
                {data: 'amount', name: 'amount'},
                {data: 'status', name: 'status'},
            ]
        });
    });
</script>
