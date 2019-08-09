<template>
    <div class="text-center">
        <v-dialog
                v-model="openDialog"
                width="1000"
        >
            <v-card>
                <v-img :src="file">
                    <v-layout pa-2 row fill-height class="lightbox white--text">
                        <v-spacer></v-spacer>
                        <v-flex xs2 md1>
                            <v-layout column class="align-center">
                                <v-flex xs12>
                                    <v-btn
                                            class="ma-0 white--text"
                                            fab
                                            small
                                    >
                                        <v-icon dark>mdi-delete</v-icon>
                                    </v-btn>
                                </v-flex>
                                <v-flex xs12 class="mt-5">
                                    <v-btn
                                            class="ma-0 white--text"
                                            fab
                                            small
                                    >
                                        <v-icon dark>mdi-eye-off</v-icon>
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
    export default {
        name: "ProfileImageUpdate",
        props: ['dialog', 'file'],
        computed: {
            openDialog () {
                return  this.dialog
            }
        }
    }
</script>

<style scoped>

</style>