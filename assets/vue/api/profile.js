import axios from 'axios';

export default {
    getUserProfile() {
        return axios.get('/api/user/profile')
    },
    addProfilePicture(payload) {
        return axios.post(
            '/api/profile/media',
            payload,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
        )
    },
    removeProfilePicture(payload) {
        return axios.delete(
            '/api/profile/media/'+payload
        )
    },
    updateProfilePicture(payload) {
        return axios.put(
            '/api/profile/media/'+payload.id,
            payload
        )
    }
}
