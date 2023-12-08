
<template>
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
                        <button class="btn color_btn px-lg-5" type="button"><img src="images/Group.png"> Explore
                            Tech</button>
                        <button class="btn transparent_btn px-lg-4 ms-lg-3" type="button"><img src="images/Group.png">
                            Explore
                            Real
                            Estate</button>
                    </div>
                </div>
                <div class="col-lg-6 text-lg-end py-lg-0 py-4">
                    <img src="images/hero-video.png" class="img-fluid" alt="Hero Video">
                </div>
            </div>

        </div>
    </section>
    <!-- Hero Section End -->

</template>

  <script>
  import Navbar from './Navbar.vue';
  import Banner from './Banner.vue';

  export default {
    components: {
        Navbar
    },
  };
  </script>

  <style>
  /* Add your global styles here */
  .min-wrapper {
    padding:0 100px;
  }

  </style>
