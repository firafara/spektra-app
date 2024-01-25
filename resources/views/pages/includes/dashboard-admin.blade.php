@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item active">Dashboard v2</li>
    </ol>
    @if (Auth::user()->role == 'Super Admin' || Auth::user()->role == 'Admin')
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Welcome to Spektra Admin Dashboard</h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <!-- begin col-3 -->
            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats bg-teal">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
                    <div class="stats-content">
                        <div class="stats-title">TOTAL STUDENTS</div>
                        <div class="stats-number">{{ $totalStudent }}</div>
                        <a href="user" class="stats-desc">Click here to view data Users</a>
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats bg-blue">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-bars fa-fw"></i></div>
                    <div class="stats-content">
                        <div class="stats-title">TOTAL EXTRACURRICULAR</div>
                        <div class="stats-number">{{ $totalextracurricular }}</div>
                        <a href="extracurricular" class="stats-desc">Click here to view data Extracurricular</a>
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats bg-indigo">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-user fa-fw"></i></div>
                    <div class="stats-content">
                        <div class="stats-title">TOTAL STUDENT PENDING</div>
                        <div class="stats-number">{{ $totalregistpending }}</div>
                        <a href="registration" class="stats-desc">Click here to view data Registration</a>
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats bg-dark">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
                    <div class="stats-content">
                        <div class="stats-title">TOTAL ADMIN</div>
                        <div class="stats-number">{{ $totaladmin }}</div>
                        <a href="user" class="stats-desc">Click here to view data Users</a>
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
        </div>
    @elseif (Auth::user()->role == 'Student')
        <div class="col-xl-12 ui-sortable">
            <h1 class="page-header">Welcome to Spektra <b>{{ auth()->user()->name }}</b> Lets Check your Data First</h1>
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">Your Data</b></h4>
                    <a href="" class="btn btn-primary btn-icon btn-sm" title="Edit"></a>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <tbody>

                                        <tr>
                                            <td><b>Name</b></td>
                                            <td>{{ auth()->user()->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Email</b></td>
                                            <td>{{ auth()->user()->email }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>You Are..</b></td>
                                            <td>{{ auth()->user()->role }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>NIS</b></td>
                                            <td>{{ auth()->user()->student->nis ?? 'Not available' }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Class Data</b></td>
                                            <td>{{ auth()->user()->student->class->grade ?? 'Grade Not available' }}
                                                {{ auth()->user()->student->class->major_name ?? 'Major Not available' }}
                                                {{ auth()->user()->student->class->class_name ?? 'Class Not available' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Phone Number</b></td>
                                            <td>{{ auth()->user()->student->phone_number ?? 'Not available' }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Gender</b></td>
                                            <td>{{ auth()->user()->student->gender ?? 'Not available' }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Birthdate</b></td>
                                            <td>{{ date('d-M-y', strtotime(auth()->user()->student->birthdate ?? 'Not available')) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Birthplace</b></td>
                                            <td>{{ auth()->user()->student->birthplace ?? 'Not available' }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Address</b></td>
                                            <td>{{ auth()->user()->student->address ?? 'Not available' }}</td>
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
                                            <td><b>Your Picture</b></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if (auth()->user()->avatar == null)
                                                    <img src="{{ asset('images/img-not-available.jpg') }}" alt=""
                                                        width="250px" height="250px">
                                                @else
                                                    <img src="{{ asset('upload/avatar') . '/' . auth()->user()->avatar }}"
                                                        alt="" width="250px" height="250px">
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Your Pending Status</b></td>
                                            <td>
                                                @php
                                                    $pendingCount = auth()
                                                        ->user()
                                                        ->registration()
                                                        ->where('status', 'Pending')
                                                        ->count();
                                                @endphp

                                                @if ($pendingCount > 0)
                                                    You Have {{ $pendingCount }} Pending Status
                                                @else
                                                    You Have {{ $pendingCount }} Pending Status
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Your Approved Status</b></td>
                                            <td>
                                                @php
                                                    $approvedCount = auth()
                                                        ->user()
                                                        ->registration()
                                                        ->where('status', 'Approved')
                                                        ->count();
                                                @endphp

                                                @if ($approvedCount > 0)
                                                    You Have {{ $approvedCount }} Approved Status
                                                @else
                                                    You Have {{ $approvedCount }} Approved Status
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Your Rejected Status</b></td>
                                            <td>
                                                @php
                                                    $rejectedCount = auth()
                                                        ->user()
                                                        ->registration()
                                                        ->where('status', 'Rejected')
                                                        ->count();
                                                @endphp

                                                @if ($rejectedCount > 0)
                                                    You Have {{ $rejectedCount }} Rejected Status
                                                @else
                                                    You Have {{ $rejectedCount }} Rejected Status
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
    @endif
    <!-- end row -->
    <!-- begin row -->

@endsection
