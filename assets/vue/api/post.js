import axios from 'axios';

export default {
    getAll(){
        return axios.get('/api/posts');
    },
    create(data){
        return axios.post('/api/post',
            {
                title: data.title,
                content: data.content
            }
        );
    }
}
