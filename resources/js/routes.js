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
import video from '../js/components/video/Video';
import course from '../js/components/general/Course';
import register from '../js/components/authentication/register';
import login from '../js/components/authentication/login';
import profile_courses from './components/profile/info/Profile-Courses'
import progress from './components/profile/info/Progress'
import profile from './components/profile/Profile'

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
            path: "/progress",
            name: progress,
            component: progress,
        },
        {
            path: "/profile-courses",
            name: profile_courses,
            component: profile_courses,
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
        },
    ]
});

export default router;
