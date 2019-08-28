require('./bootstrap');

import Vue from 'vue';
import Routes from  '../js/routes.js';
import VueLazyload from 'vue-lazyload';
import main from "./components/Main.vue";

Vue.use(VueLazyload);

const app = new Vue({
    el: '#app',
    router: Routes,
    render: h => h(main),
});

export default app;
