@extends('admin.templates.index')

@section('page-title')
    Users
@stop

@section('title')
    Users
@stop

@section('content')
    <div class="table-responsive">
        <table id="data-table" class="table table-grid table-striped table-sm" style="width: 100%">
            <thead class="bg-light">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Balance</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function () {
            loadTable();
        });

        function loadTable() {
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                stateSave: true,
                order: [],
                columnsDefs: [{
                    orderable: true
                }],
                ajax: {
                    url: "{{url('admin/users')}}"
                },
                columns: [
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'balance',
                        name: 'balance',
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searching: false
                    }
                ]
            });
        }

        $("#data-table").on('click', '.restrict', function () {
            $.blockUI();
            var user_id = $(this).data('id');
            var is_restricted = $(this).data('restricted');
                $.ajax({
                    url: "{{url('admin/users/restrict-account')}}",
                    type: "post",
                    data: JSON.stringify({
                        is_restricted: is_restricted,
                        user_id: user_id,
                        "_token": "{{ csrf_token() }}",
                    }),
                    processData: true,
                    contentType: "application/json; charset=UTF-8",
                    dataType: "json",
                    cache: false,
                    success: function (res) {
                        if (res.success == 1) {
                            $.unblockUI();
                            toast(res.message, 'success');
                            setTimeout(function (){
                                window.location.reload();
                            }, 1000);
                        } else {
                            $.unblockUI();
                            toast(res.message, 'error');
                        }
                    }
            });
        });

        $("#data-table").on('click', '.delete', function () {
            var id = $(this).data('id');
            Swal.fire({
                html: "Are you sure you want to delete this user?",
                type: "warning",
                confirmButtonText: "Yes",
                showCancelButton: true,
                cancelButtonText: "No",
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-danger',
                },
            }).then((result) => {
                if (!result.value) return;
                $.ajax({
                    url: "{{url('admin/users/delete')}}/" + id,
                    type: "DELETE",
                    dataType: "json",
                    cache: false,
                    success: function (res) {
                        if (res.success == 1) {
                            Swal.fire('Success', res.message, 'success');
                            setTimeout(function (){
                                window.location.reload();
                            }, 1000);
                        } else {
                            Swal.fire('Error', res.message, 'error');
                        }
                    }
                });
            });
        });

    </script>
@stop
