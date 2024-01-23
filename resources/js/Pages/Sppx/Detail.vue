<template>

<section class="p-lg-5 p-3 hero-bg">
    <div class="container">
        <div class="row py-10"> </div>
        <div class="row justify-content-between py-10 pb-20" >
            <div class="col-lg-12 py-5 text-right ">

            </div>
                <div>
                  <h1>Detail</h1>
                  <div class="row">
                    <div class="col-lg-12"   style="margin-bottom: 10px">
                      <div class="card bg-dark">
                        <img  v-if="offer.issue.media.thumb.url" :src="offer.issue.media.thumb.url" class="card-img-top" alt="Image 1" style="height: 17em;">
                        <div class="card-body">
                          <h5 class="card-title text-white">{{ offer.issue.raise.terms }}</h5>
                          <div style="height: 70px">
                             
                          </div>
                          <div class="row py-3">
                            <div class="col-lg-4 border-end" style="border-color: #959595 !important;">
                              <p class="text-white mb-0 pb-0">Type</p>
                              <b class="text-white">{{ offer.issue.raise.type   }}</b>
                            </div>
                            <div class="col-lg-4 border-end" style="border-color: #959595 !important;">
                              <p class="text-white mb-0 pb-0">Rule</p>
                              <b class="text-white">{{ offer.issue.raise.raised || 'No Name' }}</b>
                            </div>
                            <div class="col-lg-4">
                              <p class="text-white mb-0 pb-0">Min Investment</p>
                              <b class="text-white">{{ offer.issue.raise.minimum || 'No Name' }}</b>
                            </div>
                        </div>
                        <div class="row py-3">

                            <div class="col-lg-4 border-end">
                                <p class="text-white mb-0 pb-0">Min maximum</p>
                                <b class="text-white">{{ offer.issue.raise.maximum || 'No Name' }}</b>
                              </div>


                              <div class="col-lg-4 border-end">
                                <p class="text-white mb-0 pb-0">target</p>
                                <b class="text-white">{{ offer.issue.raise.target || 'No Name' }}</b>
                              </div>


                              <div class="col-lg-4">
                                <p class="text-white mb-0 pb-0">raised</p>
                                <b class="text-white">{{ offer.issue.raise.raised || 'No Name' }}</b>
                              </div>
                        </div>
                        <div class="row py-3"> 
                              <div class="col-lg-4 border-end">
                                <p class="text-white mb-0 pb-0">interest</p>
                                <b class="text-white">{{ offer.issue.raise.interest || 'No Name' }}</b>
                              </div>

                              <div class="col-lg-4 border-end">
                                <p class="text-white mb-0 pb-0">lotsize</p>
                                <b class="text-white">{{ offer.issue.raise.lotsize || 'No Name' }}</b>
                              </div>

                              <div class="col-lg-4 ">
                                <p class="text-white mb-0 pb-0">lotsize</p>
                                <b class="text-white">{{ offer.issue.raise.request || 'No Name' }}</b>
                              </div>

                          </div>
                          <span class="text-wrap col-12 my-3 mx-auto py-2 px-3" style="text-align: left !important;"></span>
                          <div class="d-grid gap-2 col-12 mx-auto">
                            <a :href="route('invest-now')" class="btn transparent_btn"><b>Invest</b></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

        </div>

    </div>
</section>
</template>

<script>
import axios from 'axios'; // Import axios
import { usePage } from '@inertiajs/inertia-vue3';
export default {
 data() {
    return {   
        listing:''
    };
  },
  props: {
    offer: Object,
  },
  mounted(){
 
  },
  methods: {

  }

};
</script>
