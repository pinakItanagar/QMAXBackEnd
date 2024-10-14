import './bootstrap';
import 'admin-lte/plugins/jquery/jquery.min.js';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'datatables.net-dt/js/dataTables.dataTables';
import 'datatables.net-responsive/js/dataTables.responsive.js';
import 'datatables.net-dt/css/jquery.dataTables.min.css';

/*
import 'admin-lte/plugins/datatables/jquery.dataTables.min.js';
import 'admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js';
import 'admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js';
import 'admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js';
import 'admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js';
import 'admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js';
*/

import 'admin-lte/dist/js/adminlte.min.js';



//import Vue from 'vue';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import { createRouter, createWebHistory } from 'vue-router';
import Routes from './routes.js' ;
import store from './store';



const app = createApp({});


//app.config.globalProperties.$appLogo  = 'http://localhost:8000/images/qmax.png' ;

app.config.globalProperties.$appLogo  =  'http://' + location.host + '/images/qmax.png' ;
app.config.globalProperties.$basePath  =  'http://' + location.host + '/uploads/' ;





const router  = createRouter({
    routes : Routes,
    history : createWebHistory()
});




//app.use(vuetify);
app.use(router);
app.use(store).mount('#app');