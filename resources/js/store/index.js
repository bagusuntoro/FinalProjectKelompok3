import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    instructions: [],
    detail: [],
    index: '637e0fa0c366363b00026d59'
  },
  getters: {
    // get all instruction
    getInstruction: state => state.instructions,

    // index for show detail instruction
    getDetail: state => state.detail
  },

  mutations: {
    SET_DATA(state, index) {
      state.index = index;
    },

    // for detail instruction
    setDetail: (state, data) => {
      state.detail = data
    },
  },

  actions: {
    // saveData(context, index) {
    //   context.commit('SET_DATA', index)
    // },

    // api for detail
    async showDetail({ commit }) {
      try {
        let response = await axios.get(`/api/instruction/${this.state.index}`)
        commit('setDetail', response.data.data)
        // console.log(response.data.data)
      } catch (error) {
        console.error(error)
      }
    },

  },

})