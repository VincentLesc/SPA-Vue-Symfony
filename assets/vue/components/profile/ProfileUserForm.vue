<template>
    <v-layout wrap>
        <v-flex xs12>
            <v-text-field
                    v-model="displayedTitle"
                    label="Titre du profil"
                    counter="16"
                    append-outer-icon="place"
                    clearable
            ></v-text-field>
        </v-flex>
        <v-flex xs12>
            <v-textarea
                    v-model="displayedDescription"
                    label="Description"
                    auto-grow
                    clearable
            ></v-textarea>
        </v-flex>
        <v-flex xs6>
            <v-select
                    v-model="displayedAge"
                    :items="ageRange"
                    label="Age"
            ></v-select>
        </v-flex>
        <v-spacer></v-spacer>
        <v-flex xs5>
            <v-switch
                    v-model="shownAge"
                    :label="ageOption"
            ></v-switch>
        </v-flex>
        <v-spacer></v-spacer>
        <v-flex xs6 offset-6>
                <v-btn
                        width="100%"
                        v-on:click="submit"
                        :loading="isLoading"
                >Enregistrer</v-btn>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "ProfileUserForm",
        props: {
            title: String,
            description: [Text,String],
            age: Number,
            showAge: Boolean
        },
        data(){
            return{
                displayedTitle: this.title,
                displayedDescription: this.description,
                displayedAge: this.age,
                shownAge: this.showAge
            }
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
                return this.shownAge === true ? 'Masquer' : 'Afficher';
            },
            isLoading() {
                return this.$store.getters['profile/getIsLoading'];
            }
        },
        methods: {
            submit() {
                let payload = {
                    title: this.displayedTitle,
                    description: this.displayedDescription,
                    age: this.displayedAge
                };
                this.$store.dispatch('profile/updateProfile', payload)
            }
        }
    }
</script>

<style scoped>

</style>
