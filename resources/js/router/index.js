import Vue from "vue";
import router from "vue-router";
Vue.use(router);

import instruction from "../components/InstructionComponent.vue";
import logistic from "../components/detailberil.vue";
import table from "../components/tabelberil.vue";
import vendor from "../components/VendorInvoice.vue";
import service from "../components/DetailTrisna.vue";

const routes = [
  {
    path: "/",
    component: instruction,
    name: instruction,
  },
  {
    path: "/logistic",
    component: logistic,
    name: logistic,
  },
  {
    path: "/service",
    component: service,
    name: service,
  },
  {
    path: "/table",
    component: table,
    name: table,
  },
  {
    path: "/vendor",
    component: vendor,
    name: vendor,
  }
];

export default new router({
  mode: "history",
  routes,
});
