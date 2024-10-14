<script setup>
   import AppMenu from './common/AppMenu.vue';
   import AppFooter from './common/AppFooter.vue';
   import axios from 'axios' ;
   import { onMounted } from 'vue';
  
</script>

<style >

       

        @keyframes placeHolderShimmer {
        0% {
            background-position: -800px 0
        }
        100% {
            background-position: 800px 0
        }
        }

        .animated-background {
            animation-duration: 2s;
            animation-fill-mode: forwards;
            animation-iteration-count: infinite;
            animation-name: placeHolderShimmer;
            animation-timing-function: linear;
            background-color: transparent;
            background: linear-gradient(to right, #eeeeee 8%, #bbbbbb 18%, #eeeeee 33%);
            background-size: 800px 104px;
            height: 52px;
            position: relative;
        }

       

</style>

<template>
        <AppMenu></AppMenu>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#" v-on:click.prevent="refreshDashboard()">Refresh Dashboard</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content">
                <div class="container-fluid">

                    
                  <div class="row">


                        <div class="col-lg-3 col-md-3 col-6">

                            <div class="small-box bg-gradient-success">
                                <div class="inner" >
                                    <div  v-if="isLoading == false">
                                    <h3>{{ dealers }}</h3>
                                    </div>
                                    <div  v-else >
                                            <div class="animated-background"></div>
                                    </div>
                                    <p>Registered GST Dealers</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <router-link to="dealers" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </router-link>
                            </div>

                        </div>


                        <div class="col-lg-3 col-md-3 col-6">

                        <div class="small-box bg-gradient-info">
                            <div class="inner">
                            
                                <div  v-if="isLoading == false">
                                   <h3>{{ non_gst_dealers }}</h3>
                                </div>
                                <div  v-else >
                                        <div class="animated-background"></div>
                                </div>
                                <p>Registered NON GST Dealers</p>
                                
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <router-link to="dealersnongst" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </router-link>
                        </div>

                        </div>


                        <div class="col-lg-3 col-md-3 col-6">

                            <div class="small-box bg-yellow">
                                <div class="inner">
                                 
                                    <div  v-if="isLoading == false">
                                         <h3>{{ dealersGHY }}</h3>
                                    </div>
                                    <div  v-else >
                                            <div class="animated-background"></div>
                                    </div>
                                    <p>Dealers - Guwahati </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <router-link to="guwahatidealers" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </router-link>
                            </div>

                        </div>

                        <div class="col-lg-3 col-md-3 col-6">

                            <div class="small-box bg-teal">
                                <div class="inner">
                                 
                                    <div  v-if="isLoading == false">
                                         <h3>{{ dealersNonGHY }}</h3>
                                    </div>
                                    <div  v-else >
                                            <div class="animated-background"></div>
                                    </div>
                                    <p>Dealers - Outside Guwahati</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                 <router-link to="outsideguwahati" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </router-link>
                            </div>

                        </div>

                        <div class="col-lg-3 col-md-3 col-6">

                            <div class="small-box bg-primary">
                                <div class="inner">
                                    
                                    <div  v-if="isLoading == false">
                                         <h3>{{ all_products }}</h3>
                                    </div>
                                    <div  v-else >
                                            <div class="animated-background"></div>
                                    </div>  
                                    <p>All Products</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-object-group"></i>
                                </div>
                                <router-link to="products" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </router-link>
                            </div>

                        </div>

                        

                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="small-box bg-dark">
                                <div class="inner">
                                   
                                    <div  v-if="isLoading == false">
                                         <h3>{{ app_active_product }}</h3>
                                    </div>
                                    <div  v-else >
                                            <div class="animated-background"></div>
                                    </div>
                                    <p>Active Products In APP</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-object-group"></i>
                                </div>
                                <router-link to="activeproducts" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </router-link>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-6">

                            <div class="small-box bg-secondary">
                                <div class="inner">
                                  
                                    <div  v-if="isLoading == false">
                                         <h3>{{ incomplete_products }}</h3>
                                    </div>
                                    <div  v-else >
                                            <div class="animated-background"></div>
                                    </div>
                                    <p>Incomplete Products</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-object-group"></i>
                                </div>
                                <router-link to="incompleteproducts" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </router-link>
                            </div>

                        </div>


                       

                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                  
                                    <div  v-if="isLoading == false">
                                         <h3>{{ app_disabled_products }}</h3>
                                    </div>
                                    <div  v-else >
                                            <div class="animated-background"></div>
                                    </div>
                                    <p>Deactivated Products In APP</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-object-group"></i>
                                </div>
                                <router-link to="disabledproductsinapp" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </router-link>
                            </div>
                        </div>


                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="small-box bg-purple">
                                <div class="inner">
                                  
                                    <div  v-if="isLoading == false">
                                         <h3>{{ eol_products }}</h3>
                                    </div>
                                    <div  v-else >
                                            <div class="animated-background"></div>
                                    </div>
                                    <p>EOL Products</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-object-group"></i>
                                </div>
                                <router-link to="eolproducts" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </router-link>
                            </div>
                        </div>


                       



                        <div class="col-lg-3 col-md-3 col-6">

                            <div class="small-box bg-info">
                                <div class="inner">
                                   
                                    <div  v-if="isLoading == false">
                                         <h3>{{ newProductOrders }}</h3>
                                    </div>
                                    <div  v-else >
                                            <div class="animated-background"></div>
                                    </div>
                                    <p>New Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <router-link to="orders" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </router-link>
                            </div>

                        </div>

                        <div class="col-lg-3 col-md-3 col-6">

                            <div class="small-box bg-success">
                                <div class="inner">
                                   
                                    <div  v-if="isLoading == false">
                                         <h3>{{ new_orders_guwahati }}</h3>
                                    </div>
                                    <div  v-else >
                                            <div class="animated-background"></div>
                                    </div>
                                    <p>New Orders (Guwahati)</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <router-link to="orders" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </router-link>
                            </div>

                        </div>

                        <div class="col-lg-3 col-md-3 col-6">

                            <div class="small-box bg-indigo">
                                <div class="inner">
                                   
                                    <div  v-if="isLoading == false">
                                         <h3>{{ new_orders_outside_guwahati }}</h3>
                                    </div>
                                    <div  v-else >
                                            <div class="animated-background"></div>
                                    </div>
                                    <p>New Orders (Outside Guwahati)</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <router-link to="orders" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </router-link>
                            </div>

                        </div>

                        <div class="col-lg-3 col-md-3 col-6">

                            <div class="small-box bg-yellow">
                                <div class="inner">
                                 
                                    <div  v-if="isLoading == false">
                                         <h3>{{ completedOrders }}</h3>
                                    </div>
                                    <div  v-else >
                                            <div class="animated-background"></div>
                                    </div>
                                    <p>Confirmed Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <router-link  to="confirmedorders" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </router-link>
                            </div>

                        </div>



                        <div class="col-lg-3 col-md-3 col-6">

                            <div class="small-box bg-teal">
                                <div class="inner">
                                 
                                    <div  v-if="isLoading == false">
                                         <h3>{{ holdedOrders }}</h3>
                                    </div>
                                    <div  v-else >
                                            <div class="animated-background"></div>
                                    </div>
                                    <p>Orders on Hold</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <router-link  to="holdedorders" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </router-link>
                            </div>

                        </div>



                        <div class="col-lg-3 col-md-3 col-6">

                            <div class="small-box bg-info">
                                <div class="inner">
                                   
                                    <div  v-if="isLoading == false">
                                         <h3>{{ rejectedOrders }}</h3>
                                    </div>
                                    <div  v-else >
                                            <div class="animated-background"></div>
                                    </div>
                                    <p>Rejected Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <router-link  to="rejectedorders" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </router-link>
                            </div>

                        </div>


                        <div class="col-lg-3 col-md-3 col-6">

                            <div class="small-box bg-secondary">
                                <div class="inner">
                                
                                    <div  v-if="isLoading == false">
                                       <b>  {{ last_sync_date }} / {{ last_sync_time }} </b><br>
                                       <b>  Records Updated :  {{ total_records_updated }} </b>
                                    </div>
                                    <div  v-else >
                                            <div class="animated-background"></div>
                                    </div>
                                    <p>Last Sync Date/Time </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-object-group"></i>
                                </div>
                                <router-link to="incompleteproducts" class="small-box-footer">
                                   &nbsp;
                                </router-link>
                            </div>

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
                dealers: null,
                all_products: null,
                incomplete_products: null,
                app_active_product: null,
                newProductOrders: null,
                completedOrders: null,
                holdedOrders:null,
                rejectedOrders:null,
                eol_products: null,
                app_disabled_products : null,
                non_gst_dealers : null ,
                new_orders_guwahati : null,
                new_orders_outside_guwahati : null,
                isLoading: null,
                loaderImage : null,
                last_sync_date : null,
                last_sync_time : null,
                total_records_updated : null,
                dealersGHY : null,
                dealersNonGHY : null
            };
        },

        methods: {
            async fetchData() {      
                axios.get('/api/dashboard')
                .then((response) => {
                    console.log("Orders : " + response.data.new_orders_outside_guwahati);
                    this.dealers = response.data.dealers ;
                    this.non_gst_dealers = response.data.nonGSTdealers ;
                    this.new_orders_guwahati = response.data.new_orders_guwahati ;
                    this.new_orders_outside_guwahati = response.data.new_orders_outside_guwahati ;
                    this.all_products = response.data.all_products ;
                    this.eol_products = response.data.eol_products ;
                    this.incomplete_products = response.data.incomplete_products ;
                    this.app_active_product = response.data.app_active_product ;
                    this.newProductOrders = response.data.newProductOrders ;
                    this.completedOrders = response.data.completedOrders ;
                    this.holdedOrders = response.data.holdedOrders ;
                    this.rejectedOrders = response.data.rejectedOrders ;
                    this.app_disabled_products = response.data.app_disabled_products ;
                    this.last_sync_date = response.data.last_sync_date;
                    this.last_sync_time = response.data.last_sync_time;
                    this.total_records_updated = response.data.total_records_updated;
                    this.dealersGHY = response.data.dealersGHY;
                    this.dealersNonGHY = response.data.dealersNonGHY;
                    this.isLoading = false;
                    
                });
            },  

            showloaderImage() {
               return 'images/motion-blur-2.png';
            },
            
            refreshDashboard() {
                this.isLoading = true;
                console.log("Test refresh");
                setTimeout( () => { this.fetchData() } , 1000);
              //  this.fetchData();
            }
        },

       


        mounted() {
          this.isLoading = true;
          setTimeout( () => { this.fetchData() }, 1000);
        },


    };
</script>