import Vue from 'vue';
import VueRouter from 'vue-router';
import Fragment from 'vue-fragment'

Vue.use(Fragment.Plugin);
Vue.use(VueRouter);

/*
    pages
*/
import dashboard from '../js/components/general/Dashboard'
import profile from '../js/components/general/Profile'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: dashboard,
            component: dashboard
        },
        {
            path: "/profile",
            name: profile,
            component: profile,
        },
    ]
});

export default router;
