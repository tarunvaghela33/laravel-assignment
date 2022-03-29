<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('css/helper.css') }}" rel="stylesheet"></link>
    <link href="{{ asset('css/jquery.toast.css') }}" rel="stylesheet"></link>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    <!-- Styles -->

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    <div class="container">
        <h2>Users</h2>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-12">
                <button type="button" class="btn btn-danger btn-round btn-fab" id="multiple-delete" style="float:right;">Delete Multiple User</button>
                <a href="{{ route('users.create') }}" class="btn btn-success" style="margin-right: 20px;float:right;">Create User</a>
            </div>
        </div>
        {{ $dataTable->table() }}
    </div>
</body>

</html>
{{$dataTable->scripts()}}
<script src="{{ asset('js/sweetalert2.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.toast.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/helper.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.delete-user', function() {
            var token   = '{{ csrf_token() }}';
            var url     = "{{ route('users.destroy',':id') }}";
            url         = url.replace(":id", $(this).attr('data-user-id'));

            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success btn-round',
                cancelButtonClass: 'btn btn-danger btn-round',
                confirmButtonText: 'Yes, delete it!',
                buttonsStyling: false
            }).then(function(e) {
                if(e.value){
                    $.easyAjax({
                        type:"POST",
                        url: url,
                        data: {_token: token,_method:'DELETE'},
                        dataType:false,
                        success: function(response){
                            $.showToastr(response);
                            LaravelDataTables["users-table"].ajax.reload();
                        }
                    })
                }
            }).catch(swal.noop)
        });

        // $(document).on('change', '#name,#role_id', function() {
        //     LaravelDataTables["users-table"].ajax.reload();
        // });

        // Uncheck select all checkbox on pagination
        $('#users-table').on( 'page.dt', function () { $('.check-uncheck-all').prop('checked',false); } ).dataTable();

        $(document).on("change", ".check-uncheck-all", function (e) {
            var trueFalse   = $(this).is(':checked') ? true : false;
            $(".user-check").prop('checked', trueFalse);
        });


        $(document).on("change", ".user-check", function (e) {
            var trueFalse   = ($('.user-check:checked').length == $('.user-check').length) ? true : false;
            $(".check-uncheck-all").prop('checked', trueFalse);
        });

        $("#multiple-delete").click(function (e) {
            var selectedIds = [];
            var token       = '{{ csrf_token() }}';
            if ($('.user-check:checked').length != 0) {
                $('.user-check:checked').each(function(i,el){
                    selectedIds.push($(this).val());
                });

                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success btn-round',
                    cancelButtonClass: 'btn btn-danger btn-round',
                    confirmButtonText: 'Yes, delete it!',
                    buttonsStyling: false
                }).then(function(e) {
                    if(e.value){
                        $.easyAjax({
                            type:"POST",
                            url: "{{ route('delete-multiple-user') }}",
                            data: {_token: token ,user_ids: selectedIds.join(",")},
                            dataType: false,
                            success: function(response){
                                $.showToastr(response);
                                LaravelDataTables["users-table"].ajax.reload();
                            }
                        })
                    }
                }).catch(swal.noop)
            } else {
                $.showToastr("Please select at least one user!","error");
            }
        })
    });
</script>