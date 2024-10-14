import Dashboard from './components/Dashboard.vue' ;
import Dealers from './components/Dealers.vue';
import Dealerdetails from './components/Dealerdetails.vue';
import Dealersnongst from './components/Dealersnongst.vue';
import Guwahatidealers from './components/Guwahatidealers.vue';
import Outsideguwahati from './components/Outsideguwahati.vue';
import Orders from './components/Orders.vue';
import Confirmedorders from './components/Confirmedorders.vue';
import Holdedorders from './components/Holdedorders.vue';
import Rejectedorders from './components/Rejectedorders.vue';
import Home from './components/Home.vue';
import Products from './components/Products.vue';
import Incompleteproducts from './components/IncompleteProducts.vue';
import Incompleteproductdetails from './components/Incompleteproductdetails.vue';
import Productdetails from './components/Productdetails.vue';
import Productdetailsview from './components/Productdetailsview.vue';
import Orderdetails from './components/Orderdetails.vue';
import Orderdetailsview from './components/Orderdetailsview.vue';
import Activeproducts from './components/Activeproducts.vue';
import Disabledproductsinapp from './components/Disabledproductsinapp.vue'
import Eolproducts from './components/Eolproducts.vue';
import AppuserlogUnique from './components/AppuserlogUnique.vue';
import Productqr from './components/Productqr.vue';
import store from './store';


export default [
 
    {
        path : '/',
        redirect: '/home'
    },

    {
        path : '/home',
        name : 'home',
        component: Home,
      
    },
  
    {
        path : '/admin/dashboard',
        name : 'dashboard',
        component: Dashboard ,
        beforeEnter : (to, from, next) => {
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
    },

    {
        path : '/admin/dealerdetails/:id',
        name : 'dealerdetails',
        component: Dealerdetails,
       
        beforeEnter : (to, from, next) => {
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
    },


    {
        path : '/admin/dealers',
        name : 'dealers',
        component: Dealers,
       
        beforeEnter : (to, from, next) => {
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
    },

   

    {
        path : '/admin/dealersnongst',
        name : 'dealersnongst',
        component: Dealersnongst,
       
        beforeEnter : (to, from, next) => {
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
    },


    {
        path : '/admin/guwahatidealers',
        name : 'guwahatidealers',
        component: Guwahatidealers,
       
        beforeEnter : (to, from, next) => {
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
    },


    {
        path : '/admin/outsideguwahati',
        name : 'outsideguwahati',
        component: Outsideguwahati,
       
        beforeEnter : (to, from, next) => {
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
    },


    {
        path : '/admin/appuniqueuserlog',
        name : 'appuniqueuserlog',
        component: AppuserlogUnique,
       
        beforeEnter : (to, from, next) => {
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
    },

    {
        path : '/admin/products',
        name : 'products',
        component: Products,
      
        beforeEnter : (to, from, next) => {
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
    },

    {
        path : '/admin/incompleteproducts',
        name : 'incompleteproducts',
        component: Incompleteproducts,
    
         beforeEnter : (to, from, next) => {
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
    },

    {
        path : '/admin/incompleteproductdetails/:id',
        name : 'incompleteproductdetails',
        component: Incompleteproductdetails,
    
        beforeEnter : (to, from, next) => {
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
    },


    {
        path : '/admin/productdetails/:id',
        name : 'productdetails',
        component: Productdetails,
    
        beforeEnter : (to, from, next) => {
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
    },

    {
        path : '/admin/productdetailsview/:id',
        name : 'productdetailsview',
        component: Productdetailsview,
    
        beforeEnter : (to, from, next) => {
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
    },

    {
        path : '/admin/activeproducts',
        name : 'activeproducts',
        component: Activeproducts,
       
        beforeEnter : (to, from, next) => {
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
    },


    {
        path : '/admin/productqr',
        name : 'productqr',
        component: Productqr,
       
        beforeEnter : (to, from, next) => {
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
    },

    {
        path : '/admin/disabledproductsinapp',
        name : 'disabledproductsinapp',
        component: Disabledproductsinapp,
       
        beforeEnter : (to, from, next) => {
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
    },

    {
        path : '/admin/eolproducts',
        name : 'eolproducts',
        component: Eolproducts,
       
        beforeEnter : (to, from, next) => {
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
    },

    {
        path : '/admin/orders',
        name : 'orders',
        component: Orders,
      
        beforeEnter : (to, from, next) => {
            console.log(store.getters.getUserName);
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
       
    },

    {
        path : '/admin/confirmedorders',
        name : 'confirmedorders',
        component: Confirmedorders,
      
        beforeEnter : (to, from, next) => {
            console.log(store.getters.getUserName);
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
       
    },


    {
        path : '/admin/holdedorders',
        name : 'holdedorders',
        component: Holdedorders,
      
        beforeEnter : (to, from, next) => {
            console.log(store.getters.getUserName);
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
       
    },

    {
        path : '/admin/rejectedorders',
        name : 'rejectedorders',
        component: Rejectedorders,
      
        beforeEnter : (to, from, next) => {
            console.log(store.getters.getUserName);
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
       
    },


    {
        path : '/admin/orderdetails/:id',
        name : 'orderdetails',
        component: Orderdetails,
      
        beforeEnter : (to, from, next) => {
            
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
      

       
    },

    {
        path : '/admin/orderdetailsview/:id',
        name : 'orderdetailsview',
        component: Orderdetailsview,
      
        beforeEnter : (to, from, next) => {
            
            if(store.getters.getUserName == '' ) {
                return next({ name : 'home' });
            } else  {
               return next();
            }
        }
      

       
    }
]