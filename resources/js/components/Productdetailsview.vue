<template>
    <AppMenu></AppMenu>
         <div class="content-wrapper">
             
             <div class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                            &nbsp;
                         </div>
                     
                     </div>
                 </div>
             </div>
 
 
             <div class="content">
                 <div class="container-fluid">
 
                     <div class="row">
                         <div class="col-md-2 col-lg-2 col-sm-8 col-xs-12">&nbsp;</div>
                         <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12">
                             <div class="card card-primary">
 
                                 <div class="card-header">
                                     <h3 class="card-title">Product Details - EOL</h3>
                                 </div>
                                 
                                 <form v-on:submit.prevent="submitForm">
 
                                     <div class="card-body">
                                         <b> {{ dataLoading }} </b>

                                        
 
                                         <div class="form-group col-md-8">
                                             <label for="exampleInputEmail1">Product Name (As per Tally)</label>
                                             <input type="text" class="form-control" v-model="productNameTally" placeholder="Enter product name as per tally" disabled   >
                                         </div>
 
                                         <div class="form-group col-md-8">
                                             <label for="exampleInputEmail1">Product Name (As per Customer)</label>
                                             <input type="text" class="form-control" v-model="productNameCustomer" placeholder="Enter product name as per customer" disabled    >
                                         </div>

                                         <div class="form-group col-md-4">
                                             <label for="exampleInputEmail1">Part No</label>
                                             <input type="text" class="form-control" v-model="part_no" placeholder="Enter Part No" disabled    >
                                         </div>
 
                                        
 
                                         <div class="form-group col-md-4">
                                             <label for="exampleInputEmail1">Product Size (Inches)</label>
                                             <select class="form-control" v-model="productSizeInches"  @change="onChange($event)" disabled   >
                                                 <option value="" >Select Inches</option>
                                                 <option v-bind:key="option.value"  v-for="option in optionsInches" v-bind:value="option.value"> 
                                                     {{ option.text }}
                                                 </option>
                                             </select>
                                         </div>
 
                                         <div class="form-group col-md-4">
                                             <label for="exampleInputEmail1">Product Size (MM)</label>
                                             <input type="text" class="form-control" v-model="productSizeMM" placeholder="Enter product size in MM" disabled    >
                                         </div>
 
 
                                         <div class="form-group col-md-4">
                                             <label for="exampleInputEmail1">Product Category</label>
                                             <select class="form-control" v-model="productCategory" disabled >
                                                 <option value="" >Select Category</option>
                                                 <option v-bind:key="option.value"  v-for="option in optionsProductCategory" v-bind:value="option.value"    > 
                                                     {{ option.text }}
                                                 </option>
                                             </select>
                                         </div>
 
 
                                         <div class="form-group col-md-4">
                                             <label for="exampleInputEmail1">Product Type</label>
                                             <select class="form-control" v-model="productType" disabled >
                                                 <option value="" >Select Product Type</option>
                                                 <option v-bind:key="option.value"  v-for="option in optionsProductType" v-bind:value="option.value"   > 
                                                     {{ option.text }}
                                                 </option>
                                             </select>
                                         </div>
 
 
                                         <div class="form-group col-md-4">
                                             <label for="exampleInputEmail1">Finish Type</label>
                                             <select class="form-control" v-model="finishType" disabled >
                                                 <option value="" >Select Finish Type</option>
                                                 <option v-bind:key="option.value"  v-for="option in optionsFinishType" v-bind:value="option.value"   > 
                                                     {{ option.text }}
                                                 </option>
                                             </select>
                                         </div>
 
 
                                         <div class="form-group col-md-4">
                                             <label for="exampleInputEmail1">Item Per Box</label>
                                             <input type="text" class="form-control" v-model="item_per_box" placeholder="Enter item per box" disabled    >
                                         </div>

                                         <div class="form-group col-md-4">
                                             <label for="exampleInputEmail1">Sqr Ft. Per Box</label>
                                             <input type="text" class="form-control" v-model="sqr_ft_per_box" placeholder="Enter Sqr Ft. per box"  disabled  >
                                         </div>

                                         


                                         <div class="form-group col-md-4">
                                             <label for="exampleInputEmail1">Display In APP</label>
                                             <select class="form-control" v-model="display_status" disabled >
                                                 <option value="" >Select Display In APP</option>
                                                 <option v-bind:key="option.value"  v-for="option in optionsDisplay" v-bind:value="option.value"    > 
                                                     {{ option.text }}
                                                 </option>
                                             </select>
                                         </div>

                                         <div class="form-group col-md-8" v-if="is_image === 1">
                                            <img :src="getProductImage()" style="width: 300px; height: auto;" > 
                                        </div>

                                        



                                        

                                        

                                        
 
 
 
                                     </div>

                                     <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12" >
                                                <button type="button" class="btn btn-primary"  @click="goBackToPage()" >Back to EOL Product List</button>
                                            </div>
                                           
                                        </div>    
                                       
                                    </div>
 
                                 </form>
                             </div>
                         </div>      
                     </div> 
                     
                 </div>
             </div>
         </div>
          <AppFooter></AppFooter>   
    
</template>

<script >
import axios from 'axios' ;
import $ from "jquery";
import { onMounted } from 'vue';
import AppMenu from './common/AppMenu.vue';
import AppFooter from './common/AppFooter.vue';
import store from './../store';

export default {

    components: { 
            AppMenu, 
            AppFooter
    },

    data() {

        return {
                 product: '',
                 productNameTally : '',
                 productNameCustomer : '',
                 productSizeMM : '',
                 productSizeInches : '',
                 productCategory : '',
                 productType : '',
                 finishType : '',
                 item_per_box : '',
                 sqr_ft_per_box : '',
                 display_status : '',
                 productImage : null,
                 updatedProductImage :null,
                 part_no : '',
                 product_ct_id : '',
                 response_message : '',
                 response_status : '',
                 is_image : '',
                 backLink : '',
                 optionsInches: [
                     { text: '8X12', value: '8X12' },
                     { text: '8X40', value: '8X40' },
                     { text: '8X48', value: '8X48' },
                     { text: '10X15', value: '10X15' },
                     { text: '10X18', value: '10X18' },
                     { text: '10X20', value: '10X20' },
                     { text: '12X12', value: '12X12' },
                     { text: '12X18', value: '12X18' },
                     { text: '12X24', value: '12X24' },
                     { text: '12X48', value: '12X48' },
                     { text: '16X16', value: '16X16' },
                     { text: '24X24', value: '24X24' },
                     { text: '24X48', value: '24X48' },
                     { text: '32X64', value: '32X64' },
                     { text: '32X96', value: '32X96' }
 
                 ],
                 optionsProductCategory: [
                     { text: 'FLOOR TILES', value: 'FLOOR TILES' },
                     { text: 'WALL TILES', value: 'WALL TILES' }
                 ],
                 optionsProductType: [
                     { text: 'ALL WALL', value: 'ALL WALL' },
                     { text: 'BATHROOM TILES', value: 'BATHROOM TILES' },
                     { text: 'CERAMIC FLOOR', value: 'CERAMIC FLOOR' },
                     { text: 'DOUBLE CHARGE', value: 'DOUBLE CHARGE' },
                     { text: 'ELEVATION TILES', value: 'ELEVATION TILES' },
                     { text: 'FULL BODY', value: 'FULL BODY' },
                     { text: 'KITCHEN TILES', value: 'KITCHEN TILES' },
                     { text: 'NANO', value: 'NANO' },
                     { text: 'PARKING OUTDOOR', value: 'PARKING OUTDOOR' },
                     { text: 'PGVT', value: 'PGVT' },
                     { text: 'PORCELIAN', value: 'PORCELIAN' }
                 ],
                 optionsFinishType: [
                     { text: 'GLOSSY', value: 'GLOSSY' },
                     { text: 'MATT', value: 'MATT' },
                     { text: 'CARVING', value: 'CARVING' },
                     { text: 'RUSTIC MATT', value: 'RUSTIC MATT' },
                     { text: 'HIGHGLOSS', value: 'HIGHGLOSS' },
                     { text: 'SUGAR', value: 'SUGAR' },
                     { text: 'ROTO SUGAR', value: 'ROTO SUGAR' }
                 ],
                 optionsDisplay: [
                     { text: 'YES', value: '1' },
                     { text: 'NO', value: '0' }
                 ],
                 dataLoading : ''
             }

    },

    methods : {
        goBackToPage() {
            this.$router.replace({ name: this.backLink });
        },

        getProductImage() {
            this.productImage =  this.$basePath + this.part_no + '.jpg' ;  
            return this.productImage ;             
        },

        async fetchData(product_id) {  
                this.dataLoading = "Fetching product details  ...";
                
                const productID = { product_ct_id : product_id };
                axios.post('/api/IncompleteProductDetails', productID )
                .then((response) => {
                
                    this.product = response.data.product ;
                    this.dataLoading = '';
                    this.product_ct_id = this.product[0].product_ct_id;
                    this.part_no = this.product[0].part_no;
                    this.productNameTally = this.product[0].product_name_tally;
                    this.productNameCustomer = this.product[0].product_name_customer;
                    this.productSizeMM =  this.product[0].product_size_mm;
                    this.productSizeInches =  this.product[0].product_size_inches;
                    this.productCategory = this.product[0].primary_category;
                    this.productType = this.product[0].product_type;
                    this.finishType = this.product[0].finish;
                    this.item_per_box =  this.product[0].item_per_box;
                    this.sqr_ft_per_box =  this.product[0].sqr_ft_per_box;
                    this.display_status = this.product[0].display_status;
                    this.is_image = this.product[0].is_image;
                    console.log(this.product[0].part_no);
                
                });
        }, 
        
      
       
           
    },

    mounted() {
           this.backLink = 'eolproducts';
           this.fetchData(this.$route.params.id);

    }

};
</script>