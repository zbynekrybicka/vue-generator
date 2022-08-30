import { createStore } from 'vuex'
import axios from 'axios'
import dot from 'dot-object'

const api_url = "http://localhost:8081";
const state = {}
dot.str("preloader", false, state);
dot.str("authToken", '', state);
dot.str("user_id", null, state);
dot.str("loginForm.username", '', state);
dot.str("loginForm.password", '', state);
dot.str("registrationForm.username", '', state);
dot.str("registrationForm.firstname", '', state);
dot.str("registrationForm.lastname", '', state);
dot.str("registrationForm.password", '', state);
dot.str("page", '', state);
dot.str("comments", [], state);
dot.str("urlResult", { type: null }, state);
dot.str("videoUrl", api_url + '/video/', state);
dot.str("imageUrl", api_url + '/image/', state);
dot.str("profile.firstname", '', state);
dot.str("profile.lastname", '', state);

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
      state.user_id = parseInt(localStorage.getItem('user_id')) || null
    },
    setLoginFormUsername(state, value) {
      state.loginForm.username = value
    },
    setLoginFormPassword(state, value) {
      state.loginForm.password = value
    },
    login(state, value) {
      state.authToken = value.authToken
      state.user_id = value.user_id
      localStorage.setItem('authToken', value.authToken)
      localStorage.setItem('user_id', value.user_id)
      state.loginForm.username = ''
      state.loginForm.password = ''
    },
    authorize(state, value) {
      state.authToken = value
      localStorage.setItem('authToken', value)
    },
    setRegistrationFormUsername(state, value) {
      state.registrationForm.username = value
    },
    setRegistrationFormFirstname(state, value) {
      state.registrationForm.firstname = value
    },
    setRegistrationFormLastname(state, value) {
      state.registrationForm.lastname = value
    },
    setRegistrationFormPassword(state, value) {
      state.registrationForm.password = value
    },
    clearRegistration(state, value) {
      state.registrationForm.username = ''
      state.registrationForm.firstname = ''
      state.registrationForm.lastname = ''
      state.registrationForm.password = ''
    },
    setPage(state, value) {
      state.page = value
    },
    logout(state, value) {
      localStorage.removeItem('authToken')
      localStorage.removeItem('user_id')
      state.authToken = null
      state.user_id = null
    },
    getComments(state, value) {
      state.comments = value
    },
    insertComment(state, value) {
      state.comments.unshift(value)
    },
    showUrlResult(state, value) {
      state.urlResult = value
    },
    clearUrlResult(state, value) {
      state.urlResult = { type: null }
    },
    postLike(state, value) {
      const comment = state.comments.find(item => value.comment_id === item.id)
      comment.likes.push(value.like)
    },
    deleteLike(state, value) {
      const comment = state.comments.find(item => value.comment_id === item.id)
      const likeIndex = comment.likes.findIndex(item => value.user_id === item.user_id);
      comment.likes.splice(likeIndex, 1)
    },
    loadProfile(state, value) {
      state.profile.firstname = value.profile.firstname
      state.profile.lastname = value.profile.lastname
      state.qrCodeUrl = value.qrCodeUrl
    },
    setProfileFirstname(state, value) {
      state.profile.firstname = value
    },
    setProfileLastname(state, value) {
      state.profile.lastname = value
    },
    activateTwoFactor(state, value) {
      state.qrCodeUrl = value
    },
  },
  actions: {
    login({ commit }, value) {
      commit('showPreloader')
      axios.post(api_url + '/login',state.loginForm)
        .then(res => {
          commit('hidePreloader')
          commit('login', res.data)
        }).catch(err => {
          commit('hidePreloader')
          commit('errorMessage', err.response.data)
        })
    },
    authorize({ commit }, value) {
      commit('showPreloader')
      axios.post(api_url + '/authorize', value)
        .then(res => {
          commit('hidePreloader')
          commit('authorize', res.data)
        }).catch(err => {
          commit('hidePreloader')
          commit('errorMessage', err.response.data)
        })
    },
    registration({ commit }, value) {
      commit('showPreloader')
      axios.post(api_url + '/registration',state.registrationForm)
        .then(res => {
          commit('hidePreloader')
          commit('clearRegistration')
          commit('login', res.data)
        }).catch(err => {
          commit('hidePreloader')
          commit('errorMessage', err.response.data)
        })
    },
    getComments({ commit }, value) {
      commit('showPreloader')
      axios.get(api_url + '/comments',{headers:{Authorization: state.authToken }})
        .then(res => {
          commit('hidePreloader')
          commit('getComments', res.data)
        }).catch(err => {
          commit('hidePreloader')
          commit('errorMessage', err.response.data)
        })
    },
    insertComment({ commit }, value) {
      commit('showPreloader')
      axios.post(api_url + '/comments', value, {headers:{Authorization: state.authToken }})
        .then(res => {
          commit('hidePreloader')
          commit('insertComment', res.data)
        }).catch(err => {
          commit('hidePreloader')
          commit('errorMessage', err.response.data)
        })
    },
    detectUrl({ commit }, value) {
      commit('showPreloader')
      axios.get(api_url + '/detect-url', {params: { url: value }, headers:{Authorization: state.authToken }})
        .then(res => {
          commit('hidePreloader')
          commit('showUrlResult', res.data)
        }).catch(err => {
          commit('hidePreloader')
          commit('errorMessage', err.response.data)
        })
    },
    postLike({ commit }, value) {
      commit('showPreloader')
      axios.post(api_url + '/likes', value, {headers:{Authorization: state.authToken }})
        .then(res => {
          commit('hidePreloader')
          commit('postLike', res.data)
        }).catch(err => {
          commit('hidePreloader')
          commit('errorMessage', err.response.data)
        })
    },
    deleteLike({ commit }, value) {
      commit('showPreloader')
      axios.delete(api_url + '/likes/' + value, {headers:{Authorization: state.authToken }})
        .then(res => {
          commit('hidePreloader')
          commit('deleteLike', res.data)
        }).catch(err => {
          commit('hidePreloader')
          commit('errorMessage', err.response.data)
        })
    },
    loadProfile({ commit }, value) {
      commit('showPreloader')
      axios.get(api_url + '/profile',{headers:{Authorization: state.authToken }})
        .then(res => {
          commit('hidePreloader')
          commit('loadProfile', res.data)
        }).catch(err => {
          commit('hidePreloader')
          commit('errorMessage', err.response.data)
        })
    },
    saveProfile({ commit }, value) {
      commit('showPreloader')
      axios.put(api_url + '/profile', state.profile, {headers:{Authorization: state.authToken }})
        .then(res => {
          commit('hidePreloader')
        }).catch(err => {
          commit('hidePreloader')
          commit('errorMessage', err.response.data)
        })
    },
    activateTwoFactor({ commit }, value) {
      commit('showPreloader')
      axios.put(api_url + '/activate-two-factor', null, {headers:{Authorization: state.authToken }})
        .then(res => {
          commit('hidePreloader')
          commit('activateTwoFactor', res.data)
        }).catch(err => {
          commit('hidePreloader')
          commit('errorMessage', err.response.data)
        })
    },
  }
})
