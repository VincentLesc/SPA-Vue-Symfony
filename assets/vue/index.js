import Vue from 'vue';
import App from './App';
import router from './router';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';

Vue.use(Vuetify);

new Vue({
    template: '<App/>',
    vuetify: new Vuetify(),
    components: { App },
    router
}).$mount('#app');
