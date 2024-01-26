@extends('layouts.default')
@section('title', 'Registration Create')
@push('css')
    <link href="{{ asset('/') }}assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('/') }}assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
@endpush
@section('content')
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Registration</li>
    </ol>
    <h1 class="page-header"><small><b>Create Registration</b></small></h1>
    <div class="row">
        <div class="col-xl-12 ui-sortable">
            <form action="{{ route('registration/store') }}" method="POST" id="main_form">
                @csrf
                @method('post')
                <div class="panel panel-inverse">
                    <div class="panel-heading ui-sortable-handle">
                        <h4 class="panel-title">Registration Create</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if (Auth::user()->role != "Student")
                                    <label for="user_id"><b>User Name</b><span class="text-danger">*</span></label>
                                    <select name="user_id" id="user_id" class="form-control form-control-sm col-md-12 {{ $errors->has('user_id') ? 'is-invalid' : '' }}">
                                        <option value="">Choose Name</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text user_id_error"></span>
                                    @else
                                    <label for="user_id"><b>User Name</b><span class="text-danger">*</span></label>
                                    <select name="user_id" id="user_id" class="form-control form-control-sm col-md-12 {{ $errors->has('user_id') ? 'is-invalid' : '' }}">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text user_id_error"></span>
                                    @endif
                                </div> 
                                  <div class="form-group">
                                    <label for="extracurricular_id"><b>Extracurricular</b><span class="text-danger">*</span></label>
                                    <select name="extracurricular_id" id="extracurricular_id" class="form-control form-control-sm col-md-12 {{ $errors->has('extracurricular_id') ? 'is-invalid' : '' }}">
                                        <option value="">Choose Extracurricular</option>
                                        @foreach ($extracurricular as $extracurriculars)
                                            <option value="{{ $extracurriculars->extracurricular_id }}" {{ old('extracurricular_id') == $extracurriculars->extracurricular_id ? 'selected' : '' }}>
                                                {{ $extracurriculars->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text user_id_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="registration_date"><b>Registration Date</b> <span class="text-danger">*</span></label>
                                    <div class="col-sm-13">
                                        <div class="input-group date" id="registration_date-input">
                                            <input type="text" class="form-control form-control-sm" id="registration_date"
                                                name="registration_date" value="{{ old('registration_date') }}" />
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        <span class="text-danger error-text registration_date_error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><b>Approval Letter</b></label>
                                    <div>
                                        <input type="file" id="approval_letter" name="approval_letter" value="{{ old('approval_letter') }}">
                                        <span class="text-danger error-text avatar_error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    @if (Auth::user()->role != "Student")
                                    <label><b>Status</b> <span class="text-danger">*</span></label>
                                    <select id="status" class="form-control form-control-sm" name="status">
                                        <option value="" disabled="true" selected="true">Choose</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                    <span class="text-danger error-text gender_error"></span>
                                    @else
                            
                                    @endif
                                </div>
                            </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/') }}assets/plugins/moment/moment.js"></script>
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script src="{{ asset('/') }}assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="{{ asset('/') }}assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>

    <script>
        $(document).ready(function() {
            $("#registration_date-input").datepicker({
                format: "yyyy/mm/dd",
                todayHighlight: true,
                autoclose: true
            });
        });
    </script>
@endpush
