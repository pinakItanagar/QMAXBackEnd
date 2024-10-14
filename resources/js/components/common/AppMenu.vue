<script setup>
    import Appheader from './Appheader.vue';
    import $ from "jquery";
</script>

<template>
    <Appheader></Appheader> 
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="#" class="brand-link">
          <img :src="getLogo()" style="width: 200px; height: auto;" > 
     
            
        </a>

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                
                <div class="info">
                    <a href="#" class="d-block"> {{ $store.getters.getUserName }}</a>
                </div>
            </div>

           

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <router-link to="/admin/dashboard" active-class="active" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-alt"></i>
                                 <p>  Registered Dealers <i class="right fas fa-angle-left"></i> </p>
                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <router-link to="/admin/dealers" active-class="active" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>GST Dealers </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/admin/dealersnongst" active-class="active" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>NON-GST Dealers</p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/admin/guwahatidealers" active-class="active" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dealers of Guwahati</p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/admin/outsideguwahati" active-class="active" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dealers of Out Guwahati</p>
                                </router-link>
                            </li>
                         
                            <li class="nav-item">
                                <router-link to="/admin/appuniqueuserlog" active-class="active" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>App Access Log - Unique</p>
                                </router-link>
                            </li>
                          

                        </ul>
                    </li>

                 

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-object-group"></i>
                                 <p>  Products  <i class="right fas fa-angle-left"></i> </p>
                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <router-link to="/admin/products" active-class="active" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Products </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/admin/activeproducts" active-class="active" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Active Products</p>
                                </router-link>
                            </li>


                            <li class="nav-item">
                                <router-link to="/admin/productqr" active-class="active" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Generate/Print QR Code </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/admin/disabledproductsinapp" active-class="active" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Deactivated Products</p>
                                </router-link>
                            </li>


                            <li class="nav-item">
                                <router-link to="/admin/incompleteproducts" active-class="active" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Incomplete Products </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/admin/eolproducts" active-class="active" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>EOL Products </p>
                                </router-link>
                            </li>

                        </ul>
                    </li>


                    <li class="nav-item">
                        <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                 <p>  Orders  <i class="right fas fa-angle-left"></i> </p>
                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <router-link to="/admin/orders" active-class="active" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Orders </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                    <router-link to="/admin/confirmedorders" active-class="active" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Confirmed Orders </p>
                                    </router-link>
                            </li>

                            <li class="nav-item">
                                    <router-link to="/admin/holdedorders" active-class="active" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>On Hold Orders </p>
                                    </router-link>
                            </li>

                            <li class="nav-item">
                                    <router-link to="/admin/rejectedorders" active-class="active" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rejected Orders </p>
                                    </router-link>
                            </li>


                        </ul>    

                    </li>    


                    

                  


                    


                    <li class="nav-item">
                        <router-link to="/"  class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout </p>
                        </router-link>
                    </li>

                </ul>
            </nav>

        </div>

    </aside>
    
</template>


<script>
    export default {
        components: { Appheader },
        name: 'AppMenu',
    
        methods:{
            getLogo() {
                return  this.$appLogo;
            },
           
        },
        mounted() {
          $('[data-widget="treeview"]').Treeview('init');
        }
    }
</script>