import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    instruction: [
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
      {
        instructionId: "001",
        linkTo: "example link",
        instructionType: "tes",
        assignedVendor: "tes",
        attentionOf: "tess",
        quotationNo: "tess",
        customerPo: "tess",
        status: "completed",
      },
      {
        instructionId: "001",
        linkTo: "example link",
        instructionType: "tes",
        assignedVendor: "tes",
        attentionOf: "tess",
        quotationNo: "tess",
        customerPo: "tess",
        status: "completed",
      },
      {
        instructionId: "001",
        linkTo: "example link",
        instructionType: "tes",
        assignedVendor: "tes",
        attentionOf: "tess",
        quotationNo: "tess",
        customerPo: "tess",
        status: "delete",
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
      return state.instruction
    }
  },
  mutations: {

  },
  actions: {

  },
  modules: {

  }
})