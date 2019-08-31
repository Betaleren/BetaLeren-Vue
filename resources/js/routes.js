import VueRouter from 'vue-router';

/*
    pages
*/
import dashboard from './components/general/Dashboard';
import settings from './components/settings/Settings';
import video from './components/video/Video';
import course from './components/general/Course';
import register from './components/authentication/register';
import login from './components/authentication/login';
import recovery from './components/authentication/recovery';
import profile from './components/profile/Profile';

const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: dashboard,
        meta: {
            auth: undefined
        }
    },
    {
        path: '/register',
        name: 'register',
        component: register,
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        alias: '/login/:verification_code',
        name: 'login',
        component: login,
        meta: {
            auth: false
        }
    },
    {
        path: '/recovery',
        alias: '/recovery/:verification_code',
        name: 'recovery',
        component: recovery,
        meta: {
            auth: false
        }
    },
    {
        path: '/settings',
        name: 'settings',
        component: settings,
        meta: {
            auth: true
        }
    },
    {
        path: "/profile",
        name: 'profile',
        component: profile,
        meta: {
            auth: true
        }
    },
    {
        path: "/course",
        name: 'course',
        component: course,
        meta: {
            auth: true
        }
    },
    {
        path: "/watch",
        name: 'video',
        component: video,
        meta: {
            auth: true,
            show: 1,
        }
    },
    // {
    //     path: '/admin',
    //     name: 'admin.dashboard',
    //     component: AdminDashboard,
    //     meta: {
    //         auth: {roles: 3, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    //     }
    // },
];

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
});

export default router;
