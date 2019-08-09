<template>
    <div>
        <v-img
                :src="getImg"
                class="mr-1 mb-1"
                v-on:click="modalOrInput"
                height="150"
        >
        </v-img>
        <input type="file" id="file" ref="file" v-on:change="handleFileUpload()" class="ma-3" style="display: none"/>
        <profile-image-update :dialog="imageUpdate" :file="file"></profile-image-update>
    </div>
</template>

<script>
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
                let file = this.$refs.file.files[0];
                let formData = new FormData();
                formData.append('file', file);
                this.$store.dispatch('profile/addProfilePicture', formData)
            },
            isAlreadySet() {
                return this.file !== undefined;
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
