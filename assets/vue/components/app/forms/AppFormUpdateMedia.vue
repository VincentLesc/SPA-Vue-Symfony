<template>
    <div>
        <v-img
                :src="file"
                class="mr-1 mb-1"
                height="150"
                @click.stop="dialog = true"
        >
            <div v-if="!visible" class="fill-height bottom-gradient">
                <v-icon dark class="ma-1">mdi-eye-off</v-icon>
            </div>
        </v-img>
        <v-dialog
                v-model="dialog"
                max-width="1000"
        >
            <v-card>
                <v-img :src="file" :id="id">
                    <v-layout pa-2 row fill-height class="lightbox white--text">
                        <v-spacer></v-spacer>
                        <v-flex xs2 md1>
                            <v-layout column class="align-center overflow-y-auto">
                                <v-flex xs12>
                                    <v-btn
                                            class="ma-0 white--text"
                                            fab
                                            small
                                            @click="deletePicture"
                                    >
                                        <v-tooltip left>
                                            <template v-slot:activator="{ on }">
                                                <v-icon dark v-on="on">mdi-delete</v-icon>
                                            </template>
                                            <span>Supprimer</span>
                                        </v-tooltip>
                                    </v-btn>
                                </v-flex>
                                <v-flex xs12 class="mt-5">
                                    <v-btn
                                            class="ma-0 white--text"
                                            fab
                                            small
                                            @click="setVisibilityPicture"
                                    >
                                        <v-tooltip left>
                                            <template v-slot:activator="{ on }">
                                                <v-icon v-if="visible" dark v-on="on">mdi-eye-off</v-icon>
                                                <v-icon v-else style="color: red" v-on="on">mdi-eye-off</v-icon>
                                            </template>
                                            <span v-if="visible">Photo publique</span>
                                            <span v-else>Photo privée</span>
                                        </v-tooltip>
                                    </v-btn>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                    </v-layout>
                </v-img>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
    import ProfileAPI from '../../../api/profile';

    export default {
        name: "AppFormUpdateMedia",
        props: {
            file: String,
            id: Number,
            visibility: Boolean
        },
        data () {
            return {
                dialog: false,
                visible: this.visibility
            }
        },
        methods: {
            deletePicture() {
                this.$store.dispatch('profile/deleteProfilePicture', this.id)
            },
            setVisibilityPicture() {
                console.log(this.visible);
                this.isPublic = !this.visibility;
                let payload = {
                    'id': this.id,
                    'isPublic': this.isPublic
                };
                ProfileAPI.updateProfilePicture(payload)
                    .then( () => (this.dialog = false))
                    .then( () => (this.visible = !this.visible))
                    .then( () => ( this.$notify({
                        type: 'success',
                        duration: 1000,
                        closeOnClick : true,
                        title: 'Modification enregistrée !',
                    })))
            }
        },
    }
</script>

<style scoped>
    .bottom-gradient {
        background-image: linear-gradient(to top, rgba(0, 0, 0, 0.4) 0%, black 70%);
    }
    .red {
        color: red;
    }
</style>
