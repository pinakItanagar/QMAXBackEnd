<script setup>

   import axios from 'axios' ;
   import $ from "jquery";
   import { onMounted, ref  } from 'vue';
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
                            <h1 class="m-0">Generate/Print QR Code for Active Products</h1>
                        </div>
                    
                    </div>
                </div>
            </div>


            <div class="content">
                <div class="container-fluid">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">Active Product List in App</h3>
                        </div>

                        <div class="card-body">
                            <b> {{ dataLoading }} </b>
                            <table class="table table-bordered responsive nowrap" id="datatable" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">Part No</th>
                                        <th>Product Name(as per Tally)</th>
                                        <th>Image</th>
                                        <th align="center">Select ALL   <input type="checkbox" v-model="gen_qrcode_all" placeholder="Check box"  @click="updateAllGenerateQRCode()"   > <br><button type="button" class="btn btn-success" @click="generateQRCode()"  >Generate QR Code</button></th>
                                        <th align="center">Select All   <input type="checkbox" v-model="prn_qrcode_all" placeholder="Check box"  @click="updateAllPrintQRCode()"   > <br><button type="button" class="btn btn-success" @click="printQRCode()" >Print QR Code</button></th>
                                       
                                    
                                    </tr>
                                </thead>

                                <tbody >

                                    <tr v-for="product in products" :key="product.product_ct_id ">
                                        <td>{{ product.part_no }} </td>
                                        <td>{{ product.product_name_tally }} <br> Type : {{ product.product_type }} </td>
                                        <td>
                                            <img v-bind:src="getImage(product.part_no)" style="width:80px; height: auto" >
                                        </td>


                                        <td>
                                            <input type="checkbox"  :id="'checkbox_' + product.part_no"  @click="checkCheckbox(product.part_no)" class="form-control" placeholder="Check box" v-model="genQR[product.part_no]"     >
                                        </td>

                                        <td>
                                            <input type="checkbox" :name="'prn_'+product.part_no"  class="form-control" placeholder="Check box" @click="checkCheckboxPrn(product.part_no)"  v-model="prnQR[product.part_no]"   >
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
                products: [],
                slno : 1,
                dataLoading : '',
                gen_qrcode_all : false,
                prn_qrcode_all : false,
                isChecked: false,
                genQR: [],
                prnQR: [] 

            }
        },

     
        methods: {
            setPageReferrer(page_name) {
                store.dispatch('updateInterComponentReferer', page_name);
            },
           
            incrementIndex(key) {
                //console.log(key);
                sNum = sNum + key;
                return this.slno = sNum;
            },

            getImage(part_no) {
                //let timestamp = new Date().getTime();
                //return "http://mis.qmaxonline.com:8080/uploads/" + part_no + ".jpg" + '?cache=' + timestamp; 
                return "http://mis.qmaxonline.com:8080/uploads/" + part_no + ".jpg" ;
            },


            async fetchData() {  
                this.dataLoading = "Fetching all active products in App ...";
                axios.get('/api/activeproductsinapp')
               
                .then((response) => {
                    this.slno = 1;    
                    this.products = response.data.products ;
                    this.addCheckBox(response.data.products);
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
                })
            },  


            generateQRCode() { 
                let productList = [] 
                for (let i = 0; i < this.products.length; i++) {
                     if( this.genQR[this.products[i].part_no] == true) {
                        productList.push( this.products[i].part_no );
                     }
                 }

                 
                 const formData = new FormData();
                
                 formData.append('productList', productList);
                 //axios.post('/api/generateQR', formData, { headers} )
                 axios.post('http://127.0.0.1/qmax/webadmin/scripts/generateQR.php', formData)
                 .then((response) => {
                    console.log(response.data.op_status);
                    console.log(response.data.response_status);
                 });

            },


            printQRCode() { 
                let productList = [] 
                for (let i = 0; i < this.products.length; i++) {
                     if( this.prnQR[this.products[i].part_no] == true) {
                        let product = this.products[i].part_no + '###' +  this.products[i].product_name_customer;
                        productList.push( product );
                     }
                 }

                 
                 const formData = new FormData();
                
                 formData.append('productList', productList);
                 axios.post('/api/printQR', formData)
                 .then((response) => {
                    console.log(response.data.op_status);
                    console.log(response.data.response_status);
                    if(response.data.op_status == true) {
                        let url = "http://127.0.0.1:8000/downloads/" + response.data.response_status;
                        window.open(url, '_blank'); 
                    }
                 });

            },
            
            addCheckBox(products) {
                for (let i = 0; i < products.length; i++) {

                    if(products[i].is_qrcode == '1') {
                        this.genQR[products[i].part_no] = true;
                    } else {
                        this.genQR[products[i].part_no] = false;
                    }

                    this.prnQR[products[i].part_no] = false;
                }

            },

            updateAllGenerateQRCode() {
                if(this.gen_qrcode_all  == false) {
                    for (let i = 0; i < this.products.length; i++) {
                        this.genQR[this.products[i].part_no] = true;
                    }
                } else {
                    for (let i = 0; i < this.products.length; i++) {
                        this.genQR[this.products[i].part_no] = false;
                    }
                }
            },


            updateAllPrintQRCode() {

                if(this.prn_qrcode_all  == false) {
                    for (let i = 0; i < this.products.length; i++) {
                        this.prnQR[this.products[i].part_no] = true;
                    }
                } else {
                    for (let i = 0; i < this.products.length; i++) {
                        this.prnQR[this.products[i].part_no] = false;
                    }
                }
            },
            
            checkCheckbox(partNo) {
            
                if(this.genQR[partNo] === true) {
                    this.genQR[partNo] = false;
                } else {
                    this.genQR[partNo] = true; 
                }
             
                
            },

            checkCheckboxPrn(partNo) {
            
                if(this.prnQR[partNo] === true) {
                    this.prnQR[partNo] = false;
                } else {
                    this.prnQR[partNo] = true; 
                }

            }



        },
        mounted() {
          this.fetchData();
        },


    };
</script>