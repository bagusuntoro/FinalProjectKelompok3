/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import store from './store';
import $ from 'jquery';

require("./bootstrap");

window.Vue = require("vue").default;
import Vue from "vue";
import router from "./router";



// for display instruction in table
Vue.component('instruction-component', require('./components/InstructionComponent.vue').default);
Vue.component('open-instruction', require('./components/OpenInstruction.vue').default);
Vue.component('completed-instruction', require('./components/CompletedInstruction.vue').default);


// for logistic instruction
Vue.component('logistic-instruction', require('./components/logistic/LogisticInstruction.vue').default);





// vendor invoice
// Vue.component('vendor-invoice', require('./components/VendorInvoice.vue').default);









// modify
Vue.component('logistic-instruction', require('./components/detailberil.vue').default);
Vue.component('table-component', require('./components/tabelberil.vue').default);
Vue.component('service-instruction', require('./components/DetailTrisna.vue').default);



const app = new Vue({
  el: "#app",
  router,
  store
});
