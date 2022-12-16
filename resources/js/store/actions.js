import axios from 'axios';

export default {
  fetchData({ commit }) {
    axios.get('/api/instruction/')
      .then((response) => {
        commit('SET_DATA', response.data);
      });
    console.log(response)
  },
};
