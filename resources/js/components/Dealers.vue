<script setup>

   import axios from 'axios' ;
   import $ from "jquery";
   import { onMounted } from 'vue';
   import AppMenu from './common/AppMenu.vue';
   import AppFooter from './common/AppFooter.vue';
   import store from './../store';


</script>


<template>
        <AppMenu></AppMenu>
        <div class="content-wrapper">
            
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Registered GST Dealers</h1>
                        </div>
                    
                    </div>
                </div>
            </div>


            <div class="content">
                <div class="container-fluid">
                      <div class="row" v-if="$store.getters.getAppMSG !== ''">
                        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1">&nbsp;</div>
                        <div class="col-md-10 col-lg-10 col-sm-10 col-xs-10">
                            <div class="alert alert-secondary" role="alert">
                                {{ $store.getters.getAppMSG }}
                            </div>
                        </div>
                        <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1">&nbsp;</div>
                    </div> 
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Registered GST Dealer List</h3>
                        </div>

                        <div class="card-body">
                            <b> {{ dataLoading }} </b>
                            <table class="table table-bordered responsive nowrap" id="datatable" width="100%" >
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Dealer Name</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>GST</th>
                                        <th style="width: 40px">Details</th>
                                    </tr>
                                </thead>

                                <tbody >

                                    <tr v-for="dealer in dealers" :key="dealer.dealer_id">
                                        <td>{{ dealer.id }} </td>
                                        <td>{{dealer.firmName }} </td>
                                        <td>{{dealer.dealerMobile}}</td>
                                        <td>{{dealer.cityName}}</td>
                                        <td>{{dealer.gstNo}}</td>
                                        <td>
                                             <router-link :to="'dealerdetails/' + dealer.dealer_id" @click="setPageReferrer('GST_DEALER_LIST')">View</router-link>
                                        </td>
                                    </tr>

                                </tbody>

                            </table>    

                        </div>


                    </div>   
                </div>
            </div>
        </div>
         <AppFooter></AppFooter>   
</template>

<script >
    export default {
       
        data() {
            return {
                dealers: [],
                slno : 1,
                dataLoading : ''
            }
        },

        methods: {
            incrementIndex(key) {
                //console.log(key);
                sNum = sNum + key;
                return this.slno = sNum;
            },

              myTofunction: function() {
                let timer = setTimeout(function() {
                    store.dispatch('updateAppMessage', '');
                }, 5000);
              
           },

            setPageReferrer(page_name) {
                store.dispatch('updateInterComponentReferer', page_name);
            },

            async fetchData() {  
                this.myTofunction();
                this.dataLoading = "Fetching all GST dealers ...";
                axios.get('/api/dealers')
                .then((response) => {
                    this.slno = 1;    
                    console.log(response.data.dealers);
                    this.dealers = response.data.dealers ;
                    this.dataLoading = '';
                    setTimeout(() => {
                        var table = $("#datatable").DataTable({
                            responsive: true,
                            pageLength: 10    
                        });

                        new $.fn.dataTable.Responsive( table, {
                            details: false
                        } );
                    });
                });
            },    
        },
        mounted() {
          this.fetchData();
        },


    };
</script>