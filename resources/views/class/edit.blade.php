@extends('layouts.default')

@section('title', 'Edit Class')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Class Edit</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i
                                class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ route('class/update', $data->class_id) }}" method="POST" id="main_form">
                        @csrf
                        <fieldset>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="major_name"><b>Major</b> <span class="text-danger">*</span></label>
                                        <select class="form-control form-control-sm" id="major_name" name="major_name">
                                            <option value="" disabled="true" selected="true">Choose Major
                                            </option>
                                            <option value="IPA" <?php echo $data->major_name == 'IPA' ? 'selected' : ''; ?>>IPA</option>
                                            <option value="IPS" <?php echo $data->major_name == 'IPS' ? 'selected' : ''; ?>>IPS</option>
                                            <option value="Bahasa" <?php echo $data->major_name == 'Bahasa' ? 'selected' : ''; ?>>Bahasa</option>
                                        </select>
                                        <span class="text-danger error-text major_name_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="grade"><b>Grade</b> <span class="text-danger">*</span></label>
                                        <select class="form-control form-control-sm" id="grade" name="grade">
                                            <option value="" disabled="true" selected="true">Choose Grade
                                            </option>
                                            <option value="10" <?php echo $data->grade == '10' ? 'selected' : ''; ?>>10</option>
                                            <option value="11" <?php echo $data->grade == '11' ? 'selected' : ''; ?>>11</option>
                                            <option value="12" <?php echo $data->grade == '12' ? 'selected' : ''; ?>>12</option>
                                        </select>
                                        <span class="text-danger error-text grade_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="class_name"><b>Class</b> <span class="text-danger">*</span></label>

                                        <input type="text" class="form-control form-control-sm"
                                            value="{{ $data->class_name }}" name="class_name" />
                                        <span class="text-danger error-text class_name_error"></span>
                                    </div>


                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning">Update</button>
                        </fieldset>
                    </form>
                </div>
                <!-- end panel-body -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
@endpush
