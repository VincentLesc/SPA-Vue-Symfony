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
        ['AUTHENTICATION_SUCCESS'](state, payload) {
            state.isAuthenticated = true;
        },
    },
    actions: {
        loginUser({commit}, payload) {
            return SecurityAPI.login(payload)
                .then(res => commit('AUTHENTICATION_SUCCESS', res.data))
                .catch(res => commit('AUTHENTICATION_ERROR', res))

        },
    },
}
