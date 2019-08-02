import SecurityAPI from '../api/security';

export default {
    namespaced: true,
    state: {
        isAuthenticated: false,
        username: ''
    },
    getters: {
        isAuthenticated (state) {
            return state.isAuthenticated;
        },
        getUsername (state) {
            return state.username;
        }
    },
    mutations: {
        ['AUTHENTICATION_SUCCESS'](state, payload) {
            state.isAuthenticated = true;
            state.username = payload.username;
            console.log(payload);
        },
        ['LOG_OUT'](state, payload) {
            state.isAuthenticated = payload
        },
        ['ON_REFRESH'](state, payload) {
            state.isAuthenticated = payload
        }
    },
    actions: {
        login({commit}, payload) {
            return SecurityAPI.login(payload)
                .then(res =>
                    commit('AUTHENTICATION_SUCCESS', res.data)
                )
        },
        onRefreshAuthentication ({commit}, payload) {
            commit('ON_REFRESH', payload);
        },
        logout ({commit}) {
            commit('LOG_OUT');
        },
        register ({commit}, payload) {

        }
    },
}
