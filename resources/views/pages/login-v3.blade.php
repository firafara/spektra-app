@extends('layouts.empty', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('title', 'Login Page')

@section('content')
    <!-- begin login -->
    <div class="login login-with-news-feed">
        <!-- begin news-feed -->
        <div class="news-feed">
            <div class="news-image" style="background-image: url(/assets/img/login-bg/login-bg-11.jpg)"></div>
            <div class="news-caption">
                <h4 class="caption-title"><b>Spektra</b> Admin App</h4>
                <p>
                    Download the Color Admin app for iPhone®, iPad®, and Android™. Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit.
                </p>
            </div>
        </div>
        <!-- end news-feed -->
        <!-- begin right-content -->
        <div class="right-content">
            <!-- begin login-header -->
            <div class="login-header">
                <div class="brand">
                    <span class="logo"></span> <b>Spektra</b> Admin
                    <small>Ekstrakurikuler Yang Menyenangkan!!</small>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in-alt"></i>
                </div>
            </div>
            <!-- end login-header -->
            <!-- begin login-content -->
            <div class="login-content">
                <form action="{{ url('/loginProses') }}" method="POST" class="margin-bottom-0">
                    @csrf
                    <div class="form-group m-b-15">
                        <input type="text" class="form-control form-control-lg" name="email"
                            placeholder="Email Address" required />
                    </div>
                    <div class="form-group m-b-15">
                        <input type="password" class="form-control form-control-lg" name="password" placeholder="Password"
                            required />
                    </div>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-success btn-block btn-lg">Masuk</button>
                    </div>
                    <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                        Belum memiliki akun? Klik <a href="{{ url('register_v3.html') }}">disini</a> untuk register.
                    </div>
                    <hr />
                    <p class="text-center text-grey-darker mb-0">
                        &copy; Color Admin All Right Reserved {{ date('Y') }}
                    </p>
                </form>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end right-container -->
    </div>
    <!-- end login -->
@endsection
