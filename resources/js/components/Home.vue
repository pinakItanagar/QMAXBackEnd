<script setup>
    import {  ref } from "vue" ;
    import { useRouter } from 'vue-router';
    import axios from 'axios';
    import store from './../store';
    const router = useRouter();
    const el = document.body;
    el.classList.remove("sidebar-mini") ;
    el.classList.add("login-page");
   // const login_page_logo = ref('resources/images/qmax.png');

</script>

<style>

    #overlay {
        position: fixed; /* Sit on top of the page content */
        display: none; /* Hidden by default */
        width: 100%; /* Full width (cover the whole page) */
        height: 100%; /* Full height (cover the whole page) */
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.5); /* Black background with opacity */
        z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
        cursor: pointer; /* Add a pointer on hover */
    }

</style>


<template>
     <p>&nbsp;</p>
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>QMAX</b> WebAdmin</a>
         
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <img :src="getimage()" class="img-fluid" style="width: 300px; height: auto;">
                <p class="login-box-msg">Sign in to start your session</p>
                <form v-on:submit.prevent="submitForm">
                    <div class="input-group mb-3">
                        <input
                            type="email"
                            v-model="userEmail"
                            class="form-control"
                            placeholder="Email"
                            @focus="errorMessage = ''"
                        />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input
                            type="password"
                            v-model="userPassword"
                            class="form-control"
                            placeholder="Password"
                            @focus="errorMessage = ''"
                        />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                           
                        </div>

                        <div class="col-4">
                            <button type="submit"  class="btn btn-primary btn-block" >
                                Sign In
                            </button>
                        </div>
                    </div>
                </form>
              
                <p class="mb-1">
                    <b>{{ errorMessage }}</b>
                    <!--  <a href="forgot-password.html">I forgot my password</a> -->
                </p>
              
            </div>
        </div>
    </div>
</template>

<script >

export default {
    name: 'PostFormAxios',
    data() {
        return {
            userEmail: '',
            userPassword: '',
            errorMessage: '',
        };
    },

    created() {
        this.clearSession();
    },

  
    
    methods:{
       
        clearSession() {
            store.dispatch('updateAppUserName', '' );
            store.dispatch('updateAppLoginState', false );
            store.dispatch('updateAppUserEmail', '' );
        },
       
        
        submitForm() {
            axios.post('/UserVerify', {
                userEmail : this.userEmail,
                userPassword: this.userPassword
                })
                 .then((res) => {
                     this.userEmail = '';
                     this.userPassword = '';
                     //Perform Success Action
                     console.log('Response Status ' + res.data.responseStatus);
                     if(parseInt(res.data.responseStatus) === 1) {
                        console.log("USER EMAIL : " + res.data.userEmail);
                        store.dispatch('updateAppUserName', res.data.userName );
                        store.dispatch('updateAppLoginState', true );
                        store.dispatch('updateAppUserEmail', res.data.userEmail );
                        this.$router.replace({ name: 'dashboard', params: { username: res.data.userID } })
                        // router.replace({ name: "dashboard" });
                     } else {
                        this.errorMessage = res.data.msg;
                     }
                 })
                 .catch((error) => {
                     this.userEmail = '';
                     this.userPassword = '';
                     // error.response.status Check status code
                 }).finally(() => {
                     //this.userEmail = '';
                     //this.userPassword = '';
                     //Perform action in always
                 });
        },

         getimage() {
                return  'images/qmax.png';
         }

    }

};
</script>
