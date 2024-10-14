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
                            <h1 class="m-0">QMAX EOL Products</h1>
                        </div>
                    
                    </div>
                </div>
            </div>


            <div class="content">
                <div class="container-fluid">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">EOL Product List</h3>
                        </div>

                        <div class="card-body">
                            <b> {{ dataLoading }} </b>
                            <table class="table table-bordered responsive nowrap" id="datatable" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">Part No</th>
                                        <th>Product Name(as per Tally)</th>
                                        <th>Size (Inches)</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th style="width: 40px">Details</th>
                                    </tr>
                                </thead>

                                <tbody >

                                    <tr v-for="product in products" :key="product.product_ct_id ">
                                        <td>{{ product.part_no }} </td>
                                        <td>{{ product.product_name_tally }} </td>
                                        <td>{{ product.product_size_inches}}</td>
                                        <td>{{ product.primary_category }}</td>
                                        <td>{{ product.product_type }}</td>
                                        <td>
                                            <router-link :to="'productdetailsview/' + product.product_ct_id" >View</router-link>
                                        </td>
                                        <!--
                                        <td>
                                            <router-link :to="'incompleteproductdetails/' + product.product_ct_id">View</router-link>
                                        </td>
                                       -->
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
                products: [],
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
            async fetchData() {  
                this.dataLoading = "Fetching all EOL products ...";
                axios.get('/api/eolproducts')
                .then((response) => {
                    this.slno = 1;    
                    this.products = response.data.products ;
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