<!-- resources/js/components/Header.vue -->

<template>

    <nav class="navbar navbar-expand-lg bg-dark-color" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="images/logo.png" alt="Logo" width="250px" height="50px">
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


  </template>

  <script>

  export default {
    data(){
        return{
            logoImage:"https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.pngss"
        }
    }
  };
  </script>

  <style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');
  @import url('https://fonts.googleapis.com/css2?family=Open%20Sans:wght@300;400;500;600;700&display=swap');


  *,
  *:after,
  *:before {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      margin: 0;
      padding: 0;
  }

  ul,
  ol {
      margin: 0;
      padding: 0;
  }

  :active,
  :hover,
  :focus {
      outline: 0 !important;
      outline-offset: 0;
  }

  ul {
      list-style: none;
  }

  html {
      scroll-behavior: smooth;
  }

  body {
      font-family: var(--primary-font);
      font-size: 100%;
      font-weight: 400;
  }

  /*===== Variable Define =====*/
  :root {
      --primary-color: #000000;
      --secondry-color: #ff9a02;
      --third-color: #f98169;
      --white-color: #fff;
      --text-color: #555;
      --text-gray: #999;
      --black-color: #000;
      --primary-font: 'Montserrat', sans-serif;
      --secondry-font: 'Open Sans', sans-serif;
      --button-color: #191919;
  }

  .bg-orange {
      background-color: #E86C12;
  }

  .rotate-div {
      transform: rotate(-310deg);

      right: -10% !important;
      width: 200px;
      border-top-right-radius: 100px;

  }

  .trend {
      font-size: 12.69px;
      font-weight: 600;
  }

  h3 {
      font-family: var(--primary-font);
      font-size: 76px !important;
      color: #DAF9FF !important;
      line-height: 100px !important;
      font-weight: 400 !important;

  }

  .shield {
      margin-top: -50px;

  }


  h1 {
      font-family: var(--primary-font);
      font-size: 106px !important;
      background: -webkit-linear-gradient(#8A77FF, #A5F0FF) !important;
      -webkit-background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      font-weight: 700 !important;
  }

  h1.second {
      font-size: 50px !important;
  }

  h1.third {
      font-size: 50px !important;
  }

  h6.third {
      font-size: 24px !important;
  }

  h6 {
      color: #DCDCDC !important;
      font-size: 32px !important;
      font-weight: 400 !important;
  }

  .color_btn {
      background-color: #294FF6 !important;
      color: white !important;
      border-radius: 27px !important;
  }

  .transparent_btn {
      background-color: rgba(255, 255, 255, 0%) !important;
      color: white !important;
      border-radius: 27px !important;
      border: 1px solid white !important;
  }

  .nav-link {
      color: white !important;
      font-family: var(--secondry-font);
  }

  .navbar-nav .nav-link.active,
  .navbar-nav .nav-link.show {
      font-weight: 700 !important;
      font-family: var(--secondry-font);
  }

  .bg-color-dark {
      background: linear-gradient(to right, #4e54c8, #8f94fb);
  }

  .border-style {
      border: 0px !important;
      border-radius: 70px 70px 0px 0px !important;
      /* box-shadow: 0 4px 8px 0 #A5F0FF, 0 6px 20px 0 #8E86FF !important; */
  }

  .badge {
      color: #FF9696 !important;
      background-color: #343434 !important;
      border-radius: 50px !important;
  }

  .carousel-control-prev-icon {
      background-image: url(../images/prev-icon.png) !important;
      width: 10rem !important;
      height: 10rem !important;
  }

  .carousel-control-prev {
      left: -140px !important;
  }

  .carousel-control-next-icon {
      background-image: url(../images/next-icon.png) !important;
      width: 4rem !important;
      height: 2.8rem !important;
  }

  .carousel-control-next {
      right: -140px !important;
  }


  .hero-bg {
      background-image: url(../images/hero-bg.png);
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
  }

  .section-bg {
      background-image: url(../images/section-bg.png);
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
  }

  .verticle-line-bar {
      position: absolute !important;
      height: 10px !important;
      width: 120px !important;
      margin: 1rem 0px !important;
      background: linear-gradient(to right, #4B20FB, #20CDED);
      transform: rotate(90deg);
      transform-origin: 0% 0%;
      top: -10px !important;
      left: -10px;
  }

  hr {

      height: 2px !important;
      background-color: white !important;
      margin: 0px !important;

  }

  .bg-dark-color {
      background-color: #1C1C1C;
  }

  ul.dropdown-menu.show {
      background-image: url('../images/menu-bg.png');
      border: 0;
  }

  .bg-image-modal {
      background-image: url('../images/menu-bg.png');
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
  }

  @media only screen and (max-width: 768px) {

      h3 {
          font-size: 35px !important;
          line-height: 50px !important;
      }

      h1 {
          font-size: 50px !important;
      }

      h6 {
          font-size: 20px !important;
      }

      h1.second {
          font-size: 30px !important;
      }

      h6.second {
          font-size: 20px !important;
      }

      h1.third {
          font-size: 30px !important;
      }

      h6.third {
          font-size: 20px !important;
      }

  }
  </style>
