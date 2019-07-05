import Vue from 'vue';
import VueRouter from 'vue-router';
import Fragment from 'vue-fragment';

Vue.use(Fragment.Plugin);
Vue.use(VueRouter);

/*
    pages
*/
import dashboard from '../js/components/general/Dashboard';
import settings from '../js/components/settings/Settings';
import login from '../js/components/general/login';
import register from '../js/components/general/register'
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
            path: '/register',
            name: register,
            component: register
        },
        {
            path: '/login',
            name: login,
            component: login
        },
        {
            path: '/settings',
            name: settings,
            component: settings
        },
        {
            path: "/profile",
            name: profile,
            component: profile,
        },
    ]
});

export default router;
