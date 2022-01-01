<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel X-editable task Tutorial - Rvsolutionstuff.com</title>
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"rel = "stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


</head>

<body>
    <div class="container wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center m-3">TASK SHOW </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-condensed" id="task">
                            <thead>
                                <tr>
                                    <td>id</td>
                                    <td>Name</td>
                                    <td>Status</td>
                                    <td>Date</td>
                                    <td>
                                        <button type="button" data-toggle="modal" data-target="#addtask"
                                            class="btn btn-primary">Add new task +</button>
                                    </td>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $row)
                                    <tr>
                                        <td>
                                            <a href="#" class="id" data-pk="{{ $row->id }}"
                                                data-type="text" data-title="Enter name" data-name="id">
                                                {{ $row->id }}</a>
                                        </td>
                                        <td>
                                            <a href="#" class="name" data-pk="{{ $row->id }}"
                                                data-type="text" data-title="Enter name" data-name="name">
                                                {{ $row->name }}</a>
                                        </td>
                                        <td>
                                            <a href="#" class="status" data-pk="{{ $row->id }}"
                                                data-type="text" data-title="Enter status" data-name="status">
                                                {{ $row->status }}</a>
                                        </td>

                                        <td>
                                            <a href="#" class="date" data-pk="{{ $row->id }}"
                                                data-type="text" data-name="date"> {{ $row->date }}</a>
                                        </td>
                                        <td>
                                            @if ( date_diff(new \DateTime($row->date), new \DateTime())->format("%d") > 6 )
                                                <form method="POST" action="{{ route('task.delete', [$row->id]) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-danger delete-user" value="Delete Task">
                                                    </div>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="addtask">
            <div class="container">
                <div class="row modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                            <h4 class="modal-title">Add Task :</h4>
                        </div>
                        <div class="modal-body row">
                            <form class="col" method="post" action="{{ url('store-task') }}">
                                @csrf

                                <div class='col-sm-12'>
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Task name">
                                    </div>
                                </div>

                                <div class='col-sm-12'>
                                    <div class="form-group">
                                        <label for="status" class="form-control-label">Status</label>
                                        <input type="text" class="form-control" name="status" id="status"
                                        placeholder="Enter status">
                                    </div>
                                </div>
                                <div class='col-sm-12'>
                                    <div class="form-group">

                                        <div class="input-group date">
                                            <label for="date" class="form-control-label">Date task</label>
                                            <input type="text" id="date" name="date" placeholder="Enter date">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js">
    </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- <script src="{{ URL::asset('/js/datetimepicker.js') }}"></script> --}}

    <script>
        $(document).ready(function() {
            var table = $('#task').DataTable({
                "fnRowCallback": function(nRow, mData, iDisplayIndex, iDisplayIndexFull) {
                    // add x-editable
                    $.fn.editable.defaults.mode = 'inline';
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    task_id = $(this).data('pk');
                    url = $(this).data('url');

                    //make stock editable
                    $('.name').editable({
                        url: url,
                        pk: task_id,
                        type: "text",
                        validate: function(value) {
                            if ($.trim(value) === '') {
                                return 'This field is required';
                            }
                        }
                    });

                    //make weight editable
                    $('.status').editable({
                        url: url,
                        pk: task_id,
                        type: "text",
                        validate: function(value) {
                            if ($.trim(value) === '') {
                                return 'This field is required';
                            }
                        }
                    });
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        orderable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        searchable: false
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: '',
                        name: '',
                        orderable: false
                    },
                ],
                lengthMenu: [50, 100, 200],
                "order": [[ 3, "asc" ]],
            });

            // $('.input-group.date').datepicker({format: "dd.mm.yyyy"});
            // $('#date').datepicker({ dateFormat: 'yy-mm-dd' });
            flatpickr("#date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });
        });
    </script>
</body>

</html>
