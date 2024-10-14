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
                         <div class="col-md-1 col-lg-1 col-sm-8 col-xs-12">&nbsp;</div>
                         <div class="col-md-10 col-lg-10 col-sm-8 col-xs-12">
                             <div class="card card-primary">
 
                                 <div class="card-header">
                                     <h3 class="card-title"><b>Order No # {{ order_no }}</b></h3>
                                 </div>
                                 
                                 <form v-on:submit.prevent="submitForm">
 
                                     <div class="card-body">
                                         <b> {{ dataLoading }} </b>

                                        
                                         <div class="row">

                                           

                                            <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3 ">

                                                <div class="form-group ">
                                                    <label >Order Date / Time</label>
                                                    <input type="text" class="form-control" v-model="order_date" placeholder="Enter dealer city." disabled   >
                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-xs-12 col-md-9 col-lg-9">

                                                <div class="form-group ">
                                                    <label >Dealer Name</label>
                                                    <input type="text" class="form-control" v-model="dealer_name" placeholder="Enter dealer name" disabled   >
                                                </div>
                                                
                                            </div>

                                         </div>

                                         <div class="row">

                                            <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 ">

                                                <div class="form-group ">
                                                    <label >Dealer City</label>
                                                    <input type="text" class="form-control" v-model="cityName" placeholder="Enter dealer city." disabled   >
                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">

                                                <div class="form-group ">
                                                    <label >Dealer Mobile</label>
                                                    <input type="text" class="form-control" v-model="dealer_phone" placeholder="Enter dealer phone" disabled   >
                                                </div>
                                                
                                            </div>


                                            <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">

                                                <div class="form-group ">
                                                    <label >Dealer GST</label>
                                                    <input type="text" class="form-control" v-model="gstNo" placeholder="Enter dealer GST no" disabled   >
                                                </div>

                                            </div>

                                        </div>

                                      



                                         <div class="row">

                                            <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3 ">

                                                <div class="form-group ">
                                                    <label >Part No</label>
                                                    <input type="text" class="form-control" v-model="part_no" placeholder="Enter product part no" disabled   >
                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-xs-12 col-md-9 col-lg-9">

                                                <div class="form-group ">
                                                    <label >Product Name (As per Tally)</label>
                                                    <input type="text" class="form-control" v-model="productNameTally" placeholder="Enter product name as per tally" disabled   >
                                                </div>
                                                
                                            </div>

                                        </div>


                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 ">
                                                <div class="form-group ">
                                                    <label >Box Required</label>
                                                    <input type="text" class="form-control" v-model="box_required" placeholder="Enter product part no" disabled   >
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 ">
                                                <div class="form-group ">
                                                    <label >Product Size (Inches)</label>
                                                    <input type="text" class="form-control" v-model="productSizeInches" placeholder="Enter product part no" disabled   >
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 ">
                                                <div class="form-group ">
                                                    <label >Product Size (MM)</label>
                                                    <input type="text" class="form-control" v-model="productSizeMM" placeholder="Enter product part no" disabled   >
                                                </div>
                                            </div>

                                        </div>


                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 ">
                                                <div class="form-group ">
                                                    <label >Product Category</label>
                                                    <input type="text" class="form-control" v-model="productCategory" placeholder="Enter product part no" disabled   >
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 ">
                                                <div class="form-group ">
                                                    <label >Product Type</label>
                                                    <input type="text" class="form-control" v-model="productType" placeholder="Enter product part no" disabled   >
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 ">
                                                <div class="form-group ">
                                                    <label >Finish Type</label>
                                                    <input type="text" class="form-control" v-model="finishType" placeholder="Enter product part no" disabled   >
                                                </div>
                                            </div>

                                        </div>
                                        

                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 ">

                                                <div class="row">
                                                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 ">
                                                        <label for="exampleInputEmail1">Order Status</label>
                                                        <select class="form-control"   @change="onChangeStatus($event)"  v-model="order_status" required >
                                                            <option value="" >Select Order Status</option>
                                                            <option v-bind:key="option.value"  v-for="option in optionsOrderStatus" v-bind:value="option.value"    > 
                                                                {{ option.text }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row" v-if="order_deviation_state === 1">
                                                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 ">
                                                        <label for="exampleInputEmail1">Updated required boxes </label>
                                                        <input type="text" class="form-control"  v-model="box_required_updated" placeholder="Updated required boxes" required    >
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 ">
                                                        <label for="exampleInputEmail1">Remark </label>
                                                        <input type="text" class="form-control"  v-model="remark" placeholder="Enter Remark"  required   >
                                                    </div>
                                                </div>

                                                <div class="row" v-if="order_status_code == '4'">
                                                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 ">
                                                        <label for="exampleInputEmail1">Rejected By  </label>
                                                        <input type="text" class="form-control"  v-model="rejectedby" placeholder="Enter Remark"  disabled   >
                                                    </div>
                                                </div>

                                                <div class="row" v-if="order_status_code == '3'">
                                                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 ">
                                                        <label for="exampleInputEmail1">On holded By  </label>
                                                        <input type="text" class="form-control"  v-model="rejectedby" placeholder="Enter Remark"  disabled   >
                                                    </div>
                                                </div>

                                                <div class="row" v-if="order_status_code == '2'">
                                                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 ">
                                                        <label for="exampleInputEmail1">Confirmed By  </label>
                                                        <input type="text" class="form-control"  v-model="rejectedby" placeholder="Enter Remark"  disabled   >
                                                    </div>
                                                </div>

                                                <div class="row" v-if="order_status_code == '1'">
                                                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 ">
                                                        <label for="exampleInputEmail1">Confirmed By  </label>
                                                        <input type="text" class="form-control"  v-model="rejectedby" placeholder="Enter Remark"  disabled   >
                                                    </div>
                                                </div>

                                                <div class="row" v-if="order_status_code != '0'">
                                                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 ">
                                                        <label for="exampleInputEmail1">Upated on </label>
                                                        <input type="text" class="form-control"  v-model="updatedOn" placeholder="Enter Remark"  disabled   >
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 ">
                                                <img :src="getProductImage()" style="width: 300px; height: auto;" > 
                                            </div>
                                        </div>


                                        <div class="row" v-if="error_message != ''">
                                            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 ">
                                                 <b>* Error : {{ error_message }}</b>
                                            </div>
                                        </div>
                                        
 
                                     </div>

                                     <div class="card-footer">
                                       <button type="button" class="btn btn-primary"  @click="submitData()" >Update Order Status</button>
                                    </div>
 
                                 </form>
                             </div>
                         </div>  
                         <div class="col-md-1 col-lg-1 col-sm-8 col-xs-12">&nbsp;</div>    
                     </div> 
                     
                 </div>
             </div>
         </div>
          <AppFooter></AppFooter>   
    
</template>

<script >
import axios from 'axios' ;
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
                 order: '',
                 order_no: '',
                 dealer_name : '',
                 cityName :'',
                 gstNo : '',
                 dealer_phone : '',
                 order_date: '',
                 box_required: '',
                 box_required_updated: '',
                 productNameTally : '',
                 productNameCustomer : '',
                 productSizeMM : '',
                 productSizeInches : '',
                 productCategory : '',
                 productType : '',
                 finishType : '',
                 item_per_box : '',
                 sqr_ft_per_box : '',
                 order_status : '',
                 productImage : null,
                 part_no : '',
                 product_ct_id : '',
                 response_message : '',
                 response_status : '',
                 is_image : '',
                 backLink : '',
                 error_message : '',
                 remark : '',
                 order_deviation_state : null,
                 user_email: '',
                 order_status_text: '',
                 remark: '',
                 order_status_code: '',
                 rejectedby: '',
                 updatedOn : '',
                
                 
                 optionsOrderStatus: [
                     { text: 'CONFIRMED', value: 'CONFIRMED' },
                     { text: 'CONFIRMED WITH QTY DEVIATION', value: 'CONFIRMED_WITH_DEVIATION' },
                     { text: 'HOLD', value: 'HOLD' },
                     { text: 'REJECT', value: 'REJECT' }
                 ],
                 dataLoading : ''
             }

    },

    methods : {
        goBackToPage() {
            this.$router.replace({ name: this.backLink });
        },

        onChangeStatus(event) {
         
            this.error_message = '';
            if(event.target.value == 'CONFIRMED_WITH_DEVIATION') {
                this.order_deviation_state = 1 ;
            } else {
                this.order_deviation_state = 0 ;
            }
        },


       

        getProductImage() {
            return  this.$basePath + this.part_no + '.jpg' ;               
        },

        async fetchData(order_no) {  
                this.order_deviation_state = 0 ;
                this.error_message = '';
                this.dataLoading = "Fetching order details  ...";
               
                const payload = { order_number : order_no };
                axios.post('/api/vieworder', payload )
                .then((response) => {
                  //  alert(response.data.order[0].part_no);
                
                    this.order = response.data.order ;
                    this.dataLoading = '';
                    this.part_no = this.order[0].part_no;
                    this.order_no = this.order[0].order_number;
                    this.dealer_name = this.order[0].firmName;
                    this.cityName = this.order[0].cityName;
                    this.gstNo = this.order[0].gstNo;
                    this.dealer_phone = this.order[0].dealer_phone;
                    this.order_date = this.order[0].order_date;
                    this.box_required = this.order[0].box_required;
                    this.productNameTally = this.order[0].product_name_tally;
                    this.productNameCustomer = this.order[0].product_name_customer;
                    this.productSizeMM =  this.order[0].product_size_mm;
                    this.productSizeInches =  this.order[0].product_size_inches;
                    this.productCategory = this.order[0].primary_category;
                    this.productType = this.order[0].product_type;
                    this.finishType = this.order[0].finish;
                    this.item_per_box =  this.order[0].item_per_box;
                    this.sqr_ft_per_box =  this.order[0].sqr_ft_per_box;
                    this.display_status = this.order[0].display_status;
                    this.is_image = this.order[0].is_image;
                    this.order_status = this.order[0].order_status_text;
                    this.order_status_text = this.order[0].order_status_text;
                    this.remark = this.order[0].order_remark;
                    this.rejectedby = this.order[0].user_email;
                    this.order_status_code = this.order[0].order_status;
                    this.updatedOn = this.order[0].updated_at;
                    this.box_required_updated = this.order[0].box_required_updated;

                    if(this.order_status_code == '2') {
                        this.order_deviation_state = 1;
                    } else if(this.order_status_code == '0') {
                        this.order_status = ''; 
                    }
                   
                
                });
        },    


        async postOrderStatus() {

            if(this.order_deviation_state == 0) {
               this.box_required_updated = '' ;
            }

            const payload = { 
                                order_number : this.order_no, 
                                box_required_updated: this.box_required_updated,
                                remark : this.remark,
                                order_status : this.order_status,
                                user_email : this.user_email
                            };
            axios.post('/api/updateorder', payload )
                .then((response) => {
                    if(parseInt(response.data.responseStatus) === 1) {
                        store.dispatch('updateAppMessage', 'Successfully updated the order status');
                        this.$router.replace({ name: this.backLink });
                    }             
                });


        }, 

        submitData() {

            if(this.order_status == "") {
                this.error_message = "Order status must be selected";
            } else if((this.order_deviation_state == 1 ) && (this.box_required_updated == '')) {
                this.error_message = "Updated required boxes infomation required";
            } else if (this.remark == '') {
                this.error_message = "Remarks required !";
            } else {
                this.error_message = "";
                this. postOrderStatus();
            }
        }
       

    },

    mounted() {
           
           if(store.getters.getInterComponentReferer == 'ORDER_LIST') {
             this.backLink = 'orders';
           } else if(store.getters.getInterComponentReferer == 'HOLDED_ORDER_LIST') {
             this.backLink = 'holdedorders';
           }
           this.user_email =  store.getters.getUserEmail;
           console.log('Order ID ' + this.$route.params.id) ; 
           console.log('PAGE referer ' + store.getters.getInterComponentReferer ) ; 
           console.log('USER EMAIL ' +  this.user_email ) ;
          
           this.fetchData(this.$route.params.id);

    }

};
</script>