<!doctype html>
<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>  Chain Rasied Portal | @yield('title') </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/css/v2_style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('media/logo/favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    @section('custom_css')
    @show
</head>

<body>
    <!-- Header Start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('media/logo/logo.webp') }}" alt="Logo" width="190" height="38" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    @if (Auth::user())
                        <a class="nav-link me-3" href="/">Offering</a>
                        <a class="nav-link me-3" href="#">Portfolio</a>
                        <a class="nav-link me-3" href="#">My Account</a>
                        <a class="nav-link me-3" href="#">My Documents</a>
                        <a class="nav-link me-3" href="#">RAISE CAPITAL</a> 
                        <a class="nav-link me-3" href="{{ route('logout') }}"   onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                            SIGN OUT
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a> 
                    @else 
                        <a class="nav-link me-3" href="#" data-bs-toggle="modal" data-bs-target="#sign-in-popup">SIGN IN</a>
                        <a class="nav-link me-3" href="#" data-bs-toggle="modal" data-bs-target="#sign-up-popup">SIGN UP</a> 
                        <a class="custom-button me-3" href="#">INVEST</a>
                    @endif
                    <div class="d-flex justify-content-center align-items-center">
                        <!-- Facebook -->
                        <a style="color: #000000;" href="#!" role="button"><i
                                class="fab fa-facebook-f fa-lg pe-3"></i></a>

                        <!-- Twitter -->
                        <a style="color: #000000;" href="#!" role="button"><i class="fab fa-twitter fa-lg pe-3"></i></a>

                        <!-- Instagram -->
                        <a style="color: #000000;" href="#!" role="button"><i
                                class="fab fa-instagram fa-lg pe-3"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </nav>
    @section('content')
    @show
   
    <div class="container-fluid">
        <div class="row py-3 px-lg-5 px-3" style="background-color: #DBDBDB;">
            <div class="col-12 text-center p-0">
                <img src="images/logo.png" alt="" class="c-logo" srcset="">
                <p>Copyright@ 2022 ChainRaise LLC | All rights reserved.</p>
                <img src="images/social icon.png" class="py-2" alt="...">
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
        <div class="row mt-4 px-lg-5 px-3">
            <div class="col-12 text-dark fw-normal fs-5">
                <p> This website, which we refer to as the “Site,” is used by two different companies: </p>
                <p> ChainRaise Portal LLC and ChainRaise Fund LLC. </p>
                <p> ChainRaise Fund LLC offers investments under Rule 506(c) issued by the
                    Securities and Exchange Commission (SEC). These investments are offered to accredited investors
                    only.</p>
                <p>ChainRaise Portal LLC is a “funding portal” as defined in section 3(a)(80) of the Securities
                    Exchange Act of 1934. Here, you can review investment opportunities of companies offering
                    securities
                    under section 4(a)(6) of the Securities Act of 1933, also known as Regulation Crowdfunding or
                    Reg
                    CF. These investments are offered to everyone, not just to accredited investors.</p>

                <p>By using this Site,
                    you are subject to our Terms of Use and our Privacy Policy. Please read these carefully before
                    using
                    the Site.</p>
                <p>Although our website offers investors the opportunity to invest in a variety of companies,
                    we do not make recommendations regarding the appropriateness of a particular investment
                    opportunity
                    for any particular investor. We are not investment advisers. Investors must make their own
                    investment decisions, either alone or with their personal advisors. </p>
                <p>You should view all of the
                    investment opportunities on our website as risky. You should consider investing only if you can
                    afford to lose your entire investment. </p>
                <p> We provide financial projections for some of the investment
                    opportunities listed on the Site. All such financial projections are only estimates based on
                    current
                    conditions and current assumptions. The actual result of any investment is likely to be
                    different
                    than the original projection, often by a large amount. </p>
                <p>Neither the Securities and Exchange
                    Commission nor any state agency has reviewed the investment opportunities listed on the Site.
                </p>
                <p>Thankyou for using the Site. If you have questions, please contact us at info@chainraise.io
                </p>
            </div>
        </div>
    </div>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>