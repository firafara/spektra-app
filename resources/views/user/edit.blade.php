@extends('layouts.default')

@section('title', 'Edit User')

@push('css')
    <link href="{{ asset('/') }}assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('/') }}assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="{{ asset('/') }}assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="{{ asset('/') }}assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="{{ asset('/') }}assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
    <link
        href="{{ asset('/') }}assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
@endpush

@section('content')
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboatd</a></li>
        <li class="breadcrumb-item active">User</li>
    </ol>
    <h1 class="page-header"><small><b>Edit User</b></small></h1>
    <div class="row">
        <div class="col-xl-12 ui-sortable">
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">User Edit</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ route('user/update', $data->id) }}" method="POST" id="main_form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Name</b></label>
                                    <input type="text" class="form-control form-control-sm m-b-5"
                                        value="{{ $data->name }}" name="name" />
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                                <div class="form-group">
                                    <label><b>Email</b><span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-sm m-b-5"
                                        value="{{ $data->email }}" name="email" />
                                    <span class="text-danger error-text email_error"></span>
                                </div>
                                <div class="form-group">
                                    <label><b>Password</b><span class="text-danger">*</span></label>
                                    <input type="password"
                                        class="form-control form-control-sm m-b-5"value="{{ $data->password }}"
                                        name="password">
                                    <span class="text-danger error-text password_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><b>Role</b> <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm" id="role" name="role">
                                        <option value="" disabled="true" selected="true">Choose Level</option>
                                        <option value="Student" <?php echo $data->role == 'Student' ? 'selected' : ''; ?>>Student</option>
                                        <option value="Admin" <?php echo $data->role == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                                        <option value="Super Admin" <?php echo $data->role == 'Super Admin' ? 'selected' : ''; ?>>Super Admin</option>
                                    </select>
                                    <span class="text-danger error-text role_error"></span>
                                </div>

                                <div class="form-group">
                                    <label><b>Avatar</b></label>
                                    <div>
                                        <input type="file" value="{{ $data->avatar }}" name="avatar" />
                                        <span class="text-danger error-text avatar_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
                <!-- end panel-body -->
            </div>
        </div> <!-- update user data end here -->
        <!-- end col-10 -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/') }}assets/plugins/moment/moment.js"></script>
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script src="{{ asset('/') }}assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset('/') }}assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script
        src="{{ asset('/') }}assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js">
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
        $(function() {
            $("input[name='is_approve']").click(function() {
                if ($("#is_approve_1").is(":checked")) {
                    $("#user_signature").removeAttr("disabled");
                    // $("#other_txt").focus();
                } else {
                    $("#user_signature").attr("disabled", "disabled");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#datepicker-birthdate,#datepicker-joindate").datepicker({
                format: "yyyy/mm/dd",
                todayHighlight: true,
                autoclose: true
            });
        });
    </script>
@endpush
