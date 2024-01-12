@extends('layouts.default')

@section('title', 'Teacher')
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
        <li class="breadcrumb-item active">Teacher Detail</li>
    </ol>
    <h1 class="page-header"><small><b>View Teacher</b></small></h1>
    <div class="row">
        <div class="col-xl-12 ui-sortable">
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">Teacher Detail</h4>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <tbody>

                                        <tr>
                                            <td><b>Name</b></td>
                                            <td>{{ $data->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Nip</b></td>
                                            <td>{{ $data->nip }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Gender</b></td>
                                            <td>{{ $data->gender }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Phone Number</b></td>
                                            <td>{{ $data->phone_number }}</td>
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
