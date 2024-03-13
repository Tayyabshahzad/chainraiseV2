<template>

<section class="p-lg-5 p-3 hero-bg">
    <div class="container">
        <div class="row py-10"> </div>
        <div class="row justify-content-between py-10 pb-20" >
            <div class="col-lg-12 py-5 text-right ">

            </div>
                <div>
                  <h1>Pledge Offer</h1>
                  <div class="row">
                    <div class="col-lg-6 py-2" style="margin-bottom:20px">
                        <button class="btn btn-sm btn-info" v-if="isLoggedIn" @click="logout()"> Logout </button>

                    </div>





                    <div class="col-lg-12"   style="margin-bottom: 10px">
                      <div class="card bg-dark">
                        Pledge support for Block Heads Coffee Shop (CR-BLOCKCOFFEE)
                        <div class="card-body"> 
                          <div style="height: 70px"> 
                          </div>
                          <div class="row py-3">
                            <table class="table">
                                <tbody>
                                    <tr align="center">
                                        <td>Minimum Investment* </td>
                                        <td>Requested Investment</td>
                                        <td>Additional Increments</td>
                                        <td>Maximum Investment</td>
                                        <td>Exemption</td>
                                    </tr>
                                    <tr align="center">
                                        <td>$100.00</td>
                                        <td>$250.00</td>
                                        <td>$2.50</td>
                                        <td>UNLIMITED</td>
                                        <td>REG-CF</td>
                                    </tr>
                                </tbody>
                            </table>
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
import $ from 'jquery';

export default {
 data() {
    return {
        listing:'',
        isLoggedIn: false,
        spinner:true,
        completeProfileButton: false,
        investNowButton:false,
        investSpinner:true
    };
  },
  props: {
    offer: Object,
    investUrl: String,
    certifyUrl: String,
    loginRoute: String,
    checkAuthRoute:String,
    logOut:String,
    accreditation:String,
    registerUserRoute:String
  },
  mounted(){

    this.checkLoggedIn();
  },
  methods: {
    checkLoggedIn() {
        console.log("checkLoggedIn")
        axios.get(this.checkAuthRoute)
        .then(response => {
            this.spinner = false;
            if (response.data.status === true) {
                this.isLoggedIn = true;
            } else {
                this.isLoggedIn = false;
            }
        })
        .catch(error => {
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
                this.investNowButton = false;
                this.completeProfileButton  = true;
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

  }

};
</script>
