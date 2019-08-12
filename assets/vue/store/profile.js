import ProfileAPI from "../api/profile";

export default {
    namespaced: true,
    state: {
        images : [],
        mainPicture: '',
        title: '',
        description: '',
        age: '',
        isLoading: false
    },
    getters: {
        getImages(state) {
            return state.images;
        },
        getMainPicture(state) {
            return state.mainPicture;
        },
        getIsLoading(state) {
            return state.isLoading;
        },
        getTitle(state) {
            return state.title;
        },
        getDescription(state) {
            return state.description;
        },
        getAge(state) {
            return state.age;
        }
    },
    mutations: {
        ['LOADING'](state, payload) {
            state.isLoading = true;
        },
        ['LOAD_SUCCESS'](state, payload) {
            state.images = payload.userProfileMedia;
            state.mainPicture = payload.mainPicture;
            state.isLoading = false;
            state.age = payload.age;
            state.title = payload.title;
            state.description = payload.description;
        },
        ['IMAGE_UPLOAD_SUCCESS'](state, payload) {
            state.images.unshift(payload);
            state.isLoading = false;
        },
        ['MAIN_PICTURE_UPDATED'](state, payload) {
            state.mainPicture = payload.mainPicture;
            state.isLoading = false;
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
            state.isLoading = false;
        }
    },
    actions: {
        loadProfile({commit}) {
            return ProfileAPI.getUserProfile()
                .then(res =>
                    commit('LOAD_SUCCESS', JSON.parse(res.data))
                )
        },
        updateProfile({commit},payload) {
            commit('LOADING');
            return ProfileAPI.updateProfile(payload)
                .then(res =>
                    commit('LOAD_SUCCESS', JSON.parse(res.data))
                )
        }
        ,
        addProfilePicture({commit}, payload) {
            commit('LOADING');
            return ProfileAPI.addProfilePicture(payload)
                .then( res => commit('IMAGE_UPLOAD_SUCCESS', JSON.parse(res.data)))
        },
        deleteProfilePicture({commit}, payload) {
            return ProfileAPI.removeProfilePicture(payload)
                .then( res => commit('IMAGE_DELETE_SUCCESS', res))

        }
    }
}
