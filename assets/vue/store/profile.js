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
            state.images = payload.userProfileMedia;
        },
        ['IMAGE_UPLOAD_SUCCESS'](state, payload) {
            state.images.push(payload);
        }
    },
    actions: {
        loadProfile({commit}) {
            return ProfileAPI.getUserProfile()
                .then(res =>
                    commit('LOAD_SUCCESS', JSON.parse(res.data))
                )
        },
        addProfilePicture({commit}, payload) {
            return ProfileAPI.addProfilePicture(payload)
                .then( res => commit('IMAGE_UPLOAD_SUCCESS', JSON.parse(res.data)))
        }
    }
}
