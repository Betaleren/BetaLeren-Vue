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
import login from '../js/components/authentication/login';
import register from '../js/components/authentication/register';
import profile from '../js/components/general/Profile';
import course from '../js/components/general/Course';
import video from '../js/components/video/Video';

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
        {
            path: "/course",
            name: course,
            component: course,
        },
        {
            path: "/watch",
            name: video,
            component: video,
            meta: {
                show: '1',
            },
        },
    ]
});

export default router;
