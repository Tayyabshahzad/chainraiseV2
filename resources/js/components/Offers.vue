
<template>
    <section class="bg-dark-color p-lg-5 p-3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">

                            <div v-for="(offer, index) in offers" :key="index" class="carousel-item active">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card border-style">
                                            <div class="position-absolute bg-orange p-1 px-lg-4 rotate-div">
                                                <p class="trend text-white text-lg-end mb-0"><img src="images/flame.svg"
                                                        class="img-fluid me-2">Activ Trending
                                                </p>
                                            </div>
                                            <img src="images/Screen.png" class="card-img-top" alt="Image 1">
                                            <div class="card-body bg-dark">
                                                <div class="d-flex justify-content-end">
                                                    <img src="images/shield.svg.svg" class="img-fluid shield">
                                                </div>
                                                <h5 class="card-title text-white"> {{ offer.name }} </h5>
                                                <p class="card-text text-white"> {{ offer.description }}.</p>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p class="text-white mb-0 pb-0">Offer Type</p>
                                                        <b class="text-white">{{ offer.offer_type }}</b>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p class="text-white mb-0 pb-0">Securities Type</p>
                                                        <b class="text-white">{{ offer.security_type }}</b>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p class="text-white mb-0 pb-0">Valuation</p>
                                                        <b class="text-white">{{ offer.total_valuation	 }}</b>
                                                    </div>
                                                </div>
                                                <span class="badge  my-3"> <img src="images/clock.png"> Limited Stock
                                                    Available for 30
                                                    days.</span>
                                                <div class="d-grid gap-2 col-12 mx-auto">
                                                    <button class="btn color_btn" type="button">Invest Now</button>
                                                    <button class="btn transparent_btn" type="button">Learn
                                                        More</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
</template>

  <script>


  export default {
    props: {
        offers: {
            type: Array,
            required: true
        }
    }
  };
  </script>

  <style>
  /* Add your global styles here */
  .min-wrapper {
    padding:0 100px;
  }

  </style>
