import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    instructions: [],
    search: ""
  },
  getters: {
    getInstruction: state => state.instructions
  },
  actions: {
    // show data instruction
    // async showData({ commit }) {
    //   try {
    //     let response = await axios.get("/api/instruction/")
    //     commit('setData', response.data.data)
    //     // console.log(response)
    //   } catch (error) {
    //     console.error(error)
    //   }
    // },

    async fetchData() {
      if (this.search.length === 0) {
        // Jika input kosong, ambil data dari API show
        const response = await axios.get("/api/instruction/");
        // this.items = response.data.data;
        commit('setData', response.data.data)
      } else {
        // Jika input tidak kosong, ambil data dari API search
        const response = await axios.get("/api/instruction/search/", {
          params: {
            key: this.search,
          },
        });
        // this.items = response.data.data;
        commit('setData', response.data.data)
      }
    },





    addSearch(context, payload) {
      context.commit('ADD_SEARCH', payload)
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
    },
    ADD_SEARCH(state, payload) {
      state.search.push(payload)
    }
  },
})