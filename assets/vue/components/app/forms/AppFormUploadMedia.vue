<template>
    <div>
        <v-img
                :src="defaultFile"
                class="mr-1 mb-1"
                v-on:click="selectInput"
                height="150"
        >
        </v-img>
        <input type="file" id="file" ref="file" v-on:change="handleFileUpload()" class="ma-3" style="display: none"/>
    </div>
</template>

<script>

    export default {
        name: "AppFormUploadImage",
        data: () => ({
            defaultFile: require('../../../../images/image-placeholder-350x350.png'),
        }),
        props: ['file', 'id'],
        methods: {
            selectInput() {
                this.$el.querySelector('input').click();
            },
            handleFileUpload(){
                let file = this.$refs.file.files[0];
                let formData = new FormData();
                formData.append('file', file);
                this.$store.dispatch('profile/addProfilePicture', formData)
            },
        },
    }
</script>

<style scoped>

</style>
