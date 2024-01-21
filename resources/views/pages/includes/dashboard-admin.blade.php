@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
		<li class="breadcrumb-item active">Dashboard v2</li>
	</ol>
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
					<div class="stats-number">{{$totalStudent}}</div>
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
					<div class="stats-number">{{$totalextracurricular}}</div>
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
					<div class="stats-number">{{$totalregistpending}}</div>
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
					<div class="stats-number">{{$totaladmin}}</div>
                    <a href="user" class="stats-desc">Click here to view data Users</a>
				</div>
			</div>
		</div>
		<!-- end col-3 -->
	</div>
	<!-- end row -->
	<!-- begin row -->
	
@endsection