import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
Vue.use(Vuex)
axios.defaults.baseURL = 'http://127.0.0.1:8000/api'

export default new Vuex.Store({
    state: {
      user: null
    },
  
    mutations: {
      setUserData (state, userData) {
        state.user = userData
        localStorage.setItem('user', JSON.stringify(userData))
        axios.defaults.headers.common['Authorization'] = `Bearer ${userData.token}`
        axios.defaults.headers['Content-Type']  = 'multipart/form-data'
      },
  
      clearUserData () {
        localStorage.removeItem('user')
        localStorage.removeItem('profile')
        location.reload()
      },
      setUserProfile(state, userProfile){
        state.profile = userProfile
        axios.defaults.headers['Content-Type']  = 'multipart/form-data'
        localStorage.setItem('profile', JSON.stringify(userProfile))
        
      }
    },
    created () { this.setup() },
  
   
    actions: {
      login ({ commit }, credentials) {
        return axios
          .post('/login', credentials)
          .then(({ data }) => {
            commit('setUserData', data)
          })
      },
      register ({ commit }, userInfo) {
        return axios
          .post('/register', userInfo)
          .then(({ data }) => {
            // commit('registerData', data)
          })
      },
  
      logout ({ commit }) {
        commit('clearUserData')
      },
      profile ({ commit }, credentialss) {
        return axios
          .post('/profile', credentialss)
          .then(({ data }) => {
            commit('setUserProfile', data)
          })
      },
    },
  
    getters: {
      isLogged: state => !!state.user
    }
  })
  