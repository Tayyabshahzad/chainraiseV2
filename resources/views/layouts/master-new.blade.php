<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chainrasie | @yield('page_title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <style>
            .footer_social {
              list-style: none;
              padding: 0;
              margin: 0;
            }

            .footer_social li {
              display: inline-block;
              margin-right: 10px;
              color: white !important;
            }

            .footer_social a {
              text-decoration: none;
            }

            .footer_social i {
              font-size: 24px;
              color: #ffffff;
            }

            .bg-image-tree {
                background-image: url("{{ asset('vue/images/hero-bg.png') }}");
            }

            .section-bg {
                background-image: url("{{ asset('vue/images/section-bg.png') }}");
            }
          </style>
    @section('page_style')
    @show
</head>

<body>
    <!-- Header Start -->

    <!-- Header End -->
    <!-- Hero Section Start -->
    @section('page_content')
    @show
    <!-- 2nd Section Start -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    @section('page_js')
    @show
</body>

</html>
