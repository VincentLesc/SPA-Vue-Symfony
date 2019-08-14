<template>
    <v-container  class="overflow-auto pa-0" style="max-height: 85vh">
        <v-flex grid-list-xl>
            <v-layout
                    align-start
                    justify-center
                    row
                    wrap
                    ma-0
                    class="overflow-auto"
            >
                <v-flex xs12 md4>
                    <v-card class="ma-1">
                        <v-card-title>
                            Images
                        </v-card-title>
                        <v-card-text>
                            <v-layout wrap row >
                                <v-flex xs6 md4>
                                    <input-media></input-media>
                                </v-flex>
                                <v-flex xs6 md4 v-for="image in img" :key="image.id">
                                    <update-media
                                            :file="image.file"
                                            :id="image.id"
                                            :visibility="image.isPublic"
                                            :is-main="mainPicture(image.id)"
                                    ></update-media>
                                </v-flex>
                            </v-layout>
                        </v-card-text>
                    </v-card>
                </v-flex>
                <v-flex xs12 md4>
                    <v-card class="ma-1">
                        <v-card-title>
                            Informations
                        </v-card-title>
                        <v-card-text>
                            <profile-user-form
                                    :title="title"
                                    :description="description"
                                    :age="age"
                            ></profile-user-form>
                        </v-card-text>
                    </v-card>
                </v-flex>
                <v-flex xs12 md4>
                    <v-card class="ma-1">
                        <v-card-title>
                            Localisation
                        </v-card-title>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-container>
</template>
<script>
    import InputMedia from '../../components/app/forms/AppFormUploadMedia';
    import UpdateMedia from "../../components/app/forms/AppFormUpdateMedia";
    import ProfileUserForm from "../../components/profile/ProfileUserForm";

    export default {
        name: 'profile-user',
        components: {
            'input-media' : InputMedia,
            'update-media' : UpdateMedia,
            'profile-user-form': ProfileUserForm
        },
        methods: {
            mainPicture(id) {
                let main = this.$store.getters['profile/getMainPicture'];
                return main !== null && main.id === id;
            },
        },
        computed: {
            img() {
                return this.$store.getters['profile/getImages'];
            },
            title() {
                return this.$store.getters['profile/getTitle'];
            },
            description() {
                return this.$store.getters['profile/getDescription'];
            },
            age() {
                return this.$store.getters['profile/getAge'];
            },
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
