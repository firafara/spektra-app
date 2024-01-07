@extends('layouts.default')

@section('title', 'User')
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
        <li class="breadcrumb-item active">User Detail</li>
    </ol>
    <h1 class="page-header"><small><b>View User</b></small></h1>
    <div class="row">
        <div class="col-xl-12 ui-sortable">
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">User Detail</h4>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <tbody>

                                        <tr>
                                            <td><b>Name</b></td>
                                            <td>{{ $data->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Email</b></td>
                                            <td>{{ $data->email }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Role</b></td>
                                            <td>{{ $data->role }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="table-responsive">
                                <table class="table table-striped center">
                                    <tbody>
                                        <tr>
                                            <td><b>User's Avatar</b></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if ($data->avatar == null)
                                                    <img src="{{ asset('images/img-not-available.jpg') }}" alt=""
                                                        width="150px" height="150px">
                                                @else
                                                    <img src="{{ asset('upload/avatar') . '/' . $data->avatar }}"
                                                        alt="" width="150px" height="150px">
                                                @endif
                                            </td>
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
