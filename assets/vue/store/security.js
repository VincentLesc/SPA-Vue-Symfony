import SecurityAPI from '../api/security';

export default {
    namespaced: true,
    state: {
        isAuthenticated: false,
    },
    getters: {
        isAuthenticated (state) {
            return state.isAuthenticated;
        }
    },
    mutations: {
        ['AUTHENTICATION_SUCCESS'](state) {
            state.isAuthenticated = true;
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
                    commit('AUTHENTICATION_SUCCESS')
                )
        },
        onRefreshAuthentication ({commit}, payload) {
            commit('ON_REFRESH', payload);
        },
        logout ({commit}) {
            commit('LOG_OUT');
        }
    },
}
