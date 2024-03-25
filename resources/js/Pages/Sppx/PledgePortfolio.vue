<template>

<section class="p-lg-5 p-3 hero-bg">
    <div class="container">
        <div class="row py-10"> </div>
        <div class="row justify-content-between py-10 pb-20" >
            <div class="col-lg-12 py-5 text-right ">

            </div>
                <div>
                   

                  <div class="row">


                

                    <div class="col-lg-6 py-2" style="margin-bottom:20px">
                        <button class="btn btn-sm btn-info" v-if="isLoggedIn" @click="logout()"> Logout </button>
                    </div>
                    <div class="col-lg-12"   style="margin-bottom: 10px">
                      <div class="card bg-dark">
                         
                        <div class="card-body"> 
                          <div style="height: 70px"> 
                             <h2 class="text-white"> Pledge support for {{ pledgeResponse.pledge.id }} </h2>
                          </div>
                          <div class="row py-3">
                            <table class="table">
                                <tbody>
                                    <tr align="center">
                                        <td>Minimum Investment* </td>
                                        <td>Requested Investment</td> 
                                        <td>Maximum Investment</td>
                                        <td>Exemption</td>
                                        <td>Auto</td>
                                    </tr>
                                    <tr align="center">
                                        <td>$ {{ pledgeResponse.pledge.minimum }}</td>
                                        <td>$ {{ pledgeResponse.pledge.requested }}</td> 
                                        <td>{{ pledgeResponse.pledge.maximum }}</td>
                                        <td> {{ pledgeResponse.pledge.rule }}</td>
                                        <td> {{ pledgeResponse.pledge.auto  }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            
                            
                
                             
                             
                             <button type="button" class="btn btn-sm btn-info">  Pledge Now  </button>
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
        formData: {
            pledge: '',
            affirm: {
                ustaxpayer: '',
                education: '', 
                risk: '', 
                cancel: '', 
                resale: '', 
            },
            uuid: this.uuid
       },
        listing:'',
        isLoggedIn: false,
        spinner:true,
        completeProfileButton: false,
        investNowButton:false,
        investSpinner:true
    };
  },

  props: {
    uuid: String,
    pledgeResponse: String, 
    submitPledge:String, 
  },

  
  mounted(){

    /// console.log(this.pledgeResponse)
  },
  methods: {
    
    
    logout(){
         axios.get(this.logOut)
        .then(response => {
            if (response.data.status === true) {
                this.isLoggedIn = false;
            }
        })
        .catch(error => {  console.log(error); });
    },
    

   
 

  }

};
</script>
