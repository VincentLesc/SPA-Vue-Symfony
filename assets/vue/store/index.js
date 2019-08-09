import Vue from 'vue';
import Vuex from 'vuex';
import SecurityStore from './security';
import ProfileStore from './profile';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        security: SecurityStore,
        profile: ProfileStore
    }
});
