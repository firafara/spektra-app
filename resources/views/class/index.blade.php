{{-- @extends('dashboard.layouts.main')

@section('title', 'Course')
@push('styles')
@endpush
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container">
        <div class="bread-crumb flex-w p-t-10">
            <a href="/dashboard" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4 active">
                Class
            </span>
        </div>
    </div>

    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="table table-striped table-bordered table-hover table-light" id="tabel">
                <thead class="table-success">
                    <tr>
                        <th>Major</th>
                        <th>Grade</th>
                        <th>Class</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dt)
                        <tr>
                            <td>{{ $dt->major_name }}</td>
                            <td>{{ $dt->grade }}</td>
                            <td>{{ $dt->class_name }}</td>
                            <td>
                                <a href="{{ url('/class/edit', $dt->class_id) }}" class="btn btn-primary"><i
                                        class="fas fa-edit"></i></a>
                                @method('delete')
                                @csrf
                                <a href="{{ url('/class/delete', $dt->class_id) }}"
                                    onclick="return confirm('Apakah Anda ingin menghapus data?')" class="btn btn-danger"> <i
                                        class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
@endpush --}}
