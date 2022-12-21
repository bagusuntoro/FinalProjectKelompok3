import Vue from "vue";
import router from "vue-router";
Vue.use(router);


// components
// import login from "../components/LoginComponent.vue";
import instruction from "../components/InstructionComponent.vue";
import logistic from "../components/detailberil.vue";
import table from "../components/tabelberil.vue";
import vendor from "../components/VendorInvoice.vue";
import service from "../components/DetailTrisna.vue";

// instruction
import openInstruction from "../components/OpenInstruction.vue";
import completedInstruction from "../components/CompletedInstruction.vue";

const routes = [
  // {
  //   path: "/",
  //   component: login,
  //   name: login,
  // },
  {
    path: "/open",
    component: instruction,
    children: [
      {
        path: "/open",
        component: openInstruction,
      },
      {
        path: "/completed",
        component: completedInstruction,
      },
    ],
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
