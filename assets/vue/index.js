import Vue from 'vue';
import App from './App';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';

Vue.use(Vuetify)

new Vue({
    template: '<App/>',
    vuetify: new Vuetify(),
    components: { App },
}).$mount('#app');