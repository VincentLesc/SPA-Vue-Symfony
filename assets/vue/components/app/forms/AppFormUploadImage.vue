<template>
    <div>
        <v-img
                :src="getImg"
                class="mr-1 mb-1"
                v-on:click="modalOrInput"
                height="250"
        >
        </v-img>
        <input type="file" id="file" ref="file" v-on:change="handleFileUpload()" class="ma-3" style="display: none"/>
        <profile-image-update :dialog="imageUpdate" :file="file"></profile-image-update>
    </div>
</template>

<script>
    import axios from 'axios';
    import ProfileImageUpdate from "../../profile/ProfileImageUpdate";

    export default {
        name: "AppFormUploadImage",
        data: () => ({
            defaultFile: '',
            imageUpdate: false
        }),
        props: ['file'],
        components: {
            'profile-image-update': ProfileImageUpdate
        },
        methods: {
            selectInput() {
                this.$el.querySelector('input').click();
            },
            selectModal() {
                this.imageUpdate = true;
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
            isAlreadySet() {
                return this.file !== '';
            },
            modalOrInput() {
                if (this.isAlreadySet()) {
                    this.selectModal()
                } else {
                    this.selectInput()
                }
            }
        },
        mounted() {
            this.defaultFile = require('../../../../images/image-placeholder-350x350.png');
        },
        computed: {
            getImg() {
                return this.isAlreadySet() ? this.file : this.defaultFile;
            }
        }
    }
</script>

<style scoped>

</style>