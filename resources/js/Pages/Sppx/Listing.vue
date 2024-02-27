<template>

<section class="p-lg-5 p-3 hero-bg">
    <div class="container">
        <div class="row py-10"> </div>
        <div class="row justify-content-between py-10 pb-20" >
            <div class="col-lg-12 py-5 text-right ">
                <a :href="profileUrl" class="text-white">My Profile</a>
            </div>
                <div>
                  <h1>Listings</h1>
                  <div class="row">
                    <div class="col-lg-4" v-for="listing in listings" :key="listing.id" style="margin-bottom: 10px">
                      <div class="card bg-dark">
                        <img :src="listing.media.thumb.url" class="card-img-top" alt="Image 1" style="height: 17em;">
                        <div class="card-body">
                          <h5 class="card-title text-white">{{ listing.name || 'No Name' }}</h5>
                          <div style="height: 70px">
                            <p class="card-text text-white h-50">{{ listing.raise.terms || 'No Name' }}</p>
                          </div>
                          <div class="row">
                            <div class="col-lg-4 border-end" style="border-color: #959595 !important;">
                              <p class="text-white mb-0 pb-0">Type</p>
                              <b class="text-white">{{ listing.raise.type || 'No Name' }}</b>
                            </div>
                            <div class="col-lg-4 border-end" style="border-color: #959595 !important;">
                              <p class="text-white mb-0 pb-0">Target Raised</p>
                              <b class="text-white">{{ listing.raise.raised || 'No Name' }}</b>
                            </div>
                            <div class="col-lg-4">
                              <p class="text-white mb-0 pb-0">Min Investment</p>
                              <b class="text-white">{{ listing.raise.minimum || 'No Name' }}</b>
                            </div>
                          </div>
                          <span class="text-wrap col-12 my-3 mx-auto py-2 px-3" style="text-align: left !important;"></span>
                          <div class="d-grid gap-2 col-12 mx-auto">

                            <a :href="'details/'+listing.uuid"   class="btn transparent_btn"><b>Learn More</b></a>
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
      listings: [],
    };
  },
  props: {
    accessToken: String,
    profileUrl: String,
  },
  computed: {
  },

  mounted(){
    console.log('listings:', this.accessToken);
    this.fetchListings(this.accessToken)
  },
  methods: {
    async fetchListings(accessToken) {
        try {
            const response = await axios.get('https://crdev.sppx.io/api/v0/public');
            // Log the fetched data to the console
            this.listings = response.data.issues;
            this.offerDetail = response.data.issues.uuid;

        } catch (error) {
            console.error('Error:', error);
        }
    },
},
};
</script>
