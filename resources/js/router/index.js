import Vue from "vue";
import router from "vue-router";
Vue.use(router);

import detail from "../components/detailberil.vue";

const routes = [
  {
    path: "/",
    component: detail,
    name: detail,
  },
];

export default new router({
  mode: "history",
  routes,
});
