require( './bootstrap' );

window.Vue = require( 'vue' )
import DataTable from 'laravel-vue-datatable';
import VueRouter from "vue-router";
import routes    from "./routes";

Vue.use( VueRouter );
Vue.use( DataTable );

const app = new Vue( {
    el    : "#app",
    router: new VueRouter( routes )
} );
