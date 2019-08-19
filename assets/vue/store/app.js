import AppAPI from '../api/app';

export default {
    namespaced: true,
    state: {
        groups : [],
        maritalStatus : [],
    },
    getters: {
        groups(state) {
            return state.groups;
        },
        maritalStatus(state) {
            return state.maritalStatus;
        }
    },
    mutations: {
        ['LOAD_SUCCESS'] (state, payload) {
            state.groups = JSON.parse(payload.groups);
            state.maritalStatus = JSON.parse(payload.maritalStatus);
        }
    },
    actions: {
        loadAppParameters({commit}) {
            return AppAPI.getParameters()
                .then(res =>
                    commit('LOAD_SUCCESS', res.data)
                )
        }
    }
}