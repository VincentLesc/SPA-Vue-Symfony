import Vue from 'vue';
import VueRouter from 'vue-router';
import Blog from '../views/blog/BlogIndex';
import BlogNew from '../views/blog/BlogNew';
import ProfileUser from "../views/profile/ProfileUser";
import SecurityLogin from '../views/security/Login';
import SecurityRegister from '../views/security/Register';
import Home from '../views/Home';


Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        { path: '/blog', component: Blog},
        { path: '/blog/new', component: BlogNew},
        { path: '/user/profile', component: ProfileUser},
        { path: '/login', component: SecurityLogin},
        { path: '/register', component: SecurityRegister},
        { path: '/*', component: Home}
    ]
});
