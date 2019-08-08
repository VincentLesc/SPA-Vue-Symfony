import ProfileAPI from "../api/profile";

export default {
    namespaced: true,
    state: {
        images : []
    },
    getters: {
      getImages(state) {
          return state.images;
        }
    },
    mutations: {
        ['LOAD_SUCCESS'](state, payload) {
            state.images = payload.userProfileMedia.slice(0,5);
        }
    },
    actions: {
        loadProfile({commit}) {
            return ProfileAPI.getUserProfile()
                .then(res =>
                    commit('LOAD_SUCCESS', JSON.parse(res.data))
                )
        },
    }
}