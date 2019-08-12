<template>
    <div>
        <v-img
                :src="defaultFile"
                class="mr-1 mb-1"
                v-on:click="selectInput"
                height="150"
        >
            <div class="fill-height text-center bottom-gradient" v-if="isLoading">
                <v-layout align-center justify-center fill-height>
                    <v-progress-circular
                            indeterminate
                            color="primary"
                    ></v-progress-circular>
                </v-layout>
            </div>
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
        computed: {
            isLoading() {
                return this.$store.getters['profile/getIsLoading']
            }
        },
        methods: {
            selectInput() {
                this.$el.querySelector('input').click();
            },
            handleFileUpload(){
                let file = this.$refs.file.files[0];
                let formData = new FormData();
                formData.append('file', file);
                this.$store.dispatch('profile/addProfilePicture', formData);
                this.$emit('updated')
            },
        },
    }
</script>

<style scoped>
    .bottom-gradient {
        background-image: linear-gradient(to top, rgba(0, 0, 0, 0.4) 0%, black 70%);
    }
</style>
