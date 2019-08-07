<template>
    <div>
        <v-img
                :src="require('../../../images/image-placeholder-350x350.png')"
                class="mr-1 mb-1"
                v-on:click="selectInput"
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
                document.querySelector('#file').click();
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
                    .then( payload =>{this.$emit('media-uploaded', payload )})
            },
        }
    }
</script>

<style scoped>

</style>