/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;
import Vue from "vue";
import router from "./router";
import store from './store'

// import adminLte from 'admin-lte'
// import Vue from 'vue';

// Vue.use(adminLte)

// import ''

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))



// login
Vue.component('login-component', require('./components/LoginComponent.vue').default);




// for display instruction in table
Vue.component('instruction-component', require('./components/InstructionComponent.vue').default);
Vue.component('completed-instruction', require('./components/CompletedInstruction.vue').default);
Vue.component('open-instruction', require('./components/OpenInstruction.vue').default);
// vendor invoice
Vue.component('vendor-invoice', require('./components/VendorInvoice.vue').default);




// modify
Vue.component('logistic-instruction', require('./components/detailberil.vue').default);
Vue.component('table-component', require('./components/tabelberil.vue').default);
Vue.component('service-instruction', require('./components/DetailTrisna.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: "#app",
  router,
  store
});
