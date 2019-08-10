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
                                    <input-media></input-media>
                                </v-flex>
                                <v-flex xs6 md4 v-for="image in images" :key="image.id">
                                    <update-media :file="image.file" :id="image.id" :visibility="image.isPublic"></update-media>
<!--                                    <input-image :file="image.file" :id="image.id" :iser="image.isPublic" :image="image"></input-image>
                                    <p v-if="image.isPublic">{{image.id}}</p>-->
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
    import InputMedia from '../../components/app/forms/AppFormUploadMedia';
    import UpdateMedia from "../../components/app/forms/AppFormUpdateMedia";

    export default {
        name: 'profile-user',
        data: () => ({
            title: '',
            age: '',
        }),
        components: {
            'input-media' : InputMedia,
            'update-media' : UpdateMedia
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
