<template>
    <section class="p-lg-5 p-3 hero-bg">
        <div class="container">
            <div id="carouselExample" class="" data-bs-ride="carousel">
                <div class="">
                    <div class=" ">
                        <div class="row">
                            <div class="col-lg-12 py-5 text-right text-white">
                                <h2 >Funding</h2>
                                <hr/>
                                <br/>
                                <h4 >
                                    Please select from the options below to fund your $10250.00 pledge in Block Heads Coffee Shop.
                                </h4>
                                <h6>
                                    Lookup Bank by Routing Number
                                </h6>

                                <p>
                                    Enter your bank ABA routing number and click Lookup.
                                </p>

                                <p>
                                 <img src="https://crdev.sppx.io/media/sppx_ach_check.png" alt="">
                                </p>

                                <p>
                                    ABA Routing number *
                                </p>

                                <div class="container text-center">
                                    <div class="row align-center">
                                      <div class="col">
                                        <label for="routing"> Routing </label>
                                        <input type="text" class="form-control" id="routing" v-model="formData.routing" required>
                                      </div>
                                      <div class="col">
                                        <label for="account"> Account</label>
                                        <input type="text" class="form-control" id="account" v-model="formData.account" required>
                                      </div>
                                      <div class="col">
                                        <label for="type">Type</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                              <input class="form-check-input mt-0" name="type"  type="radio"  v-model="formData.type"  value="checking"  >
                                            </div>
                                            <input type="text" class="form-control" value="Checking"  >
                                          </div>

                                      </div>
                                      <div class="col">
                                        <label for="type">Type</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                              <input class="form-check-input mt-0"  name="type" type="radio"  v-model="formData.type"  value="saving"  >
                                            </div>
                                            <input type="text" class="form-control" value="Saving"  >
                                          </div>
                                      </div>

                                      <div class="col">
                                        <label for="owner"> Owner</label>
                                        <input type="text" class="form-control" id="owner" v-model="formData.owner" required>
                                      </div>

                                      <div class="col">
                                        <label for="nickname"> Nickname</label>
                                        <input type="text" class="form-control" id="nickname" v-model="formData.nickname" required>
                                      </div>

                                    </div>

                                    <div class="row align-center">

                                        <div class="col mt-4">
                                            <button class="btn btn-sm btn-info" @click="submitLookUp">   Lookup </button>
                                        </div>
                                    </div>
                                  </div>



                                <p>

                                </p>




                            </div>

                            <div class="col-lg-12 ">

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
                    formData: {
                        routing: '',
                        account: '',
                        type: '',
                        owner: '',
                        nickname: '',
                        pledge_txn: this.pledge_txn,
                        offer_uuid: this.offer_uuid,
                    },

                };
            },
            props:{
                offer_uuid : String,
                pledge_txn : String
            },
            methods: {
                submitLookUp() {
                    axios.post(route('api.ach.add'), {
                        formData: this.formData
                    }).then(response => {
                        if (response.data.status === true) {
                            alert(response.data.message);
                            window.location.href= route('api.ach.fund',response.data.pledge_txn)
                        } else {
                            alert(response.data.message);
                        }
                        console.error(response.data);
                    }).catch(error => {
                        console.error(error);
                    });
                }
            },

            created(){
                console.log(this.pledge_txn);
                console.log(this.offer_uuid);

            },

        }

    </script>
