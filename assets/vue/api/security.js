import axios from 'axios';

export default {
    login(data) {
        return axios.post('/api/login', data)
    },
    isUnique(data) {
      return axios.post('/api/security/control', data)
    },
    register(data) {
        return axios.post('/api/register', data)
    }
}
