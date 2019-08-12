import ProfileAPI from "../api/profile";

export default {
    namespaced: true,
    state: {
        profiles: [],
    },
    getters: {
        getProfiles(state) {
            return state.profiles;
        }
    },
    mutations: {
        ['LOAD_SUCCESS'](state, payload) {
            for (let t in payload) {
                console.log(payload[t]);
            }
            state.profiles = payload
        }
    },
    actions: {
        loadProfiles({commit}) {
            return ProfileAPI.getAllPublicProfile()
                .then( res =>
                    commit('LOAD_SUCCESS', JSON.parse(res.data))
                )
        }
    }
}
