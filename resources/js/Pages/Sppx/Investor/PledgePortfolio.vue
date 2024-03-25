<template>


    <section class="p-lg-5 p-3 hero-bg">
        <div class="container">
            <div id="carouselExample" class="" data-bs-ride="carousel">
                <div class="">
                    <div class=" ">
                        <div class="row" v-if="this.data">
                            <div class="col-lg-12 py-5 text-right text-white">
                                <h2 >Pledge support for  {{ this.data.id }}  {{ this.data.name }} </h2>
                            </div>
                            <div class="col-lg-12 ">
                                <h6  ><b>Your current interests in "{{ this.data.id }}  {{ this.data.name }}":</b></h6>
                                <table class="table table py-5" >
                                    <tbody>
                                        <tr>
                                            <td><b>TXID</b></td>
                                            <td><b>STATUS</b></td>
                                            <td><b>AMOUNT</b></td>
                                            <td><b>INVESTED</b></td>
                                            <td><b>ACTIONS</b></td>
                                        </tr>

                                        <template v-if="data.txn">
                                            <tr >
                                                <td>{{ data.txn.txid }}</td>
                                                <td>{{ data.txn.status }}</td>
                                                <td>{{ data.txn.amount }}</td>
                                                <td> --  </td>
                                                <td>
                                                    <a v-if="data.txn.status != 'Canceled'" class="btn btn-sm btn-warning" :href="route('api.ach.enroll',[this.uuid,this.data.txn.uuid])"> Fund Pledge </a> &nbsp;&nbsp;

                                                    <button class="btn btn-sm btn-danger" type="button" v-if="data.txn.status != 'Canceled'" @click="CancelPledge(data.txn.uuid)" >Cancel w </button>
                                                </td>
                                            </tr>
                                        </template>
                                        <template v-else-if="data.txns">
                                            <tr v-for="(item, index) in data.txns" :key="index">
                                                <td>{{ item.txid }}</td>
                                                <td>{{ item.status }}</td>
                                                <td>{{ item.amount }}</td>
                                                <td> --  </td>
                                                <td>

                                                    <a v-if="item.status != 'Canceled'"  class="btn btn-sm btn-warning" :href="route('api.ach.enroll',[this.uuid,item.uuid])"> Fund Pledge </a> &nbsp;&nbsp;

                                                    <button  v-if="item.status != 'Canceled'" class="btn btn-sm btn-danger" type="button" @click="CancelPledge(item.uuid)" >Cancel </button>
                                                </td>
                                            </tr>
                                        </template>
                                        <template v-else>
                                            <tr>
                                              <td colspan="5">No transactions available</td>
                                            </tr>
                                        </template>

                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-lg-12 ">
                                <h6  v-if="this.data"><b>Your current interests in "{{ this.data.id }}  {{ this.data.name }}":</b></h6>
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
                                            <td>$ {{this.pledge.pledge.minimum }}</td>
                                            <td>$ {{this.pledge.pledge.requested }}</td>
                                            <td>{{this.pledge.pledge.maximum }}</td>
                                            <td> {{this.pledge.pledge.rule }}</td>
                                            <td> {{this.pledge.pledge.auto  }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <form @submit.prevent="submitPledge">
                                    <table class="table" style="width:100%;">
                                        <tr align="left"  v-if="formData.affirm.ustaxpayer">
                                            <td class="">
                                                <input type="checkbox"  v-model="formData.affirm.ustaxpayer" class="" required />
                                            </td>
                                            <td>
                                            <small style="background: none; color: #fff;"> &nbsp;&nbsp;{{ this.pledge.affirm.ustaxpayer }}</small>
                                            </td>
                                        </tr>

                                        <tr align="left">
                                            <td><input type="checkbox"   v-model="formData.affirm.education" class="" required/> </td>
                                            <td>
                                                <small style="background: none; color: #fff;">  &nbsp;&nbsp; {{ this.pledge.affirm.education }} </small>
                                            </td>
                                        </tr>
                                        <tr align="left">
                                            <td><input type="checkbox"   v-model="formData.affirm.risk" class="" required/> </td>
                                            <td>
                                                <small style="background: none; color: #fff;">  &nbsp;&nbsp; {{ this.pledge.affirm.risk }} </small>
                                            </td>
                                        </tr>
                                        <tr align="left">
                                            <td><input type="checkbox"   v-model="formData.affirm.cancel" class="" required/> </td>
                                            <td>
                                                <small style="background: none; color: #fff;">  &nbsp;&nbsp; {{ this.pledge.affirm.cancel }} </small>
                                            </td>
                                        </tr>
                                        <tr align="left">
                                            <td><input type="checkbox"   v-model="formData.affirm.resale" class="" required/> </td>
                                            <td>
                                                <small style="background: none; color: #fff;">  &nbsp;&nbsp; {{ this.pledge.affirm.resale }} </small>
                                            </td>
                                        </tr>

                                        <tr align="left">
                                            <td colspan="2">
                                                <br/>
                                            </td>
                                        </tr>

                                        <tr align="left">
                                            <td colspan="2">
                                                <input type="text" v-model="formData.pledge" :placeholder="this.pledge.pledge.minimum" class="form-control" required/>
                                            </td>
                                        </tr>
                                    </table>
                                    <button type="button" class="btn btn-sm btn-info" @click="submitPledge">  Pledge Now  </button>
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
        data(){
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
            }
        },
        props: {
            data: Object,
            pledge: Object,
            uuid:String
        },
        created(){
           console.log(this.data)


        },
        methods:{
            submitPledge(){

                axios.post(route('api.pledge.submit'),this.formData).then(response => {
                    console.log(response);
                    if (response.data.status === true) {
                        alert("Pledge Success ");
                    } else {
                        alert("Pledge Not Success ");
                    }
                })
                .catch(error => {  console.log(error); });
            },

            CancelPledge(uuid){
                axios.get(route('api.pledge.cancel',uuid)).then(response => {
                    console.log(response);
                    if (response.data.status === true) {
                        alert(response.data.massage);
                    } else {
                        alert(response.data.massage);
                    }
                })
                .catch(error => {  console.log(error); });
            },

        },


    }

</script>
