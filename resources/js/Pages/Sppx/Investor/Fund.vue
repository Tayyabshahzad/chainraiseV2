<template>


    <section class="p-lg-5 p-3 hero-bg">
        <div class="container">
            <div id="carouselExample" class="" data-bs-ride="carousel">
                <div class="">
                    <div class=" ">
                        <div class="row"  >
                            <div class="col-lg-12 py-5 text-right text-white">
                                <h6>
                                    Funding
                                </h6>
                                <p>Please select from the options below to fund </p>

                                    <ul>
                                        <li v-for="(option, index) in options.options" :key="index">
                                        <span >

                                            <p > <input type="radio" name="payment_src"  v-model="formData.source"  :value="option.source"/> Pay via {{ option.source }}</p>

                                        </span>

                                         </li>
                                      </ul>
                                      <hr/>
                                      <br/>
                                      <button class="btn btn-success btn-sm" @click="submitfund"> Submit </button>

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
export default {
    data() {
        return {
            formData: {
                source: '',
                UUID_TXN:this.UUID_TXN
            }
        };
    },
    props: {
        options: {
            type: Object,
            required: true
        },
        UUID_TXN:{
            type: String,
            required: true
        }
  },
    created(){
        console.log('options')
           console.log(this.options)
    },
    methods:{

        submitfund(){
            console.log('options')
            axios.post(route('api.post.fund'),this.formData).then(response => {
                    console.log(response);
                    if (response.data.status === true) {
                        alert("Pledge Success ");
                    } else {
                        alert("Pledge Not Success ");
                    }
                })
                .catch(error => {  console.log(error); });
        }
    }
}
</script>
