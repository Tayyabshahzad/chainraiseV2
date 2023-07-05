<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invest in Startups, Real Estate, More Online | ChainRaise</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style-v3.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
            
        .hero-section {
            background: linear-gradient(rgb(137 126 126 / 50%), rgb(0 0 0)), url('{{ asset('assets/v3-images/detail-bg.png') }}');
        }
    </style>    
</head> 
<body> 
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/v3-images/chainrasied-logo.png') }}" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            LEARN
                        </a>
                        <ul class="dropdown-menu p-3">
                            <li><a href="https://chainraise.io/investors/" target="_blank" rel="noopener noreferrer"
                                    class="text-dark"><span class="menu-text mb-3"><img src="{{ asset('assets/v3-images/inestorsicon.png') }}">
                                        <div class="pe-lg-3"><b>Investors</b><br><span
                                                style="font-weight: 400;font-size: 12px;">Information
                                                for
                                                Investors including FAQs</span>
                                        </div>
                                    </span>
                                </a>
                            </li>
                            <li><a href="https://chainraise.io/investors/" target="_blank" rel="noopener noreferrer"
                                    class="text-dark"><span class="menu-text mb-3"><img src="{{ asset('assets/v3-images/faqsicon2.png') }}">
                                        <div class="pe-lg-3"><b>Businesses</b><br><span
                                                style="font-weight: 400;font-size: 12px;">Information for
                                                Information for businesses including FAQs</span></div>
                                    </span></a></li>
                            <li><a href="https://chainraise.io/investors/" target="_blank" rel="noopener noreferrer"
                                    class="text-dark"><span class="menu-text mb-3"><img
                                            src="{{ asset('assets/v3-images/blockchainicon2.png') }}">
                                        <div class="pe-lg-3"><b>Blockchain</b><br><span
                                                style="font-weight: 400;font-size: 12px;">Information for
                                                Welcome to a new era of financial innovation</span></div>
                                    </span></a></li>
                        </ul>
                    </li>
                    <a class="nav-link me-3 fw-semibold" href="#">RAISE CAPITAL</a>
                </ul>
                <ul class="navbar-nav  mb-2 mb-lg-0 align-items-lg-center">
                    <button type="button" class="btn text-white me-3 px-4 rounded-pill"
                        style="background-color:#43C3FE;">INVEST</button>
                    @if (!Auth::user()) 
                        <a href="#" class="nav-link me-3 fw-semibold" data-bs-toggle="modal"
                        data-bs-target="#sign-in-popup">Login</a>

                        <a href="#" class="nav-link me-3 fw-semibold" data-bs-toggle="modal"
                        data-bs-target="#sign-up-popup">Sign Up
                        </a>
                    @endif
                   
                    <div class="avator-logo me-3 d-lg-block d-none ">
                        @if (Auth::user())
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('assets/v3-images/avatar-user.png') }}" width="45" height="45" class="rounded-circle"
                                        alt="avatar-img">
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class=" bi bi-person dropdown-item text-dark" href="investment.html">
                                            Portfolio</a>
                                    </li>
                                    <li><a class=" dropdown-item bi bi-files text-dark" href="#"> My Documents</a></li>
                                    <li><a class=" bi bi-person dropdown-item text-dark" href="account.html"> My
                                            Account</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class=" bi bi-power dropdown-item text-dark" href="#"> logout</a></li>
                                </ul>
                            </li>
                        </ul>
                        @endif
                    </div>
                    
                </ul>
            </div>
        </div>
    </nav>
    @section('content')
    @show 

    <div class="container-fluid">
        <div class="row py-4 px-lg-5 px-3" style="background-color: #DBDBDB;">
            <div class="col-12 text-center p-0">
                <img src="{{ asset('assets/v3-images/chainrasied-logo.png') }}" alt="" srcset="" class="img-fluid mb-3">
                <p class="fw-semibold">Copyright@ 2022 ChainRaise LLC | All rights reserved.</p>
                <div class="mb-3">
                    <!-- Linkedin -->
                    <i class="bi bi-linkedin me-4"></i>
                    <!-- Twitter -->
                    <i class="bi bi-instagram me-4"></i>
                    <!-- Instagram -->
                    <i class="bi bi-twitter me-4"></i>
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-2 col-4"><button type="button"
                                class="btn btn-link text-dark text-decoration-none fw-semibold px-0">Educational
                                Materials</button></div>
                        <div class="col-lg-2 col-4"><button type="button"
                                class="btn btn-link text-dark text-decoration-none fw-semibold px-0">Privacy
                                Policy</button>
                        </div>
                        <div class="col-lg-2 col-4"><button type="button"
                                class="btn btn-link text-dark text-decoration-none fw-semibold px-0">Terms
                                of Use</button></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row p-lg-5 mx-lg-5 p-2">
                <div class="col-12 text-dark fw-normal">
                    <p> This website, which we refer to as the “Site,” is used by two different companies: </p>
                    <p> ChainRaise Portal LLC and ChainRaise Fund LLC. </p>
                    <p> ChainRaise Fund LLC offers investments under Rule 506(c) issued by the
                        Securities and Exchange Commission (SEC). These investments are offered to accredited
                        investors
                        only.</p>
                    <p>ChainRaise Portal LLC is a “funding portal” as defined in section 3(a)(80) of the Securities
                        Exchange Act of 1934. Here, you can review investment opportunities of companies offering
                        securities
                        under section 4(a)(6) of the Securities Act of 1933, also known as Regulation Crowdfunding
                        or
                        Reg
                        CF. These investments are offered to everyone, not just to accredited investors.</p>

                    <p>By using this Site,
                        you are subject to our Terms of Use and our Privacy Policy. Please read these carefully
                        before
                        using
                        the Site.</p>
                    <p>Although our website offers investors the opportunity to invest in a variety of companies,
                        we do not make recommendations regarding the appropriateness of a particular investment
                        opportunity
                        for any particular investor. We are not investment advisers. Investors must make their own
                        investment decisions, either alone or with their personal advisors. </p>
                    <p>You should view all of the
                        investment opportunities on our website as risky. You should consider investing only if you
                        can
                        afford to lose your entire investment. </p>
                    <p> We provide financial projections for some of the investment
                        opportunities listed on the Site. All such financial projections are only estimates based on
                        current
                        conditions and current assumptions. The actual result of any investment is likely to be
                        different
                        than the original projection, often by a large amount. </p>
                    <p>Neither the Securities and Exchange
                        Commission nor any state agency has reviewed the investment opportunities listed on the
                        Site.
                    </p>
                    <p>Thankyou for using the Site. If you have questions, please contact us at info@chainraise.io
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

     <!-- Sign in Popop Start -->
     <div class="modal fade" id="sign-in-popup" tabindex="-1" aria-labelledby="sign-in-popupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content py-lg-3">
                <div class="modal-header m-auto pt-4 pb-0 border-0">
                    <img src="{{ asset('assets/v3-images/chainrasied-logo.png') }}" alt="Chain Rasied Logo" width="250" height="50" />
                </div>
                <div class="modal-body">
                    <h5 style="color: #000000; text-align: center; font-weight: 600;">Sign in to your account</h5>
                    <div class="container py-3 px-5 ">
                        <div class="row justify-content-center">
                            <div class="col-2 d-flex align-items-center justify-content-center">
                                <i class="bi bi-apple  border border-dark   py-2 px-3"></i>
                            </div>
                            <div class="col-2 d-flex align-items-center justify-content-center">
                                <i class="bi bi-google  border border-dark   py-2 px-3"></i>
                            </div>
                            <div class="col-2 d-flex align-items-center justify-content-center">
                                <i class="bi bi-facebook  border border-dark   py-2 px-3"></i>
                            </div> 
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-7 d-flex align-items-center justify-content-center py-2 ">
                                <p
                                    style="color: #000000; text-align: center; padding: 0px; margin:0px; font-weight: 600; font-size: 20px;">
                                    Or Continue
                                    with</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <form>
                                <div class="my-3">
                                    <input type="email" class="form-control rounded-pill border-dark" id="email1"
                                        placeholder="Your email address...">
                                </div>
                                <div class="my-3 ">
                                    <input type="password" class="form-control rounded-pill border-dark" id="password1"
                                        placeholder="Your password...">
                                </div>
                                <div class="row">
                                    <div class="col-5 d-flex align-items-center">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1"
                                                style="padding: 0px; font-size: 14px; font-weight: 500;">Remember
                                                me</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 col-12 mt-3 mb-2 mx-auto">
                                    <button class="btn btn-2 fw-semibold px-lg-5 px-3 me-2 rounded-pill"
                                        type="button">SIGN IN</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Sign in Popop End -->
    <div class="modal fade" id="sign-up-popup" tabindex="-1" aria-labelledby="sign-up-popupLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content py-lg-3">
                <div class="modal-header m-auto pt-4 pb-0 border-0">
                    <img src="{{ asset('assets/v3-images/chainrasied-logo.png') }}" alt="Chain Rasied Logo" width="250" height="50" />
                </div>
                <div class="modal-body">
                    <h5 style="color: #000000; text-align: center;">Sign up to your account</h5>
                    <div class="row gy-3 p-3 text-center">
                        <div class="col-12">
                            <button type="button"
                                class="btn btn-outline-dark pe-5 btn-custom position-relative fw-semibold"> <i
                                    class="bi bi-apple pe-5" style=" position: absolute;
                                left: 15px;"></i>
                                Sign up with
                                Apple
                            </button>
                        </div>
                        <div class="col-12">
                            <button type="button"
                                class="btn btn-outline-dark pe-5 btn-custom position-relative fw-semibold"> <i
                                    class="bi bi-google pe-5" style=" position: absolute;
                                left: 15px;"></i>
                                Sign up with
                                Google

                            </button>
                        </div>
                        <div class="col-12">
                            <button type="button"
                                class="btn btn-outline-dark pe-5 btn-custom position-relative fw-semibold"> <i
                                    class="bi bi-envelope-fill pe-5" style=" position: absolute;
                                left: 15px;"></i> Sign
                                up with
                                Email

                            </button>
                        </div>
                        <div class="col-12">
                            <button type="button"
                                class="btn btn-outline-dark pe-5 btn-custom position-relative fw-semibold"> <i
                                    class="bi bi-apple pe-5" style=" position: absolute;
                                left: 15px;"></i>
                                Sign up with

                            </button>
                        </div>
                        <div class="col-12 mt-4">
                            By signing up I agree to ChainRaise's <a href="#" style="color: #43C3FE;">Terms of Service
                            </a> and <a href="#" style="color: #43C3FE;">Privacy Policy
                            </a>.
                        </div>
                    </div>
                </div>
                <div class=" modal-footer flex-column text-center ">
                    <div class=" signup-section text-center">Already have an account? <a href="#"
                            data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#sign-in-popup"
                            style="color: #43C3FE;"> Sign in</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>