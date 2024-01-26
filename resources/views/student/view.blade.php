@extends('layouts.default')

@section('title', 'Student')
@push('css')
    <style>
        .center {
            text-align: center;
        }
    </style>
@endpush

@section('content')
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Student Detail</li>
    </ol>
    <h1 class="page-header"><small><b>View Student</b></small></h1>
    <div class="row">
        <div class="col-xl-12 ui-sortable">
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">Student Detail</h4>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <tbody>

                                        <tr>
                                            <td><b>Name</b></td>
                                            <td>{{ $data->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>NIS</b></td>
                                            <td>{{ $data->nis }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Class</b></td>
                                            <td>{{ $data->class_details }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Phone Number</b></td>
                                            <td>{{ $data->phone_number }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="table-responsive">
                                <table class="table table-striped center">
                                    <tbody>
                                        <tr>
                                            <td><b>Gender</b></td>
                                            <td>{{ $data->gender }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Birthdate</b></td>
                                            <td>{{ date('d-M-y', strtotime($data->birthdate)) }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Birthplace</b></td>
                                            <td>{{ $data->birthplace }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Address</b></td>
                                            <td>{{ $data->address }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
@endpush
