import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    instructions: []
  },
  getters: {
    getInstruction: state => state.instructions
  },
  actions: {
    // show data instruction
    async showData({ commit }) {
      try {
        let response = await axios.get("/api/instruction/")
        commit('setData', response.data.data)
        // console.log(response)
      } catch (error) {
        console.error(error)
      }
    },

    // add data
    // async showData({ commit }) {
    //   try {
    //     let response = await axios.post("/api/instruction/add/")
    //     commit('setData', response.data.data)
    //     console.log(response)
    //   } catch (error) {
    //     console.error(error)
    //   }
    // }
  },
  mutations: {
    setData: (state, data) => {
      state.instructions = data
    }
  },
})