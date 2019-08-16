import ProfileAPI from "../api/profile";

export default {
    namespaced: true,
    state: {
        images : [],
        mainPicture: '',
        title: '',
        description: '',
        age: '',
        weight: '',
        height: '',
        maritalStatus: '',
        groups: [],
        ethnicity: '',
        morphology: '',
        position: '',
        isLoading: false,
        hasError: false,
        isTyping: false,
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
        },
        getHeight(state) {
            return state.height;
        },
        getWeight(state) {
            return state.weight;
        },
        getHasError(state) {
            return state.hasError;
        },
        getIsTyping(state) {
            return state.isTyping;
        },
        getMaritalStatus(state) {
            return state.maritalStatus;
        },
        getEthnicity(state) {
            return state.ethnicity;
        },
        getMorphology(state) {
            return state.morphology;
        },
        getSexualPosition(state) {
            return state.position;
        },
        getGroups(state) {
            let groupsArray = [];
            for (let id in state.groups) {
                groupsArray.push(state.groups[id].id);
            }
            return groupsArray;
        }
    },
    mutations: {
        ['LOADING'](state, payload) {
            state.isLoading = true;
            state.hasError = false;
        },
        ['ERROR'](state) {
            state.hasError = true;
        },
        ['TYPING'](state) {
            state.isTyping = true;
            state.hasError = false;
            state.isLoading = false;
        },
        ['LOAD_SUCCESS'](state, payload) {
            console.log(payload);
            state.images = payload.userProfileMedia;
            state.mainPicture = payload.mainPicture;
            state.isLoading = false;
            state.age = payload.age;
            state.title = payload.title;
            state.description = payload.description;
            state.height = payload.height;
            state.weight = payload.weight;
            state.maritalStatus =payload.maritalStatus;
            state.groups= payload.groups;
            state.ethnicity= payload.ethnicity;
            state.morphology= payload.morphology;
            state.position= payload.sexualPosition;
            state.hasError = false;
            console.log(payload)
        },
        ['IMAGE_UPLOAD_SUCCESS'](state, payload) {
            state.images.unshift(payload);
            state.isLoading = false;
            state.hasError = true;
        },
        ['MAIN_PICTURE_UPDATED'](state, payload) {
            state.mainPicture = payload.mainPicture;
            state.isLoading = false;
            state.hasError = false;
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
            state.hasError = false;
        }
    },
    actions: {
        loadProfile({commit}) {
            return ProfileAPI.getUserProfile()
                .then(res =>
                    commit('LOAD_SUCCESS', JSON.parse(res.data))
                )
                .catch(commit('ERROR'))
        },
        updateProfile({commit},payload) {
            commit('LOADING');
            return ProfileAPI.updateProfile(payload)
                .then(res =>
                    commit('LOAD_SUCCESS', JSON.parse(res.data))
                )
                .catch(commit('ERROR'))
        }
        ,
        addProfilePicture({commit}, payload) {
            commit('LOADING');
            return ProfileAPI.addProfilePicture(payload)
                .then( res => commit('IMAGE_UPLOAD_SUCCESS', JSON.parse(res.data)))
                .catch(commit('ERROR'))
        },
        deleteProfilePicture({commit}, payload) {
            return ProfileAPI.removeProfilePicture(payload)
                .then( res => commit('IMAGE_DELETE_SUCCESS', res))
                .catch(commit('ERROR'))
        },
        fillingForm({commit}) {
            commit('TYPING');
        }
    }
}
