<template>
    <div>
        <v-img
                :src="file"
                class="mr-1 mb-1"
                v-on:click="selectInput"
                contain
        >
        </v-img>
        <input type="file" id="file" ref="file" v-on:change="handleFileUpload()" class="ma-3" style="display: none"/>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "AppFormUploadImage",
        data: () => ({
            file: ''
        }),
        methods: {
            selectInput() {
                this.$el.querySelector('input').click();
            },
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
                let formData = new FormData();
                formData.append('file', this.file);
                axios.post(
                    '/api/profile/media',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                )
                    .then( payload =>{this.file = JSON.parse(payload.data).file})
            },
        },
        mounted() {
            if (this.file === '') {
                this.file = require('../../../../images/image-placeholder-350x350.png');
            }
        }
    }
</script>

<style scoped>

</style>