@extends('layouts.default')
@section('title', 'Extracurricular Create')
@push('css')
    <link href="{{ asset('/') }}assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('/') }}assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
@endpush
@section('content')
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Extracurricular</li>
    </ol>
    <h1 class="page-header"><small><b>Edit Extracurricular</b></small></h1>
    <div class="row">
        <div class="col-xl-12 ui-sortable">
            <form action="{{ route('extracurricular/update', $data->extracurricular_id) }}" method="POST" id="main_form" enctype="multipart/form-data">
                @csrf
                <div class="panel panel-inverse">
                    <div class="panel-heading ui-sortable-handle">
                        <h4 class="panel-title">Extracurricular Edit</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="user_id"><b>Teacher Name</b><span class="text-danger">*</span></label>
                                    <input type="hidden" id="user_id" name="user_id" value="{{ old('user_id', $data->user_id) }}">
                                    <select name="user_id" id="user_id"
                                        class="form-control form-control-sm col-md-12 {{ $errors->has('user_id') ? 'is-invalid' : '' }}">
                                        <option value="">Choose Name</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('user_id', $data->user_id) == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text user_id_error"></span>
                                </div>  
                                <div class="form-group">
                                    <label><b>Name</b> <span class="text-danger">*</span></label>
                                    <input type="name" class="form-control form-control-sm m-b-5" value="{{ old('name', $data->name) }}" placeholder="Enter Name"
                                        name="name" />
                                    <span class="text-danger error-text nip_error"></span>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="description"><b>Description</b></label>
                                            <textarea name="description" id="description" class="form-control form-control-sm">{{ old('description', $data->description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><b>Picture</b></label>
                                    <div>
                                        <input type="file" name="picture" />
                                        <span class="text-danger error-text picture_error"></span>
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
            $("#birthdate-input").datepicker({
                format: "yyyy/mm/dd",
                todayHighlight: true,
                autoclose: true
            });
        });
    </script>
@endpush
