<script setup>
   import { useRouter } from 'vue-router';
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
                            <h1 class="m-0">QMAX Products</h1>
                        </div>
                    
                    </div>
                </div>
            </div>


            <div class="content">
                <div class="container-fluid">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Product List</h3>
                        </div>

                        <div class="card-body">
                            <b> {{ dataLoading }} </b>
                            <table class="table table-bordered responsive nowrap" id="datatable" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">Part No</th>
                                        <th>Product Name(as per Tally)</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th style="width: 40px">Details</th>
                                    </tr>
                                </thead>

                                <tbody >

                                    <tr v-for="product in products" :key="product.product_ct_id ">
                                        <td>{{ product.part_no }} </td>
                                        <td>
                                              <b>{{ product.product_name_tally }}</b> <br>
                                               Size (Inches) : {{ product.product_size_inches}} 
                                           
                                              
                                        </td>
                                        <td>
                                               <div v-if="product.is_image == '1'" >
                                                  <img v-bind:src="getImage(product.part_no)" style="width:80px; height: auto" >
                                               </div>

                                               <div v-if="product.is_image != '1'" >
                                                  <b>No Image</b>
                                               </div>
                                                
                                                
                                           
                                            
                                        </td>
                                        <td>{{ product.primary_category }}</td>
                                        <td>{{ product.product_type }}</td>
                                     
                                        <td>
                                            <router-link :to="'productdetails/' + product.product_ct_id" @click="setPageReferrer('PRODUCT_LIST')">View</router-link>
                                        </td>
                                      
                                        <!--

                                         <td>
                                                <a href="#" @click="viewProductDetails(product.product_ct_id)" >
                                                   View
                                                </a>
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
    const router = useRouter();
    export default {
       
        data() {
            return {
                products: [],
                dataLoading : ''
            }
        },

        methods: {
            
            refreshPage() {
                //router.go(); // Reloads the current route
                //this.$router.replace({ name: 'dashboard' })
            },
            setPageReferrer(page_name) {
                store.dispatch('updateInterComponentReferer', page_name);
            },

            getImage(part_no) {
                //let timestamp = new Date().getTime();
                //return "http://mis.qmaxonline.com:8080/uploads/" + part_no + ".jpg" + '?cache=' + timestamp; 
                return "http://mis.qmaxonline.com:8080/uploads/" + part_no + ".jpg" ;
            },
           
            async fetchData() {  
                store.dispatch('updateInterComponentReferer', '');
                this.dataLoading = "Fetching all products ...";
                axios.get('/api/products')
                .then((response) => {
                 
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
           // this.refreshPage();
          this.fetchData();
        },


    };
</script>