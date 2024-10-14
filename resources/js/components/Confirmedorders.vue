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
                            <h1 class="m-0">QMAX Product Order - CONFIRMED</h1>
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
                            <h3 class="card-title">Confirmed Product Order List</h3>
                        </div>

                        <div class="card-body">
                            <b> {{ dataLoading }} </b>
                            <table class="table table-bordered responsive nowrap" id="datatable" width="100%">
                                <thead>
                                    <tr>
                                        <th>Order No</th>
                                        <th>Dealer Firm</th>
                                        <th>Box Required</th>
                                        <th>Order Date</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>

                                <tbody >

                                    <tr v-for="order in orders" :key="order.order_id ">
                                        <td>{{ order.order_number  }} </td>
                                        <td>{{ order.firmName }} </td>
                                        <td>{{ order.box_required}}</td>
                                        <td>{{ order.order_date }}</td>
                                        <td>
                                            <router-link :to="'orderdetailsview/' + order.order_number " @click="setPageReferrer('CNF_ORDER_LIST')">View Order</router-link>
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
                orders: [],
                dataLoading : ''
            }
        },

        methods: {
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
                this.dataLoading = "Fetching all orders ...";
                axios.get('/api/confirmedorders')
                .then((response) => {
               
                    this.orders = response.data.orders ;
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