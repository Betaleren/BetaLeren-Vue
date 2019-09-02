require( './bootstrap');

import 'es6-promise/auto'
import axios from 'axios'
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Index from './components/Index'
import auth from './auth'
import router from './routes'
import Fragment from 'vue-fragment';
import VueLazyload from 'vue-lazyload'

Vue.use(Fragment.Plugin);
Vue.use(VueLazyload, {
    preLoad: 1.3,
    error: 'img/website/error.png',
    loading: 'img/website/loading.gif',
    attempt: 2
});

// Set Vue globally
window.Vue = Vue;

// Set Vue router
Vue.router = router;
Vue.use(VueRouter);

// Set Vue authentication
Vue.use(VueAxios, axios);
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`;
Vue.use(VueAuth, auth);

// Load Index
Vue.component('index', Index);

const app = new Vue({
    el: '#app',
    router
});
