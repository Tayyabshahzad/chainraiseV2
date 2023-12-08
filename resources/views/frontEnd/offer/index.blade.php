<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chainrasie</title>
    <link rel="stylesheet" href="{{ asset('vue/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- Header Start -->
    <nav class="navbar navbar-expand-lg bg-dark-color" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="#">
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
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
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
    <section class="p-lg-5 p-3 hero-bg">
        <div class="container">
            <div class="row">
                <h3>Investing Platform for</h3>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <h1 class="display-1">Next-Gen Companies</h1>
                    <h6 class="text-white my-lg-3">Screened Investments in Artificial Intelligence, Blockchain
                        companies, Real
                        Estate, and more.</h6>
                    <div class="d-grid gap-2 d-md-block pt-lg-3">
                        <button class="btn color_btn px-lg-5" type="button"><img src="{{  asset('vue/images/Group.png') }}"> Explore
                            Tech</button>
                        <button class="btn transparent_btn px-lg-4 ms-lg-3" type="button"><img src="{{  asset('vue/images/Group.png')}}">
                            Explore
                            Real
                            Estate</button>
                    </div>
                </div>
                <div class="col-lg-6 text-lg-end py-lg-0 py-4">
                    <img src="{{  asset('vue/images/hero-video.png')}}" class="img-fluid" alt="Hero Video">
                </div>
            </div>

        </div>
    </section>
    <!-- Hero Section End -->
    <!-- 2nd Section Start -->
    <section class="p-lg-5 p-3 section-bg">
        <div class=" container">
            <div class="row">
                <div class="col-12 text-lg-center">
                    <h1 class="second">We collaborate with 200+ leading companies
                    </h1>
                    <h6 class="second">Lorem Ipsum has been the industry's standard
                        dummy text ever
                        since the 1500s,
                        when
                        an unknown
                        been the industry's standard dummy </h6>
                    <img src="{{  asset('vue/images/Group 877.png')}}" class="img-fluid mt-5" alt="Hero Video">
                </div>
            </div>
        </div>
    </section>
    <section class="bg-dark-color p-lg-5 p-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9 position-relative">
                    <hr class="verticle-line-bar">
                    <h1 class="second">Explore startups raising now</h1>
                    <h6 class="third">Lorem Ipsum has been the industry's standard
                        dummy text ever since the 1500s, when an unknown</h6>
                </div>
                <div class="col-lg-3 text-end">
                    <button type="button" class="btn color_btn px-lg-5">View all</button>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-dark-color p-lg-5 p-3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <div class="row">
                                    @foreach ($activeOffers as $active)
                                    <div class="col-lg-4">
                                        <div class="card border-style">
                                            <div class="position-absolute bg-orange p-1 px-lg-4 rotate-div">
                                                <p class="trend text-white text-lg-end mb-0"><img src="{{  asset('vue/images/flame.svg')}}"
                                                        class="img-fluid me-2">Trending
                                                </p>
                                            </div>
                                            <img src="{{ $active->getFirstMediaUrl('offer_thumbnail', 'thumb') }}" class="card-img-top" alt="Image 1">
                                            <div class="card-body bg-dark">
                                                <div class="d-flex justify-content-end">
                                                    <img src="{{ $active->getFirstMediaUrl('offer_logo', 'thumb') }}" class="img-fluid shield">
                                                </div>
                                                <h5 class="card-title text-white"> {{ $active->name }} </h5>
                                                <p class="card-text text-white">{{  $active->short_description  }}</p>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p class="text-white mb-0 pb-0">Offer Type</p>
                                                        <b class="text-white">{{  $active->short_description  }}</b>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p class="text-white mb-0 pb-0">Total Valuation</p>
                                                        <b class="text-white">{{  $active->total_valuation  }}</b>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p class="text-white mb-0 pb-0">Offer Type</p>
                                                        <b class="text-white">{{  $active->offer_type  }}</b>
                                                    </div>
                                                </div>
                                                <span class="badge  my-3"> <img src="{{  asset('vue/images/clock.png')  }}"> Limited Stock
                                                    Available for 30
                                                    days.</span>
                                                <div class="d-grid gap-2 col-12 mx-auto">
                                                    <button class="btn color_btn" type="button">Invest Now</button>
                                                    <a href="{{ route('offer.details', $active->slug) }}" class="btn transparent_btn" type="button">Learn  More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="row">
                                    @foreach ($remainingOffers as $active)
                                    <div class="col-lg-4">
                                        <div class="card border-style">
                                            <div class="position-absolute bg-orange p-1 px-lg-4 rotate-div">
                                                <p class="trend text-white text-lg-end mb-0"><img src="{{  asset('vue/images/flame.svg')}}"
                                                        class="img-fluid me-2">Trending
                                                </p>
                                            </div>
                                            <img src="{{ $active->getFirstMediaUrl('offer_thumbnail', 'thumb') }}" class="card-img-top" alt="Image 1">
                                            <div class="card-body bg-dark">
                                                <div class="d-flex justify-content-end">
                                                    <img src="{{ $active->getFirstMediaUrl('offer_logo', 'thumb') }}" class="img-fluid shield">
                                                </div>
                                                <h5 class="card-title text-white"> {{ $active->name }} </h5>
                                                <p class="card-text text-white">{{  $active->short_description  }}</p>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p class="text-white mb-0 pb-0">Offer Type</p>
                                                        <b class="text-white">{{  $active->short_description  }}</b>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p class="text-white mb-0 pb-0">Total Valuation</p>
                                                        <b class="text-white">{{  $active->total_valuation  }}</b>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p class="text-white mb-0 pb-0">Offer Type</p>
                                                        <b class="text-white">{{  $active->offer_type  }}</b>
                                                    </div>
                                                </div>
                                                <span class="badge  my-3"> <img src="{{  asset('vue/images/clock.png')  }}"> Limited Stock
                                                    Available for 30
                                                    days.</span>
                                                <div class="d-grid gap-2 col-12 mx-auto">
                                                    <button class="btn color_btn" type="button">Invest Now</button>
                                                    <a href="{{ route('offer.details', $active->slug) }}" class="btn transparent_btn" type="button">Learn  More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>





                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-dark-color p-lg-5 p-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 position-relative">
                    <hr class="verticle-line-bar">
                    <h1 class="third">How to Invest</h1>
                    <h6 class="third">Lorem Ipsum has been the industry's standard
                        dummy text ever since the 1500s, when an unknown</h6>
                </div>
            </div>
            <div class="row align-items-center p-lg-5">
                <div class="col-lg-5">
                    <img src="{{  asset('vue/images/mob.png')}}" class="img-fluid" alt="Hero Video">
                </div>
                <div class="col-lg-7 ps-lg-4">
                    <h1 class="third">SIGN UP</h1>
                    <h6 class="animate__animated animate__fadeInRight third">
                        New users will be prompted to create an
                        account and provide
                        initial information for a customized setup. Lorem Ipsum has been the industry's standard dummy
                        text ever since the 1500s.</h6>
                </div>
            </div>
            <div class="row align-items-center p-lg-5">
                <div class="col-lg-7">
                    <h1 class="third">EXPLORE</h1>
                    <h6 class="animate__animated animate__fadeInLeft third">Explore our
                        marketplace for investment opportunities after
                        creating your account. Lorem Ipsum has been the industry's standard dummy text ever since the
                        1500s.</h6>
                </div>
                <div class="col-lg-5 text-end">
                    <img src="{{  asset('vue/images/mob-2.png')}}" class="img-fluid" alt="Hero Video">
                </div>

            </div>
            <div class="row align-items-center p-lg-5">
                <div class="col-lg-5">
                    <img src="{{  asset('vue/images/mob3.png')}}" class="img-fluid" alt="Hero Video">
                </div>
                <div class="col-lg-7">
                    <h1 class="third">INVEST</h1>
                    <h6 class="animate__animated animate__fadeInRight third">Once you've
                        identified the right opportunity, you'll
                        initiate the KCY (Know Your Customer) process to verify your identity and complete the required
                        investor documents.</h6>
                </div>
            </div>
        </div>
    </section>
    <!-- 2nd Section Start -->
    <footer class="bg-dark-color">
        <div class="container">
            <div class="row pt-lg-4 pb-lg-2">
                <div class="col-lg-3">
                    <a href="#">
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
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
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
</body>

</html>
