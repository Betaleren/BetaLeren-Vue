import Vue from 'vue';
import VueRouter from 'vue-router';
import Fragment from 'vue-fragment'

Vue.use(Fragment.Plugin);
Vue.use(VueRouter);

/*
    pages
*/
import dashboard from '../js/components/general/Dashboard'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: dashboard,
            component: dashboard
        },
    ]
});

export default router;
