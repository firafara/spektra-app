@extends('layouts.default')
<meta http-equiv="refresh" content="120" />
@section('title', 'Dashboard')
@include('pages.includes.dashboard-page-css')
@section('content')
    @include('pages.includes.dashboard-admin')

@endsection

@include('pages.includes.dashboard-page-js')
