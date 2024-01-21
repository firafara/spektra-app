@extends('layouts.default')

@section('title', 'Edit Student')

@push('css')
    <link href="{{ asset('/') }}assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('/') }}assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
@endpush

@section('content')
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboatd</a></li>
        <li class="breadcrumb-item active">Teacher</li>
    </ol>
    <h1 class="page-header"><small><b>Edit Teacher</b></small></h1>
    <div class="row">
        <div class="col-xl-12 ui-sortable">
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Teacher Edit</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ route('teacher/update', $data->teacher_id) }}" method="POST" id="main_form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="user_id"><b>Name</b><span class="text-danger">*</span></label>
                                    <input type="hidden" id="user_id" name="user_id">
                                    <select name="user_id" id="user_id"
                                        class="form-control form-control-sm col-md-12 {{ $errors->has('user_id') ? 'is-invalid' : '' }}">
                                        <option value="">Choose Name</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text user_id_error"></span>
                                </div>
                                <div class="form-group">
                                    <label><b>Nip</b> <span class="text-danger">*</span></label>
                                    <input type="nip" class="form-control form-control-sm m-b-5" placeholder="Enter nip"
                                        name="nip" value="{{ $data->nip }}" />
                                    <span class="text-danger error-text nip_error"></span>
                                </div>
                                <div class="form-group">
                                    <label><b>Gender</b> <span class="text-danger">*</span></label>
                                    <select id="gender" class="form-control form-control-sm" name="gender">
                                        <option value="" disabled="true" selected="true">Choose</option>
                                        <option value="Male" {{ $data->gender == 'Male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="Female" {{ $data->gender == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                    <span class="text-danger error-text gender_error"></span>
                                </div>
                                <div class="form-group">
                                    <label><b>Phone Number</b> <span class="text-danger">*</span></label>
                                    <input type="phone_number" class="form-control form-control-sm m-b-5"
                                        placeholder="Enter phone number" name="phone_number"
                                        value="{{ $data->phone_number }}" />
                                    <span class="text-danger error-text phone_number_error"></span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div> <!-- update user data end here -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/') }}assets/plugins/moment/moment.js"></script>
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script src="{{ asset('/') }}assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#birthdate-input").datepicker({
                format: "yyyy/mm/dd",
                todayHighlight: true,
                autoclose: true
            });
        });
    </script>
@endpush
