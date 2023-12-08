
<template>
     <div class="min-wrapper">
            <Navbar></Navbar>
            <Banner></Banner>
    <!-- Header End -->

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
                    <img src="images/Group 877.png" class="img-fluid mt-5" alt="Hero Video">
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
    <!-- offerlisting -->

    <offers :offers="initialOffers"></offers>
     <!-- End offerlisting -->

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
                    <img src="images/mob.png" class="img-fluid" alt="Hero Video">
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
                    <img src="images/mob-2.png" class="img-fluid" alt="Hero Video">
                </div>

            </div>
            <div class="row align-items-center p-lg-5">
                <div class="col-lg-5">
                    <img src="images/mob3.png" class="img-fluid" alt="Hero Video">
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
                        <img src="images/logo.png" alt="Logo" width="250px" height="50px">
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
                    <img src="images/social.png" alt="Logo">
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <hr>
            <p class="text-white py-lg-4 text-lg-center my-0">© Copyright 2023 - investchainraise</p>
        </div>
    </footer>
</div>


</template>

  <script>
  import Navbar from './Navbar.vue';
  import Banner from './Banner.vue';
  import Offers from './Offers.vue';

  export default {


    components: {
        Navbar,
        Banner,
        Offers
    },
    props: [],
  data() {
    return {
      initialOffers: this.$root.initialOffers,
    };
  },

  };
  </script>

  <style>
  /* Add your global styles here */
  .min-wrapper {
    padding:0 100px;
  }

  </style>
