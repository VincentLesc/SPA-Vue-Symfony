import Vue from 'vue';
import App from './App';
import router from './router';
import store from './store';
import Vuetify from 'vuetify';
import Notifications from 'vue-notification';
import 'vuetify/dist/vuetify.min.css';

Vue.use(Vuetify);
Vue.use(Notifications);

new Vue({
    template: '<App/>',
    vuetify: new Vuetify(),
    components: { App },
    router,
    store
}).$mount('#app');
