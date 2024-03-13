<template>


<section class="p-lg-5 p-3 hero-bg">
    <div class="container">
        <div id="carouselExample" class="" data-bs-ride="carousel">
            <div class="">
                <div class=" ">
                    <div class="row">
                        <div class="col-lg-12 py-5 text-right">
                            <a href="">Accreditation Setup</a>
                        </div>

                        <div class="col-lg-12 py-5 ">
                            <form action="" class="row t">

                                <div class="form-group col-lg-6  py-1">
                                    <label for="" style="color:wheat">Initials</label>
                                    <input type="text" id="initials" v-model="initials" class="form-control"/>
                                </div>

                                <div class="form-group col-lg-6  py-1">
                                    <label for="" style="color:wheat">Income</label>
                                    <input type="text" id="income" v-model="income" class="form-control"/>
                                </div>

                                <div class="form-group col-lg-6  py-1">
                                    <label for="" style="color:wheat">Networth</label>
                                    <input type="text" id="networth" v-model="networth" class="form-control"/>
                                </div>

                                <div class="form-group col-lg-6  py-1">
                                    <label for="" style="color:wheat">Regcf</label>
                                    <input type="text" id="regcf" v-model="regcf" class="form-control"/>
                                </div>

                                <div class="form-group col-lg-6 py-4">
                                    <button class="btn btn-sm btn-info" type="button" @click="updateSetting">  Update </button>
                                </div>


                            </form>
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

        initials:'',
        income:'',
        networth:'',
        regcf:''


    };
  },
  props: {
    saveAccreditation: String,
    uuid:String
  },
  created(){

  },
  mounted(){

  },
  methods: {
    updateSetting(){

    const postData = {
        initials: this.initials,
        income: this.income,
        networth: this.networth,
        regcf: this.regcf,
        uuid:this.uuid
    };

        axios.post(this.saveAccreditation,postData)
        .then(response => {
            console.log(response.data.status)
            if (response.data.status === true) {
                alert(response.data.message);
            } else {
                alert('Error saving accreditation. Please try again later.');
            }
        })
        .catch(error => {
            console.error(error);
            alert('Error saving accreditation. Please try again later.');
        });
    }
  },
};
</script>
