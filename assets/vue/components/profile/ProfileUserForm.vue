<template>
    <v-layout wrap>
        <v-flex xs12>
            <v-text-field
                    v-model="displayedTitle"
                    v-on:keyup="typing"
                    label="Titre du profil"
                    counter="16"
                    clearable
            ></v-text-field>
        </v-flex>
        <v-flex xs12>
            <v-textarea
                    v-model="displayedDescription"
                    v-on:keyup="isFilling"
                    label="Description"
                    auto-grow
                    clearable
            ></v-textarea>
        </v-flex>
        <v-flex xs6>
            <v-select
                    v-model="displayedAge"
                    v-on:keyup="isFilling"
                    :items="ageRange"
                    label="Age"
            ></v-select>
        </v-flex>
        <v-spacer></v-spacer>
        <v-flex xs4 offset-2>
            <v-switch
                    v-model="shownAge"
                    :label="ageOption"
            ></v-switch>
        </v-flex>
        <v-flex xs12>
            <v-select
                :items="groups"
                item-text="title"
                item-value="id"
                label="Groupes"
                chips
                multiple
            >
            </v-select>
        </v-flex>
        <v-flex xs6>
            <v-select
                    v-model="displayedTall"
                    v-on:keyup="isFilling"
                    :items="tallRange"
                    label="Taille"
            ></v-select>
        </v-flex>
        <v-flex xs6>
            <v-select
                    v-model="displayedWeight"
                    v-on:keyup="isFilling"
                    :items="weightRange"
                    label="Poids"
            ></v-select>
        </v-flex>
        <v-flex xs12>
            <v-select
                :items="maritalStatus"
                item-text="title"
                item-value="id"
                label="Situation amoureuse"
            >
            </v-select>
        </v-flex>
        <v-flex xs6>
            <v-select
                :items="ethnicity"
                item-text="title"
                item-value="id"
                label="Origine"
            >
            </v-select>
        </v-flex>
        <v-flex xs6>
            <v-select
                :items="morphology"
                item-text="title"
                item-value="id"
                label="Morphologie"
            >
            </v-select>
        </v-flex>
        <v-flex xs6>
            <v-select
                :items="sexualPosition"
                item-text="title"
                item-value="id"
                label="Préférences"
            >
            </v-select>
        </v-flex>
        <v-flex xs6 offset-6>
            <v-btn
                    width="100%"
                    v-on:click="submit"
                    :loading="isLoading"
                    v-if="!hasError"
            >Enregistrer</v-btn>
            <v-btn
                    width="100%"
                    v-on:click="submit"
                    v-if="hasError"
                    color="red"
            >Réessayer</v-btn>
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
            showAge: Boolean,
            height: Number,
            weight: Number
        },
        data(){
            return{
                displayedTitle: this.title,
                displayedDescription: this.description,
                displayedAge: this.age,
                displayedTall: this.height,
                displayedWeight: this.weight,
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
            tallRange(){
                let tall = [];
                for (let i=150; i<230; i++) {
                    tall.push(i);
                }
                return tall;
            },
            weightRange(){
                let weight = [];
                for (let i=45; i<145; i++) {
                    weight.push(i);
                }
                return weight;
            },
            ageOption() {
                return this.shownAge === true ? 'Masquer' : 'Afficher';
            },
            isLoading() {
                return this.$store.getters['profile/getIsLoading'];
            },
            hasError() {
                return this.$store.getters['profile/getHasError'];
            },
            isFilling() {
                return this.$store.getters['profile/getIsTyping'];
            },
            groups() {
                return this.$store.getters['app/groups'];
            },
            maritalStatus() {
                return this.$store.getters['app/maritalStatus'];
            },
            ethnicity() {
                return this.$store.getters['app/ethnicity'];
            },
            morphology() {
                return this.$store.getters['app/morphology'];
            },
            sexualPosition() {
                return this.$store.getters['app/sexualPosition'];
            },
        },
        methods: {
            submit() {
                let payload = {
                    title: this.displayedTitle,
                    description: this.displayedDescription,
                    age: this.displayedAge,
                    height: this.displayedTall,
                    weight: this.displayedWeight,
                };
                this.$store.dispatch('profile/updateProfile', payload)
            },
            typing() {
                this.$store.dispatch('profile/fillingForm')
            }
        }
    }
</script>

<style scoped>

</style>
