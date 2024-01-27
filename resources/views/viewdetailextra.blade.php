<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Carousel Template · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <style>
        .spektra-description {
            text-align: center;
            margin: 3rem 0;
        }

        .spektra-description h2 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #28a745; /* Bootstrap success color */
        }

        .spektra-description p {
            font-size: 1.25rem;
            line-height: 1.6;
            color: #6c757d; /* Bootstrap muted color */
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
       
    /* Modifikasi pada bagian ini */
    #page-title .bg-cover {
        background: url('{{ asset('upload/avatar/index-1.jpg') }}') center 0px / cover no-repeat;
    }

        
    </style>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
</head>

<body>
    <header data-bs-theme="dark">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-success">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="{{asset('img/pngaaa.com-72314.png')}}" width="30" height="30" class="d-inline-block align-top"
                        alt="">
                    SPEKTRA - MAN 1 KOTA PADANG
                </a>
                <div class="navbar-nav ml-auto">
                    <a class="nav-link" href="{{ url('login') }}">Log In</a>
                    <a class="nav-link" href="{{ url('register') }}">Register</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div id="page-title" class="page-title bg-cover ">

            <div class="bg-cover" data-paroller="true" data-paroller-factor="0.5" data-paroller-factor-xs="0.2"></div>
            <div class="container">
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('upload/avatar') . '/' . $extracurricular->picture }}" class="img-fluid mx-auto" width="50%" height="50%" alt="{{ $extracurricular->name }}">
                </div>
                <h1 class="display-3 fw-bold">{{ $extracurricular->name }}</h1>
                <p class="lead fw-normal">
                    {{ $extracurricular->description }}
                </p>
                <p class="lead fw-normal">
                    <h5 class="fw-normal text-muted mb-3">Pembimbing Kegiatan : {{ $extracurricular->user->name }}</h5>
                </p>
            </div>

        </div>
    </main>
    <footer class="text-body-secondary py-5">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Back to top</a>
            </p>
            <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
            <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="/docs/5.3/getting-started/introduction/">getting started guide</a>.</p>
        </div>
    </footer>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>