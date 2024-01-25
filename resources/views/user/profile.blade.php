@extends('layouts.default')

@section('title', 'User')

@push('css')
    <link href="{{ asset('/') }}assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="{{ asset('/') }}assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
        rel="stylesheet" />
    <link href="{{ asset('/') }}assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
@endpush

@section('content')
    <!-- begin profile -->
    <div class="profile">
        <div class="profile-header" style="height:150px;">
            <!-- BEGIN profile-header-cover -->
            <div class="profile-header-cover" style="background-image: url({{ asset('images/banner.png') }});">
            </div>
            <!-- END profile-header-cover -->
            <!-- BEGIN profile-header-content -->
            <div class="profile-header-content">
                <!-- BEGIN profile-header-img -->
                <div class="profile-header-img">
                    <!-- <img src="/assets/img/user/user-13.jpg" alt=""> -->
                    <!-- <img src="{{ asset('upload/avatar') . '/' . $data->avatar }}" alt="" width="150px" height="120px"> -->
                    @if ($data->avatar == null)
                        <img src="{{ asset('upload/avatar/default.png') }}" alt="" width="150px" height="100px">
                    @else
                        <img src="{{ asset('upload/avatar') . '/' . $data->avatar }}" alt="" width="150px"
                            height="150px">
                    @endif
                </div>
                <!-- END profile-header-img -->
                <!-- BEGIN profile-header-info -->
                <div class="profile-header-info">
                    <h4 class="mt-3 mb-1"><b>{{ auth()->user()->user_name }}</b></h4>
                    <!-- <a href="#" class="btn btn-xs btn-yellow">Edit Profile</a> -->
                </div>
                <!-- END profile-header-info -->
            </div>
            <!-- END profile-header-content -->
            <!-- BEGIN profile-header-tab -->
            <ul class="profile-header-tab nav nav-tabs">
            </ul>
            <!-- END profile-header-tab -->
        </div>
    </div>
    <!-- end profile -->
    <!-- begin profile-content -->
    <div class="profile-content">
        <!-- begin tab-content -->
        <div class="tab-content p-0">
            <!-- begin #profile-post tab -->
            <div class="panel-body">
                <form action="{{ route('user/update', $data->id) }}" method="POST" id="main_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><b>Name</b></label>
                                <input type="text" class="form-control form-control-sm m-b-5" value="{{ $data->name }}"
                                    name="name" />
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
                                <input type="password" class="form-control form-control-sm m-b-5" name="password">
                                <span class="text-danger error-text password_error"></span>
                                <small class="text-muted">Leave this field empty to keep the current password.</small>
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
                                    <input type="file" name="avatar" />
                                    <span class="text-danger error-text avatar_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>

    </div>
    <!-- end profile-content -->
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
