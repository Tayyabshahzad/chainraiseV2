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
                    <div class="col-lg-6 py-2" style="margin-bottom:20px">
                        <button class="btn btn-sm btn-info" v-if="isLoggedIn" @click="logout()"> Logout </button>

                    </div>





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
                             <!-- <a v-if="isLoggedIn"  :href="route('api.investor.certification')"   class="btn transparent_btn" ><b>Invest Now</b></a> -->

                             <a v-if="isLoggedIn" :href="route('api.investor.certification',offer.issue.uuid)" class="btn transparent_btn"><b>Invest Now</b></a>
                             <button v-if="!isLoggedIn && !spinner"  class="btn transparent_btn" data-bs-toggle="modal" data-bs-target="#loginModal"> <b>Login to Invest</b> </button>
                             <div class="text-center" v-if="spinner">
                                <img src="https://i.stack.imgur.com/qq8AE.gif" width="20"/>
                             </div>

                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>

        </div>
    </div>

  <!-- Modal -->
  <div class="modal fade" v-if="!isLoggedIn" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Login</h5>
          <button type="button" id="closeModal"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form >
                <div class="form-group">
                  <lable> Username </lable>
                  <input type="text" name="username" id="username" class="form-control"/>
                </div>
                <div class="form-group">
                  <lable> Password </lable>
                  <input type="password" name="password" id="password" class="form-control"/>
                </div>
                <div class="form-group text-center">
                        <span class="text-danger" id="error_message"></span>
                </div>
            </form>

        </div>
        <div class="modal-footer">
          <button type="button" @click="loginUser" class="btn btn-sm btn-info">Login</button>
          <button type="button" data-bs-toggle="modal" data-bs-target="#registerModal" class="btn btn-sm btn-info">Register</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade"  id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Register</h5>
          <button type="button" id="closeModal"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form >
                <div class="form-group">
                  <lable> Username </lable>
                  <input type="text" name="reg_username" id="reg_username" class="form-control" required/>
                </div>

                <div class="form-group">
                    <lable> Email </lable>
                    <input type="email" name="reg_email" id="reg_email" class="form-control" required/>
                  </div>

                <div class="form-group">
                  <lable> Password </lable>
                  <input type="password" name="reg_password" id="reg_password" class="form-control" required/>
                </div>
                <div class="form-group text-center">
                        <span class="text-danger" id="reg_error_message"></span>
                </div>
            </form>

        </div>
        <div class="modal-footer">
          <button type="button" @click="registerUser" class="btn btn-sm btn-info">Register</button>

        </div>
      </div>
    </div>
  </div>

  <div class="modal fade"  id="investDecision" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" id="closeModal"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">

            <div class="text-center" v-if="investSpinner">
                <img src="https://i.stack.imgur.com/qq8AE.gif" width="20"/>
             </div>

            <a :href="this.accreditation+'/'+offer.issue.uuid" class="btn btn-sm btn-warning" v-if="accreditationProcess" > Complete Your Accreditation Process </a> <br/><br/>
            <a :href="this.pledge+'/'+offer.issue.uuid"  class="btn btn-sm btn-success" type="button" v-if="investNowButton" > Pledge Now </a>
            <a :href="this.profile" class="btn btn-sm btn-info" v-if="updateProfile" > Update Your Profile </a> <br/><br/>
            <p id="investMessage" class="text-center text-danger"> </p>


        </div>
      </div>
    </div>
  </div>



</section>
</template>

<script>
import axios from 'axios'; // Import axios
import { usePage } from '@inertiajs/inertia-vue3';
import $ from 'jquery';



export default {
 data() {
    return {
        listing:'',
        isLoggedIn: false,
        spinner:true,
        completeProfileButton: false,
        investNowButton:false,
        investSpinner:true,
        updateProfile:false,
        accreditationProcess:false
    };
  },
  props: {
    offer: Object,
    investUrl: String,
    pledge: String,
    certifyUrl: String,
    loginRoute: String,
    checkAuthRoute:String,
    logOut:String,
    accreditation:String,
    registerUserRoute:String,
    profile:String
  },
  mounted(){

    this.checkLoggedIn();
  },
  methods: {
    checkLoggedIn() {
        axios.get(this.checkAuthRoute)
        .then(response => {
            console.log(response)
            this.spinner = false;
            if (response.data.status === true) {
                this.isLoggedIn = true;
            } else {
                this.isLoggedIn = false;
            }
        })
        .catch(error => {
            this.spinner = false;

        });
    },
    loginUser() {
      const username = document.getElementById('username').value;
      const password = document.getElementById('password').value;
      axios.post(this.loginRoute, {
        username: username,
        password: password
      })
      .then(response => {
        console.error("ok");
        if(response.data.status == false){
            document.getElementById('error_message').textContent = response.data.message;
        }else{
            this.isLoggedIn = true;
            $('#closeModal').click();
        }
      })
      .catch(error => {
        console.error("error");
        console.error(error);
      });
    },
    logout(){
         axios.get(this.logOut)
        .then(response => {
            if (response.data.status === true) {
                this.isLoggedIn = false;
            }
        })
        .catch(error => {  console.log(error); });
    },

    investNow(uuid){
        axios.post(this.investUrl,{
            data:uuid
        })
        .then(response => {
            this.investSpinner = false
            if(response.data.status == true){
                this.investNowButton = true;
                this.completeProfileButton  = false;
                document.getElementById('investMessage').textContent = response.data.message;
            }else if(response.data.status == false){

                if(response.data.initials == false){
                    this.investNowButton = false;
                    this.completeProfileButton  = false;
                    this.updateProfile  = true;

                }else if(response.data.accreditation ==  false){
                    this.accreditationProcess  = true;
                    this.updateProfile  = false;
                }else{
                    this.investNowButton = false;
                    this.completeProfileButton  = true;
                }

                document.getElementById('investMessage').textContent = response.data.message;
            }

        })
        .catch(error => {
            console.error("error");
            console.error(error);
        });
    },

    certifyNow(uuid){

       axios.post(this.certifyUrl,{
            data:uuid
        })
        .then(response => {
             console.log(response)

        })
        .catch(error => {
            console.error("error");
            console.error(error);
        });
    },


    registerUser() {
      const reg_username = document.getElementById('reg_username').value;
      const reg_email = document.getElementById('reg_email').value;
      const reg_password = document.getElementById('reg_password').value;

      axios.post(this.registerUserRoute, {
        reg_username: reg_username,
        reg_email: reg_email,
        reg_password: reg_password
      })
      .then(response => {
        document.getElementById('reg_error_message').textContent = response.data.message;
      })
      .catch(error => {
        document.getElementById('reg_error_message').textContent = response.data.message;

      });
    },

    computed: {

  },

  }

};
</script>
