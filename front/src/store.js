import { createStore } from 'vuex'
import axios from 'axios'
import dot from 'dot-object'

const api_url = "http://localhost:8081";
const state = {}
dot.str("preloader", false, state);
dot.str("authToken", '', state);
dot.str("loginForm.username", '', state);
dot.str("loginForm.password", '', state);
dot.str("page", '', state);

export default createStore({
  state,
  mutations: {
    showPreloader(state, value) {
      state.preloader = true
    },
    hidePreloader(state, value) {
      state.preloader = false
    },
    errorMessage(state, value) {
      state.errorMessage = value
    },
    hideErrorMessage(state, value) {
      state.errorMessage = ''
    },
    loadAuthToken(state, value) {
      state.authToken = localStorage.getItem('authToken') || ''
    },
    setLoginFormUsername(state, value) {
      state.loginForm.username = value
    },
    setLoginFormPassword(state, value) {
      state.loginForm.password = value
    },
    setAuthToken(state, value) {
      state.authToken = value
      localStorage.setItem('authToken', value)
      state.loginForm.username = ''
      state.loginForm.password = ''
    },
    setPage(state, value) {
      state.page = value
    },
    deleteAuthToken(state, value) {
      localStorage.removeItem('authToken')
      state.authToken = ''
    },
  },
  actions: {
    login({ commit }) {
      commit('showPreloader')
      axios.post(api_url + '/login',state.loginForm)
        .then(res => {
          commit('hidePreloader')
          commit('setAuthToken', res.data)
        }).catch(err => {
          commit('hidePreloader')
          commit('errorMessage', err.response.data)
        })
    },
  }
})
