import Vue from 'vue';
import VueRouter from 'vue-router';
import Blog from '../views/blog/BlogIndex';
import BlogNew from '../views/blog/BlogNew';
import SecurityLogin from '../views/security/Login';
import Home from '../views/Home';


Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        { path: '/blog', component: Blog},
        { path: '/blog/new', component: BlogNew},
        { path: '/login', component: SecurityLogin},
        { path: '/*', component: Home}
    ]
});
