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
            state.images.unshift(payload);
        },
        ['IMAGE_DELETE_SUCCESS'](state, payload) {
            state.images = state.images.filter(
                function (obj) {
                    if (obj.id === payload.data.id) {
                        return false
                    } else {
                        return true
                    }
                }
            );
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
        },
        deleteProfilePicture({commit}, payload) {
            return ProfileAPI.removeProfilePicture(payload)
                .then( res => commit('IMAGE_DELETE_SUCCESS', res))
        }
    }
}
