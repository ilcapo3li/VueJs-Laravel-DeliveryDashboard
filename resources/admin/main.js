require('../js/bootstrap');
import Vue from "vue";
import store from './store/index';
import { sync } from 'vuex-router-sync';

import VueRouter from "vue-router";
import RouterPrefetch from 'vue-router-prefetch';



import BootstrapVue from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import App from "./App";

window.io = require('socket.io-client');
window.moment = require('moment-timezone');


// TIP: change to import router from "./router/starterRouter"; to start with a clean layout
import router from "./router/index";
import BlackDashboard from "./plugins/blackDashboard";
import i18n from "./i18n";
import './registerServiceWorker';
import swal from 'sweetalert';
import VeeValidate from 'vee-validate';
import toastr from 'toastr'
window.toastr = toastr

import * as VueGoogleMaps from "vue2-google-maps";

Vue.use(VueGoogleMaps, {
  load: {
    key: "AIzaSyA5sS8BonLnEpvI3x4wZYJFs9m02TV-JkM",
    libraries: "places" // necessary for places input
  }
});


import 'toastr/build/toastr.min.css';
Vue.use(BlackDashboard);
Vue.use(VueRouter);
Vue.use(RouterPrefetch);
Vue.use(BootstrapVue);
Vue.use(VeeValidate,{fieldsBagName: 'inputs'});





sync(store,router);

/* eslint-disable no-new */
window.vue=new Vue({
  router,
  store,
  i18n,
  render: h => h(App)
}).$mount("#app");
