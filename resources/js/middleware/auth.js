import store from "../store";

export default function auth({next, router}) {
    console.log("Test Middleware" );
    /*
    if(store.getters.getUserName == '' ) {
        console.log("Test");
        return next({ name : 'home' });
    }*/
    return next();
}