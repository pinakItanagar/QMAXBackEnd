<script setup>

   import axios from 'axios' ;
   import $ from "jquery";
   import { onMounted } from 'vue';
   import AppMenu from './common/AppMenu.vue';
   import AppFooter from './common/AppFooter.vue';
   
 


</script>


<template>
        <AppMenu></AppMenu>
        <div class="content-wrapper">
            
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 ">
                            <h1 class="m-0">App User Access Log   </h1>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 ">
                              <VueDatePicker v-model="date" :format="format" :max-date="new Date()"></VueDatePicker>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 ">
                            <button type="button" class="btn btn-primary"  @click="submitData()" >Get User Access Log</button>
                        </div>
                    </div>

                </div>
            </div>


            <div class="content">
                <div class="container-fluid">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">App User Access Log - Unique List - Date :{{ todayDate }}</h3>
                        </div>

                        <div class="card-body">
                            <b> {{ dataLoading }} </b>
                            <table class="table table-bordered responsive nowrap" id="datatable" width="100%" >
                                <thead>
                                    <tr>
                                        <th style="width: 10px"># ID</th>
                                        <th>Dealer Name</th>
                                        <th>Contact Name</th>
                                        <th>Device ID</th>
                                        <th>Date</th>
                                      
                                       
                                    </tr>
                                </thead>

                                <tbody >

                                    <tr v-for="dealer in dealers" :key="dealer.dealer_id">
                                        <td>{{dealer.id}}  </td>
                                        <td>{{dealer.firmName }} </td>
                                        <td>{{dealer.contactName}}</td>
                                        <td>{{dealer.userID}}</td>
                                        <td>{{dealer.login_date}}</td>
                                        
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
    import VueDatePicker from '@vuepic/vue-datepicker';
    import '@vuepic/vue-datepicker/dist/main.css'
    export default {

        components: { VueDatePicker },

       
       
        data() {
            return {
                dealers: [],
                slno : 1,
                dataLoading : '',
                todayDate : null,
                date: null
            }
        },

        methods: {

             format(date) {
                const day = date.getDate().toString().padStart(2, '0');
                const month = (date.getMonth() + 1).toString().padStart(2, '0');
                const year = date.getFullYear();
                this.todayDate = `${year}-${month}-${day}`;
                return `${year}-${month}-${day}`;        
             },
            
          
            async fetchData() {  
                
                this.dataLoading = "Fetching all app user unique access log ...";
                this.slno = 0;
                axios.post('/api/AppUserUniqueAccessLog' , {
                    login_date :  this.todayDate
                } )
                .then((response) => {
                    console.log(`This is from fetchData ${this.todayDate}`);
                    console.log(response.data.dealers);
                    this.dealers = null;
                    this.dealers = response.data.dealers ;
                    this.dataLoading = '';
                    setTimeout(() => {
                       
                        var table = $("#datatable").DataTable({
                            responsive: true,
                            paging: false,
                            info: false
                        });

                        new $.fn.dataTable.Responsive( table, {
                            
                            details: false
                        } );
                    });
                });
            },  
            
            async fetchDataByDate() {  
                
                this.dataLoading = "Fetching all app user unique access log ...";
                this.slno = 0;
                axios.post('/api/AppUserUniqueAccessLog' , {
                    login_date :  this.todayDate
                } )
                .then((response) => {
                    console.log(`This is from fetchDataByDate ${this.todayDate}`);
                    console.log(response.data.dealers);
                    this.dealers = null;
                    this.dealers = response.data.dealers ;
                    this.dataLoading = '';
                    /*
                    setTimeout(() => {
                        $('#datatable').DataTable().clear();
                        let tbl = $("#datatable").DataTable({
                            destroy: true,
                            responsive: true,
                            pageLength: 10    
                        });

                        new $.fn.dataTable.Responsive( tbl, {
                            
                            details: false
                        } );
                    });*/
                });
            } ,   

            submitData() {
                console.log(this.todayDate);
               // this.todayDate = this.date;
                this.fetchDataByDate();
            }
        },
       
        mounted() {
          this.todayDate = new Date().toISOString().slice(0, 10);
          this.date =  this.todayDate;
          //this.todayDate = "2024-04-03";
          console.log('Component mounted');
          this.fetchData();
        },

        computed: {
           
        }


    };
</script>