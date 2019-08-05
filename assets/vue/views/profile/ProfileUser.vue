<template>
    <v-container grid-list-md>
        <v-layout align-start justify-space-between row fill-height wrap>
            <v-flex xs12 class="text-center">
                <h1>Mon profile</h1>
            </v-flex>
            <v-flex xs12 md6>
                <v-card class="pa-3">
                    <v-layout align-start row fill-height>
                        <v-flex xs4>
                            <v-img
                                    src="https://picsum.photos/200"
                            >
                            </v-img>
                        </v-flex>
                        <v-layout
                                align-start
                                justify-space-between
                                column
                                fill-height
                                ma-2
                                style="min-height: 100%"
                        >
                                <h4>title</h4>
                                <p>age</p>
                                <p><small>recherche</small></p>
                        </v-layout>
                    </v-layout>
                </v-card>
            </v-flex>
            <v-flex xs12 md8>
                <v-card>
                    Age
                    Taille
                    Poids
                    Morphologie
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>
<script>
    export default {
        name: 'profile-user',

    }
</script>
