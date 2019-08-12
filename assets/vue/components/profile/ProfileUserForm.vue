<template>
    <v-layout wrap>
        <v-flex xs12>
            <v-text-field
                    v-model="title"
                    label="Titre du profil"
                    counter="16"
                    clearable
            ></v-text-field>
        </v-flex>
        <v-flex xs12>
            <v-textarea
                    v-model="description"
                    label="Description"
                    clearable
            ></v-textarea>
        </v-flex>
        <v-flex xs6>
            <v-select
                    :items="ageRange"
                    label="Age"
            ></v-select>
        </v-flex>
        <v-spacer></v-spacer>
        <v-flex xs4>
            <v-switch
                    v-model="switch1"
                    :label="ageOption"
            ></v-switch>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "ProfileUserForm",
        props: {
            title: String,
            description: Text,
            age: Number,
            switch1: Boolean
        },
        computed: {
            ageRange(){
                let age = [];
                for (let i=18; i<99; i++) {
                    age.push(i);
                }
                return age;
            },
            ageOption() {
                return this.switch1 === true ? 'Masquer' : 'Afficher';
            }
        }
    }
</script>

<style scoped>

</style>
