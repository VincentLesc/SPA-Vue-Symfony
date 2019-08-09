<template>
    <v-container  class="overflow-auto" style="max-height: 80vh">
        <v-flex grid-list-xl>
            <v-layout
                    align-start
                    justify-center
                    row
                    wrap
                    ma-3
                    class="overflow-auto"
            >
                <v-flex xs12 class="text-center">
                    <h1>Mon profil</h1>
                </v-flex>
                <v-flex xs12 md5>
                    <v-card class="ma-2">
                        <v-card-title>
                            Mes images
                        </v-card-title>
                        <v-card-text>
                            <v-layout wrap row >
                                <v-flex xs4>
                                    <input-image></input-image>
                                </v-flex>
                                <v-flex xs4 v-for="image in images" :key="image.id">
                                    <input-image :file="image.file"></input-image>
                                </v-flex>
                            </v-layout>
                        </v-card-text>
                    </v-card>
                </v-flex>
                <v-flex xs12 md5>
                    <v-card class="ma-2">
                        <v-card-title>
                            Mon titre
                        </v-card-title>
                        <v-card-text>
                            Mon texte
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-container>
</template>
<script>
    import InputImage from '../../components/app/forms/AppFormUploadImage';

    export default {
        name: 'profile-user',
        data: () => ({
            title: '',
            age: '',
        }),
        components: {
            'input-image' : InputImage
        },
        methods: {
        },
        created() {
            this.$store.dispatch('profile/loadProfile');
        },
        computed : {
            images() {
                return this.$store.getters['profile/getImages'];
            }
        }
    }
</script>
<style>
    .theme--dark.v-text-field>.v-input__control>.v-input__slot:before {
        width: 100%;
    }
    .background-primary-title {
        background-color: black;
    }
</style>
