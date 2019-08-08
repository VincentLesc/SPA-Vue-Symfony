import axios from 'axios';

export default {
    getUserProfile() {
        return axios.get('/api/user/profile')
    }
}