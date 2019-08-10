import axios from 'axios';

export default {
    getAll(data){
        return axios.post('/api/posts',
            {
                offset: data.offset
            }
        );
    },
    create(data){
        return axios.post('/api/post',
            {
                title: data.title,
                content: data.content,
                media: data.media
            }
        );
    }
}
