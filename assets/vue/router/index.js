import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store';
import Blog from '../views/blog/BlogIndex';
import BlogNew from '../views/blog/BlogNew';
import ProfileUser from "../views/profile/ProfileUser";
import SecurityLogin from '../views/security/Login';
import SecurityRegister from '../views/security/Register';
import Home from '../views/Home';
import ProfileIndex from "../views/profile/ProfileIndex";


Vue.use(VueRouter);

let router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/blog', component: Blog},
        { path: '/blog/new', component: BlogNew},
        { path: '/user/profile', component: ProfileUser, meta: {requiresAuth: true}},
        { path: '/community', component: ProfileIndex, meta: {requiresAuth: true}},
        { path: '/login', component: SecurityLogin},
        { path: '/register', component: SecurityRegister},
        { path: '/*', component: Home}
    ],
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters['security/isAuthenticated']) {
            next();
        } else {
            next({
                path: '/login'
            })
        }
    } else {
        next();
    }
});

export default router;
