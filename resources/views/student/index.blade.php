@extends('layouts.default')

@section('title', 'Student')

@push('css')
    <link href="{{ asset('/') }}assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="{{ asset('/') }}assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
        rel="stylesheet" />
    <link href="{{ asset('/') }}assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
@endpush

@section('content')
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Students</li>
    </ol>
    <h1 class="page-header"><small><b>List Students</b></small></h1>
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Students</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="{{ route('student/create') }}" class="btn btn-xs btn-icon btn-circle btn-green"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Add New Student"><i
                                class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <table id="data-table" width="100%" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">NIS</th>
                                <th class="text-nowrap">Class</th>
                                <th class="text-nowrap">Phone Number</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">NIS</th>
                                <th class="text-nowrap">Class</th>
                                <th class="text-nowrap">Phone Number</th>
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
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
    <script src="{{ asset('/') }}assets/plugins/select2/dist/js/select2.min.js"></script>
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
                ajax: "{{ url('student/datatable') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'nis',
                        name: 'nis'
                    },
                    {
                        data: 'class_details',
                        name: 'class_details'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        sortable: false
                    }
                ],
                'columnDefs': [{
                    "targets": 4, // your case first column mulai dari 0
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
