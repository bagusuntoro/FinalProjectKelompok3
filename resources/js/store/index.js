import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    data: [
      {
        instructionId: "001",
        linkTo: "example link",
        instructionType: "tes",
        assignedVendor: "tes",
        attentionOf: "tess",
        quotationNo: "tess",
        customerPo: "tess",
        status: "in progress",
      },
      {
        instructionId: "001",
        linkTo: "example link",
        instructionType: "tes",
        assignedVendor: "tes",
        attentionOf: "tess",
        quotationNo: "tess",
        customerPo: "tess",
        status: "in progress",
      },
    ],
  },
  getters: {
    getData(state) {
      return state.data
    }
  },
  mutations: {

  },
  actions: {

  },
  modules: {

  }
})