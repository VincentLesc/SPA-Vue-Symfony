import AppAPI from '../api/app';

export default {
    namespaced: true,
    state: {
        groups : [],
        maritalStatus : [],
        ethnicity: [],
        sexualPosition: [],
        morphology: []
    },
    getters: {
        groups(state) {
            return state.groups;
        },
        maritalStatus(state) {
            return state.maritalStatus;
        },
        ethnicity(state) {
            return state.ethnicity;
        },
        sexualPosition(state) {
            return state.sexualPosition;
        },
        morphology(state) {
            return state.morphology;
        }
    },
    mutations: {
        ['LOAD_SUCCESS'] (state, payload) {
            console.log(payload)
            state.groups = JSON.parse(payload.groups);
            state.maritalStatus = JSON.parse(payload.maritalStatus);
            state.ethnicity = JSON.parse(payload.ethnicity);
            state.sexualPosition = JSON.parse(payload.sexualPosition);
            state.morphology = JSON.parse(payload.morphology);
            state.height = JSON.parse(payload.height);
            state.weight = JSON.parse(payload.weight);
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
