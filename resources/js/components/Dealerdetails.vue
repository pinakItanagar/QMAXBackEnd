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
                                    <h3 class="card-title"><b>Dealer Details</b></h3>
                                </div>

                                <div class="card-body">
                                
                                    <form v-on:submit.prevent="submitForm">
    
                                        
                                            <b> {{ dataLoading }} </b>

                                            
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12 col-md-8 col-lg-8">
                                                    <div class="form-group ">
                                                        <label >Dealer Name</label>
                                                        <input type="text" class="form-control" v-model="firmName" placeholder="Enter dealer name" disabled   >
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12 col-md-8 col-lg-8">
                                                    <div class="form-group ">
                                                        <label >Dealer Location</label>
                                                        <input type="text" class="form-control" v-model="dealerLocation" placeholder="Enter dealer name" disabled   >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12 col-md-86 col-lg-8">
                                                    <div class="form-group ">
                                                        <label >Dealer Contact Name</label>
                                                        <input type="text" class="form-control" v-model="contactName" placeholder="Enter dealer name" disabled   >
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
                                            </div>   

                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                                    <div class="form-group ">
                                                        <label >Dealer Mobile</label>
                                                        <input type="text" class="form-control" v-model="dealerMobile" placeholder="Enter dealer phone" disabled   >
                                                    </div>
                                                </div>
                                            </div> 

                                        
                                            <div class="row" v-if="gstStatus == 'GST'">
                                                <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                                    <div class="form-group ">
                                                        <label >Dealer GST NO</label>
                                                        <input type="text" class="form-control" v-model="gstNo" placeholder="Enter dealer phone" disabled   >
                                                    </div>
                                                </div>   
                                            </div>

                                            <span v-else-if="gstStatus == 'NON-GST'">

                                            <div class="row" >
                                                <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                                    <div class="form-group ">
                                                        <label >Dealer GST NO</label>
                                                        <input type="text" class="form-control" v-model="gstNo" placeholder="Enter dealer GST"    >
                                                    </div>
                                                </div>   
                                            </div>

                                            </span>

                                            

                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                                    <div class="form-group ">
                                                        <label >Dealer Email Address</label>
                                                        <input type="text" class="form-control" v-model="emailAddress" placeholder="Enter dealer Email Address"    >
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                                                    <div class="form-group ">
                                                        <label >Dealer WhatsAppNo</label>
                                                        <input type="text" class="form-control" v-model="dealerWhatsApp" placeholder="Enter dealer whatsapp phone"    >
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 ">
                                                    <label for="exampleInputEmail1">Mobile APP Registraion Status</label>
                                                    <select class="form-control"   @change="onChangeStatus($event)"  v-model="status" required >
                                                        <option v-bind:key="option.value"  v-for="option in optionsRegistrationStatus" v-bind:value="option.value"    > 
                                                            {{ option.text }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                        

                                            <div class="row" v-if="error_message != ''">
                                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 ">
                                                    <b>* Error : {{ error_message }}</b>
                                                </div>
                                            </div>

                                              <div class="row">
                                                <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4 ">
                                                  <p>&nbsp;</p>
                                                </div>
                                            </div>
                                            
    
                                           <div class="row">
                                                <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3 ">
                                                  <button type="button" class="btn btn-primary"  @click="submitData()" >Update Registration</button>
                                                </div>

                                                <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3 ">
                                                  <button type="button" class="btn btn-success"  @click="goBackToPage()" >Back to List</button>
                                                </div>
                                            </div>

                                       
                                           
    
                                    </form>

                                </div> 
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
                 dealer : '',
                 dealer_id : '',
                 firmName: '',
                 contactName : '',
                 cityName :'',
                 gstStatus : '',
                 dealerLocation : '',
                 gstNo: '',
                 emailAddress: '',
                 dealerMobile: '',
                 dealerWhatsApp : '',
                 userSetPassword : '',
                 status  : '',
                 optionsRegistrationStatus: [
                     { text: 'CONFIRMED', value: '1' },
                     { text: 'NEW', value: '0' },
                     { text: 'SUSPENDED', value: '2' },
                     { text: 'REJECTED', value: '3' }
                 ],
                 dataLoading : '',
                 backLink :'',
                 registration_status : ''
             }

    },

    methods : {

       


        goBackToPage() {
            this.$router.replace({ name: this.backLink });
        },


         onChangeStatus(event) {
            this.registration_status = event.target.value;
        },


        
      


        async fetchData(dealer_id) {  
              
                this.error_message = '';
                this.dataLoading = "Fetching dealer details  ...";
               
                const payload = { dealer_id : dealer_id };
                axios.post('/api/getdealerdetails', payload )
                .then((response) => {

                    
                    this.dealer = response.data.dealer ;
                    console.log(this.dealer.dealer_id);
                    this.dataLoading = '';
                    this.dealer_id = this.dealer.dealer_id;
                    this.firmName = this.dealer.firmName;
                    this.contactName = this.dealer.contactName;
                    this.cityName = this.dealer.cityName;
                    this.gstStatus = this.dealer.gstStatus;
                    this.dealerLocation = this.dealer.dealerLocation;
                    this.gstNo = this.dealer.gstNo;
                    this.emailAddress = this.dealer.emailAddress;
                    this.dealerMobile = this.dealer.dealerMobile;
                    this.dealerWhatsApp = this.dealer.dealerWhatsApp;
                    this.status = this.dealer.status;
                    this.registration_status = this.dealer.status;

                  
                   
                
                });
        },    


        async postDealerStatus() {
           
            let payload = "";
         
           if(this.gstStatus == 'NON-GST') {
             payload = { 
                                dealer_id : this.dealer_id, 
                                gstNo : this.gstNo,
                                emailAddress : this.emailAddress,
                                dealerWhatsApp : this.dealerWhatsApp,
                                status: this.registration_status,
                                gstStatus : this.gstStatus
                            };
           }  else {
              payload = { 
                                dealer_id : this.dealer_id, 
                                emailAddress : this.emailAddress,
                                dealerWhatsApp : this.dealerWhatsApp,
                                status: this.registration_status,
                                gstStatus : this.gstStatus
                            };

           }               
            axios.post('/api/updatedealer', payload )
                .then((response) => {
                    if(parseInt(response.data.responseStatus) === 1) {
                        store.dispatch('updateAppMessage', 'Successfully updated the dealer status');
                        this.$router.replace({ name: this.backLink });
                    }             
                });


        }, 

        submitData() {

            this.postDealerStatus();
            /*

            if(this.order_status == "") {
                this.error_message = "Order status must be selected";
            } else if((this.order_deviation_state == 1 ) && (this.box_required_updated == '')) {
                this.error_message = "Updated required boxes infomation required";
            } else if (this.remark == '') {
                this.error_message = "Remarks required !";
            } else {
                this.error_message = "";
                this.postOrderStatus();
            }*/
        }
       

    },

    mounted() {
           
           if(store.getters.getInterComponentReferer == 'GST_DEALER_LIST') {
             this.backLink = 'dealers';
           } else if(store.getters.getInterComponentReferer == 'NON_GST_DEALER_LIST') {
             this.backLink = 'dealersnongst';
           } else if(store.getters.getInterComponentReferer == 'GUWAHATI_DEALER_LIST') {  
             this.backLink = 'guwahatidealers';
           } else if(store.getters.getInterComponentReferer == 'OUTSIDE_GUWAHATI_DEALER_LIST') { 
             this.backLink = 'outsideguwahati';
           }
           this.user_email =  store.getters.getUserEmail;
           console.log('Dealer ID ' + this.$route.params.id) ; 
           console.log('PAGE referer ' + store.getters.getInterComponentReferer ) ; 
           console.log('USER EMAIL ' +  this.user_email ) ;
           console.log('BACK LINK ' +  this.backLink ) ;
          
           this.fetchData(this.$route.params.id);

    }

};
</script>