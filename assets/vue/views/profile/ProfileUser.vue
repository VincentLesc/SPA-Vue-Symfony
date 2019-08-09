<template>
    <v-container  class="overflow-auto pa-0" style="max-height: 80vh">
        <v-flex grid-list-xl>
            <v-layout
                    align-start
                    justify-center
                    row
                    wrap
                    ma-0
                    class="overflow-auto"
            >
                <v-flex xs12 md5>
                    <v-card class="ma-1">
                        <v-card-title>
                            Images
                        </v-card-title>
                        <v-card-text>
                            <v-layout wrap row >
                                <v-flex xs6 md4>
                                    <input-image></input-image>
                                </v-flex>
                                <v-flex xs6 md4 v-for="image in images" :key="image.id">
                                    <input-image :file="image.file" :id="image.id" :iser="image.isPublic" :image="image"></input-image>
                                    <p v-if="image.isPublic">{{image.id}}</p>
                                </v-flex>

                            </v-layout>
                        </v-card-text>
                    </v-card>
                </v-flex>
                <v-flex xs12 md5>
                    <v-card class="ma-1">
                        <v-card-title>
                            Informations
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
                console.log(this.$store.getters['profile/getImages']);
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
