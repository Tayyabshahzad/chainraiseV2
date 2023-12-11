<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chainrasie | @yield('page_title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @section('page_style')
    @show
</head>

<body>
    <!-- Header Start -->
    <nav class="navbar navbar-expand-lg bg-dark-color" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ asset('vue/images/logo.png') }}" alt="Logo" width="250px" height="50px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item px-lg-3">
                        <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link" href="#">Investors</a>
                    </li>
                    <li class="nav-item dropdown px-lg-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Learn
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">FAQ</a></li>
                            <li><a class="dropdown-item" href="#">Business</a></li>
                            <li><a class="dropdown-item" href="#">Blockchain</a></li>
                        </ul>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link" href="#">Real Estate</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link" href="#">Tech</a>
                    </li>
                </ul>
                <button type="button" class="btn transparent_btn mx-3 px-4" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">Login</button>
                <button type="button" class="btn color_btn px-4">Signup</button>
            </div>
        </div>
    </nav>
    <!-- Header End -->
    <!-- Hero Section Start -->
    @section('page_content')
    @show
    <!-- 2nd Section Start -->
    <footer class="bg-dark-color">
        <div class="container">
            <div class="row pt-lg-4 pb-lg-2">
                <div class="col-lg-3">
                    <a href="{{  route('index') }}">
                        <img src="{{  asset('vue/images/logo.png')}}" alt="Logo" width="250px" height="50px">
                    </a>
                </div>
                <div class="col-lg-9 text-white">
                    <p>sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea exercitation ullamco laboris nisi ut
                        aliquip ex ea commodo consequat.</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6 text-lg-start ms-lg-0 ps-lg-0">
                    <ul class="d-flex m-lg-0 py-lg-3 px-lg-0">
                        <li class="nav-item px-lg-3">
                            <a class="nav-link active" aria-current="page" href="{{  route('index') }}">Home</a>
                        </li>
                        <li class="nav-item px-lg-3">
                            <a class="nav-link" href="#">Educational Materials</a>
                        </li>
                        <li class="nav-item px-lg-3">
                            <a class="nav-link" href="#">Privacy Policy</a>
                        </li>
                        <li class="nav-item px-lg-3">
                            <a class="nav-link" href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 my-lg-auto text-lg-end">
                    <img src="{{  asset('vue/images/social.png')}}" alt="Logo">
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <hr>
            <p class="text-white py-lg-4 text-lg-center my-0">© Copyright 2023 - investchainraise</p>
        </div>
    </footer>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-image-modal">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <a class="py-lg-4" href="#">
                        <img src="{{  asset('vue/images/logo.png')}}" alt="Logo" width="250px" height="50px">
                    </a>
                    <div class="d-grid gap-2">
                        <button class="btn transparent_btn" type="button">Button</button>
                        <button class="btn transparent_btn" type="button">Button</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    @section('page_js')
    @show
</body>

</html>
