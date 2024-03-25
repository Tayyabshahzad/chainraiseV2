<template>


    <section class="p-lg-5 p-3 hero-bg">
        <div class="container">
            <div id="carouselExample" class="" data-bs-ride="carousel">
                <div class="">
                    <div class=" ">
                        <div class="row">
                            <div class="col-lg-12 py-5 text-right text-white">
                                <h2 >Investor Certification</h2>
                                <hr/>
                                <br/>
                                <h4 >
                                    I UNDERSTAND AND ACKNOWLEDGE THAT:
                                </h4>
                                <p>
                                    If I make an investment in an offering through this Federal Funding Portal, it is very likely that I am investing in a high-risk, speculative business venture that could result in the complete loss of my investment, and I need to be able to afford such a loss.
                                </p>

                                <p>
                                    These offerings have not been reviewed or approved by any state or federal securities commission or division or other regulatory authority and that no such person or authority has confirmed the accuracy or determined the adequacy of any disclosure made to me relating to these offerings. If I make an investment in an offering through this Federal Funding Portal, it is very likely that the investment will be difficult to transfer or sell and, accordingly, I may be required to hold the investment indefinitely.
                                </p>

                                <p>
                                    By entering into a transaction with the company, I am affirmatively representing myself as being an eligible investor at the time that this contract is formed, and if this representation is subsequently shown to be false, the contract is void..
                                </p>

                                <p>
                                    I understand that any person who promotes an offering for compensation or is a founder or employee of the issuer must clearly disclose in all communications hosted on this portal the receipt of compensation and that he or she is engaging in promotional activities on behalf of the issuer.
                                </p>

                                <p>
                                    This portal receives compensation from the issuer companies as a percentage of the funds raised (up to 7%) and is paid by the issuer at the time the funds are disbursed.
                                </p>

                                <p>
                                    I have been given access to Investor Education materials, have reviewed and agree to be bound by the Electronic Consent & Delivery agreement, the Privacy & Cybersecurity Policies statement.
                                </p>

                                <b> REG-CF Investor Certification </b>
                            </div>

                            <a  :href="route('api.profile')" target="_blank" class="btn btn-info btn-sm" v-if="!initials">  Complete Your Profile </a>

                            <div class="col-lg-12 ">
                                <form action="" class="row t" v-if="initials">

                                    <div>
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
                                            <div class="  text-right text-white"> <p>I acknowledge that I understand the risk:</p></div>
                                            <button class="btn btn-sm btn-info" type="button" @click="updateSetting">Update</button>
                                        </div>
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

                initials: '',
                income: '',
                networth: '',
                regcf: ''


            };
        },
        props: {
            saveAccreditation: String,
            uuid: String,
            dataForView: Object, // Add dataForView as a prop
            profile:Object
        },

        created(){  
            if (this.dataForView.accreditation) {
                    const accreditationData = this.dataForView.accreditation;
                    this.initials = this.profile.user.name.initials || '';
                    this.income = accreditationData.income || '';
                    this.networth = accreditationData.networth || '';
                    this.regcf = accreditationData.regcf || '';
                }
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
                axios.post(route('api.save.accreditation'),postData).then(response => {
                    console.log(response.data.status)
                    if (response.data.status == true) {
                       window.location.href= route('api.pledge',this.uuid)
                    } else {
                        alert(response.data.message)
                    }
                }).catch(error => {
                    console.log(error)
                    alert('Error saving accreditation. Please try again later.');
                });
            }
 
        }
    }

</script>
