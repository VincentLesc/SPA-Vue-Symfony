import axios from 'axios';

export default {
    getParameters() {
        return axios.get('/api/app/params')
    }
}