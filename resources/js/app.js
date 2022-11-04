/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// import VueRouter from 'vue-router';
// import App from './components/App.vue';
// import Header from './components/Header.vue';
// import Data from './components/Data.vue';
import  routes  from './routes';
import BootstrapVue from 'bootstrap-vue'
import store from './store'
// Vue.use(VueRouter);
Vue.use(BootstrapVue)
// const router = new VueRouter({
//     mode: 'history',
//     routes: routes,
// });
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('header-component', require('./components/Header.vue').default);
// Vue.component('example-data', require('./components/Data.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 Vue.filter('toUSD', function (value) {
  return `$${value}`;
});
const app = new Vue({
    el: '#app',
    router: routes,
    store,
    created () {
      const userInfo = localStorage.getItem('user')
      if (userInfo) {
        const userData = JSON.parse(userInfo)
        this.$store.commit('setUserData', userData)
      }
     
      axios.interceptors.response.use(
        response => response,
        error => {
          if (error.response.status === 401) {
            this.$store.dispatch('logout')
          }
          return Promise.reject(error)
        }
      )
    },
});
// const data = new Vue({
//     el: '#data',
//     render: h => h(Data)
// });
// const header = new Vue({
//     el: '#header',
//     router: router,
//     render: h => h(Header)
// });