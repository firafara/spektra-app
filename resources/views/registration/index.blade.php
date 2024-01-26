@extends('layouts.default')

@section('title', 'Registration')
@push('css')
    <link href="{{ asset('/') }}assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="{{ asset('/') }}assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
        rel="stylesheet" />
@endpush

@section('content')
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Registration</li>
    </ol>
    <h1 class="page-header"><small><b>List Registration</b></small></h1>
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Registration</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="{{ route('registration/create') }}" class="btn btn-xs btn-icon btn-circle btn-green"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Add New Registration"><i
                                class="fa fa-plus"></i></a>

                    </div>
                </div>
                <div class="panel-body">
                    <table id="data-table" width="100%" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th class="text-nowrap">User Name</th>
                                <th class="text-nowrap">Extracurricular</th>
                                <th class="text-nowrap">Registration Date</th>
                                <th class="text-nowrap">Status</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-nowrap">User Name</th>
                                <th class="text-nowrap">Extracurricular</th>
                                <th class="text-nowrap">Registration Date</th>
                                <th class="text-nowrap">Status</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </tfoot>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('/') }}assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(function() {
            $("#data-table").DataTable({
                responsive: true,
                processing: true,
                pagingType: 'full_numbers',
                stateSave: false,
                scrollY: true,
                scrollX: true,
                ajax: "{{ url('registration/datatable') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'extra_name',
                        name: 'extra_name'
                    },
                    {
                        data: 'registration_date',
                        name: 'registration_date'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        sortable: false
                    }
                ],
                'columnDefs': [{
                    "targets": 4, // your case first column
                    "className": "text-center",
                    "width": "12%"
                }]
            });
        });
    </script>
    <script>
        function deleteData(dt) {
            Swal.fire({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this item!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'DELETE',
                        url: $(dt).data("url"),
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status) {
                                location.reload();
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
            return false;
        }
    </script>
@endpush
