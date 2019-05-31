import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Home from './pages/Home';
import Statistics from './pages/Statistics';

export default new VueRouter({
    mode: 'history',
    scrollBehavior(to, from, savedPosition) {
        return savedPosition ? savedPosition : { x: 0, y: 0 };
    },
    routes: [

        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/statistics',
            name: 'statistics',
            component: Statistics,
        },
        {
            path: '/*',
            redirect: '/',
        },
    ],
});