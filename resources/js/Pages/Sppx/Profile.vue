<template>

 
<section class="p-lg-5 p-3 hero-bg">
    <div class="container"> 
        <div id="carouselExample" class="" data-bs-ride="carousel">
            <div class="">
                <div class=" ">
                    <div class="row">
                        <div class="col-lg-12 py-5 text-right">
                            <a href="">My Profile</a>
                        </div>
                    </div>
                    <form @submit.prevent="submitForm">
                        <div class="row text-white">
                            <div class="col-lg-12">
                                <div class="col-lg-12 text-center"> <h6> Personal Info</h6></div>
                                <div class="form-group py-2">
                                        <label>First Name</label>
                                        <input type="text" name="first"   v-model="formData.user.name.first"  class="form-control"/>
                                </div>

                                <div class="form-group py-2">
                                    <label>Middle Name</label>
                                    <input type="text" name="middle" v-model="formData.user.name.middle" class="form-control"/>
                                </div>

                                <div class="form-group py-2">
                                    <label>Last Name</label>
                                    <input type="text" name="last" v-model="formData.user.name.last" class="form-control"/>
                                </div>

                                <div class="form-group py-2">
                                    <label>Initials</label>
                                    <input type="text" name="initials" v-model="formData.user.name.initials"  class="form-control"/>
                                </div> 

                                <div class="form-group py-2">
                                    <label>Email</label>
                                    <input type="text" name="email" v-model="formData.user.email"  class="form-control"/>
                                </div> 


                                <div class="form-group py-2">
                                    <label>Password</label>
                                    <input type="text" name="password" v-model="formData.user.email"  class="form-control"/>
                                </div> 
                            </div>


                            <div class="col-lg-12">
                                <div class="col-lg-12 text-center"> <h6> Address</h6> </div>
                                
                                <div class="form-group py-2">
                                        <label>Name</label> 
                                        <input type="text" name="name" v-model="formData.user.address.name"  class="form-control"/>
                                </div>

                                <div class="form-group py-2">
                                    <label>Street</label>
                                    <input type="text" name="street" v-model="formData.user.address.street" class="form-control"/>
                                </div>

                                <div class="form-group py-2">
                                    <label>Unit</label>
                                    <input type="text" name="unit" v-model="formData.user.address.unit" class="form-control"/>
                                </div>

                                <div class="form-group py-2">
                                    <label>City</label>
                                    <input type="text" name="city" v-model="formData.user.address.city"  class="form-control"/>
                                </div> 

                                <div class="form-group py-2">
                                    <label>State</label>
                                    <input type="text" name="state" v-model="formData.user.address.state"  class="form-control"/>
                                </div> 


                                <div class="form-group py-2">
                                    <label>Zipcode</label>
                                    <input type="text" name="state" v-model="formData.user.address.zipcode"  class="form-control"/>
                                </div> 

                                <div class="form-group py-2">
                                    <label>Country</label>
                                    <input type="text" name="state" v-model="formData.user.address.country"  class="form-control"/>
                                </div> 
 
                            </div>


                            <div class="col-lg-12">
                                <div class="col-lg-12 text-center"> <h6> Phone Info</h6> </div>
                                <div class="form-group py-2">
                                        <label>Name</label>
                                        <input type="text" name="username" v-model="formData.user.phone.name"  class="form-control"/>
                                </div>

                                <div class="form-group py-2">
                                    <label>Number</label>
                                    <input type="text" name="username" v-model="formData.user.phone.number" class="form-control"/>
                                </div> 


                                <div class="form-group py-2">
                                    <label>Type</label>
                                    <input type="text" name="username" v-model="formData.user.phone.type" class="form-control"/>
                                </div> 


                            </div>

                            
                            <div class="col-12"> 
                                <button type="submit" class="btn btn-sm btn-info" style="padding: 8px 60px">Update</button>
                            </div>
                        </div>
                    </form>
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
        user: {  
          email:'',
          name: {
            first: '',
            middle: '',
            last: '',
            initials: '',
          },
         
          address: {
            name: '',
            street: '',
            unit: '',
            city: '',
          },

          phone: {
            name: '',
            number: '', 
            type: '', 
          },
        },
        
      },
    };
  },
  props: {
    accessToken: String,
    profileUrl: String,
    profileDetail: Object,
  },
  created(){
    this.formData.user.name.first = this.profileDetail.user.name.first
    this.formData.user.name.middle = this.profileDetail.user.name.middle
    this.formData.user.name.last = this.profileDetail.user.name.last
    this.formData.user.name.initials = this.profileDetail.user.name.initials 
    // Address

    this.formData.user.address.name = this.profileDetail.user.address.name 
    this.formData.user.address.street = this.profileDetail.user.address.street 
    this.formData.user.address.unit = this.profileDetail.user.address.unit 
    this.formData.user.address.city = this.profileDetail.user.address.city 
    this.formData.user.address.state = this.profileDetail.user.address.state 
    this.formData.user.address.zipcode = this.profileDetail.user.address.zipcode 
    this.formData.user.address.country = this.profileDetail.user.address.country  

    //phone

    this.formData.user.phone.name = this.profileDetail.user.phone.name 
    this.formData.user.phone.number = this.profileDetail.user.phone.number 
    this.formData.user.phone.type = this.profileDetail.user.phone.type 
  },
  mounted(){
     
  },
  methods: {
    async submitForm() {
        try {
            const response = await axios.post('https://crdev.sppx.io/api/v0/user/profile', this.formData, {
                headers: {
                    'Authorization': 'Bearer ' + this.accessToken,
                },
        });  
    console.log('Profile', response);  
} catch (error) {
    console.error('Error:', error);
}
    },
},
};
</script>
