<template>
    <v-flex grid-list-xl>
        <v-layout
                align-start
                justify-center
                row
                fill-height
                wrap
                ma-3
        >
            <v-flex xs12 class="text-center">
                <h1>Mon profil</h1>
            </v-flex>
            <v-flex xs12 md5>
                <v-card class="ma-2">
                    <v-card-title>
                        Mon titre
                    </v-card-title>
                    <v-card-text>
                        <v-layout wrap>
                            <v-flex md6 xs12>
                                <input-image></input-image>
                            </v-flex>
                            <v-flex md3 xs6>
                                <v-flex xs12>
                                    <input-image></input-image>
                                </v-flex>
                                <v-flex xs12>
                                    <input-image></input-image>
                                </v-flex>
                            </v-flex>
                            <v-flex md3 xs6>
                                <v-flex xs12>
                                    <input-image></input-image>
                                </v-flex>
                                <v-flex xs12>
                                    <input-image></input-image>
                                </v-flex>
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
        <!--        <v-layout align-start justify-space-between row fill-height wrap>-->
        <!--            <v-flex xs12 class="text-center">-->
        <!--                <h1>Mon profil</h1>-->
        <!--            </v-flex>-->
        <!--            <v-flex xs12 sm8 offset-sm2 md5>-->
        <!--                <v-card>-->
        <!--                    <v-card-title-->
        <!--                        class="background-primary-title"-->
        <!--                    >-->
        <!--                        Mon aperçu de profil-->
        <!--                    </v-card-title>-->
        <!--                    <v-layout row fill-height ma-0>-->
        <!--                        <v-flex-->
        <!--                                ma-auto-->
        <!--                                xs6-->
        <!--                                md4-->
        <!--                        >-->
        <!--                            <v-img-->
        <!--                                    src="https://picsum.photos/200"-->
        <!--                                    class="mt-4 mt-md-0"-->
        <!--                            >-->
        <!--                                <template>-->
        <!--                                    <v-layout-->
        <!--                                            fill-height-->
        <!--                                            align-end-->
        <!--                                            ma-0-->
        <!--                                    >-->
        <!--                                        <v-flex>-->
        <!--                                            <div class="row ma-0">-->
        <!--                                                <v-icon>fiber_manual_record</v-icon>-->
        <!--                                                <strong>{{title}}</strong>-->
        <!--                                                <v-spacer></v-spacer>-->
        <!--                                                <strong class="mr-2">{{age}}</strong>-->

        <!--                                            </div>-->
        <!--                                        </v-flex>-->

        <!--                                    </v-layout>-->
        <!--                                </template>-->
        <!--                            </v-img>-->
        <!--                        </v-flex >-->
        <!--                        <v-flex xs12 md8>-->
        <!--                            <v-container-->
        <!--                                    fill-height-->
        <!--                            >-->
        <!--                                <v-layout-->
        <!--                                        column-->
        <!--                                        justify-content-center-->
        <!--                                        ma-1-->
        <!--                                >-->
        <!--                                    <v-flex>-->
        <!--                                        <v-text-field-->
        <!--                                                v-model="title"-->
        <!--                                                ma-0 pa-0-->
        <!--                                                single-line-->
        <!--                                                clearable-->
        <!--                                                :counter="16"-->
        <!--                                                label="Titre">-->

        <!--                                        </v-text-field>-->
        <!--                                    </v-flex>-->
        <!--                                    <v-flex>-->
        <!--                                        <v-text-field-->
        <!--                                                v-model="age"-->
        <!--                                                ma-0 pa-0-->
        <!--                                                single-line-->
        <!--                                                clearable-->
        <!--                                                label="Age">-->
        <!--                                        </v-text-field>-->
        <!--                                    </v-flex>-->
        <!--                                </v-layout>-->
        <!--                            </v-container>-->
        <!--                        </v-flex>-->
        <!--                    </v-layout>-->
        <!--                </v-card>-->
        <!--            </v-flex>-->
        <!--            <v-flex xs12 sm8 offset-sm2 md5>-->
        <!--                <v-card>-->
        <!--                    <v-card-title-->
        <!--                            class="background-primary-title"-->
        <!--                    >-->
        <!--                        Mon aperçu de profil-->
        <!--                    </v-card-title>-->
        <!--                    <v-layout row fill-height ma-0>-->
        <!--                        <v-flex-->
        <!--                                ma-auto-->
        <!--                                xs6-->
        <!--                                md4-->
        <!--                        >-->
        <!--                            <v-img-->
        <!--                                    src="https://picsum.photos/200"-->
        <!--                                    class="mt-4 mt-md-0"-->
        <!--                            >-->
        <!--                                <template>-->
        <!--                                    <v-layout-->
        <!--                                            fill-height-->
        <!--                                            align-end-->
        <!--                                            ma-0-->
        <!--                                    >-->
        <!--                                        <v-flex>-->
        <!--                                            <div class="row ma-0">-->
        <!--                                                <v-icon>fiber_manual_record</v-icon>-->
        <!--                                                <strong>{{title}}</strong>-->
        <!--                                                <v-spacer></v-spacer>-->
        <!--                                                <strong class="mr-2">{{age}}</strong>-->

        <!--                                            </div>-->
        <!--                                        </v-flex>-->

        <!--                                    </v-layout>-->
        <!--                                </template>-->
        <!--                            </v-img>-->
        <!--                        </v-flex >-->
        <!--                        <v-flex xs12 md8>-->
        <!--                            <v-container-->
        <!--                                    fill-height-->
        <!--                            >-->
        <!--                                <v-layout-->
        <!--                                        column-->
        <!--                                        justify-content-center-->
        <!--                                        ma-1-->
        <!--                                >-->
        <!--                                    <v-flex>-->
        <!--                                        <v-text-field-->
        <!--                                                v-model="title"-->
        <!--                                                ma-0 pa-0-->
        <!--                                                single-line-->
        <!--                                                clearable-->
        <!--                                                :counter="16"-->
        <!--                                                label="Titre">-->

        <!--                                        </v-text-field>-->
        <!--                                    </v-flex>-->
        <!--                                    <v-flex>-->
        <!--                                        <v-text-field-->
        <!--                                                v-model="age"-->
        <!--                                                ma-0 pa-0-->
        <!--                                                single-line-->
        <!--                                                clearable-->
        <!--                                                label="Age">-->
        <!--                                        </v-text-field>-->
        <!--                                    </v-flex>-->
        <!--                                </v-layout>-->
        <!--                            </v-container>-->
        <!--                        </v-flex>-->
        <!--                    </v-layout>-->
        <!--                </v-card>-->
        <!--            </v-flex>-->
        <!--        </v-layout>-->
    </v-flex>
</template>
<script>
    import InputImage from '../../components/app/forms/AppFormUploadImage';

    export default {
        name: 'profile-user',
        data: () => ({
            title: '',
            age: ''
        }),
        components: {
            'input-image' : InputImage
        },
        methods: {
            onMediaUploaded() {

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
