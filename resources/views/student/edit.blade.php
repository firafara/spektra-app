@extends('layouts.default')

@section('title', 'Edit Student')

@push('css')
    <link href="{{ asset('/') }}assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('/') }}assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
@endpush

@section('content')
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboatd</a></li>
        <li class="breadcrumb-item active">Student</li>
    </ol>
    <h1 class="page-header"><small><b>Edit Student</b></small></h1>
    <div class="row">
        <div class="col-xl-12 ui-sortable">
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Student Edit</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ route('student/update', $data->student_id) }}" method="POST" id="main_form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
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
                                    <label><b>Nis</b> <span class="text-danger">*</span></label>
                                    <input type="nis" class="form-control form-control-sm m-b-5" placeholder="Enter nis"
                                        name="nis" value="{{ $data->nis }}" />
                                    <span class="text-danger error-text nis_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="class_id"><b>Class</b><span class="text-danger">*</span></label>
                                    <input type="hidden" id="class_id" name="class_id">
                                    <select name="class_id" id="class_id"
                                        class="form-control form-control-sm col-md-12 {{ $errors->has('class_id') ? 'is-invalid' : '' }}">
                                        <option value="">Choose Class</option>
                                        @if ($data)
                                            <option value="{{ $data->class_id }}" <?php echo $data->class_id == $data->class_id ? 'selected' : ''; ?>>
                                                {{ $data->class_name }}
                                            </option>
                                        @endif
                                    </select>
                                    <span class="text-danger error-text class_id_error"></span>
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Phone Number</b> <span class="text-danger">*</span></label>
                                    <input type="phone_number" class="form-control form-control-sm m-b-5"
                                        placeholder="Enter phone number" name="phone_number"
                                        value="{{ $data->phone_number }}" />
                                    <span class="text-danger error-text phone_number_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="birthdate"><b>Birthdate</b> <span class="text-danger">*</span></label>
                                    <div class="col-sm-13">
                                        <div class="input-group date" id="birthdate-input">
                                            <input type="text" class="form-control form-control-sm" id="birthdate"
                                                name="birthdate"
                                                value="{{ date('Y-m-d', strtotime($data->birthdate)) }}" />
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        <span class="text-danger error-text birthdate_error"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="birthplace"><b>Birthplace</b></label>
                                            <textarea name="birthplace" id="birthplace" class="form-control form-control-sm">{{ $data->birthplace }}</textarea>
                                        </div>
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
