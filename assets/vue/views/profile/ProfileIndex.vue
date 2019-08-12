<template>
    <v-container grid-list-sm style="max-height: 85vh" class="overflow-auto">
        <v-layout wrap>
            <v-flex
                    v-for="profile in profiles"
                    :key="profile.id"
                    xs4
                    md2
            >
                <v-card elevation="5" tile>
                    <v-img
                            :id="setImgId(profile.id)"
                            :height="200"
                            :src="getImage(profile.mainPicture)"
                    ></v-img>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: "ProfileIndex",
        created() {
            if (this.$store.getters['community/getProfiles'].length === 0) {
                return this.$store.dispatch('community/loadProfiles')
            }
        },
        computed: {
            profiles() {
                return this.$store.getters['community/getProfiles']
            },
        },
        methods: {
            getImage(value) {
                if (!value) {
                    return require('../../../images/image-placeholder-350x350.png');
                } else {
                    return value.file;
                }
            },
            setImgId(value) {
                return "profile-img-" + value;
            },
        }
    }
</script>

<style scoped>

</style>
