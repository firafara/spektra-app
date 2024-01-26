@extends('layouts.default')

@section('title', 'Class')
@push('css')
    <link href="{{ asset('/') }}assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="{{ asset('/') }}assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
        rel="stylesheet" />
@endpush

@section('content')
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Class</li>
    </ol>
    <h1 class="page-header"><small><b>List Class</b></small></h1>
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Class</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="#modal-dialog" class="btn btn-xs btn-icon btn-circle btn-green" data-toggle="modal"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Add New Class"><i
                                class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <table id="data-table" width="100%" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th class="text-nowrap">Grade</th>
                                <th class="text-nowrap">Major</th>
                                <th class="text-nowrap">Class</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-nowrap">Grade</th>
                                <th class="text-nowrap">Major</th>
                                <th class="text-nowrap">Class</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </tfoot>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Class</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form action="{{ route('class/store') }}" method="POST" id="main_form">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="panel-body">
                                    <div class="form-group row m-b-15">
                                        <label class="col-form-label col-md-3 form-control-sm"><b>Grade</b> <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <select class="form-control form-control-sm" id="grade" name="grade">
                                                <option value="" disabled="true" selected="true">Choose Grade
                                                </option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                            <span class="text-danger error-text grade_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row m-b-15">
                                        <label class="col-form-label col-md-3 form-control-sm"><b>Major</b> <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <select class="form-control form-control-sm" id="major_name" name="major_name">
                                                <option value="" disabled="true" selected="true">Choose Major
                                                </option>
                                                <option value="IPA">IPA</option>
                                                <option value="IPS">IPS</option>
                                                <option value="IPK">IPK</option>
                                            </select>
                                            <span class="text-danger error-text major_name_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row m-b-15">
                                        <label class="col-form-label col-md-3 form-control-sm"><b>Class</b> <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Enter Class" name="class_name" id="class_name" />
                                            <span class="text-danger error-text class_name_error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
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
                ajax: "{{ url('class/datatable') }}",
                columns: [{
                        data: 'grade',
                        name: 'grade'
                    },
                    {
                        data: 'major_name',
                        name: 'major_name'
                    },
                    {
                        data: 'class_name',
                        name: 'class_name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        sortable: false
                    }
                ],
                'columnDefs': [{
                    "targets": 3, // your case first column
                    "className": "text-center",
                    "width": "11%"
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
