<div class="mt-3 col-md-12">
    <div class="card border-0">
        <div class="card-header bg-success">
            <h6 class="m-0 text-white" style="font-family: med;">Trading History</h6>
        </div>
        <div class="card-body bg-black border border-dark">
            <div class="table-responsive p-0">
                <table class="table table-sm table-dark table-striped table-hover" id="trading-data-table">
                    <thead class="">
                    <tr>
                        <th width="20%">Coin</th>
                        <th width="20%">Amount Invested</th>
                        <th width="20%">Time Period</th>
                        <th width="20%">Type</th>
                        <th width="20%">Result</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#trading-data-table').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            aaSorting: [[0, "desc"]],
            columnsDefs: [{
                orderable: true
            }],
            ajax: {url: "{{url('trading/history').'/'.auth()->user()->id}}"},
            columns: [
                {data: 'coin', name: 'coin'},
                {data: 'amount_invested', name: 'amount_invested'},
                {data: 'time_period', name: 'time_period'},
                {data: 'type', name: 'type'},
                {data: 'result', name: 'result'}
            ]
        });
    });
</script>
