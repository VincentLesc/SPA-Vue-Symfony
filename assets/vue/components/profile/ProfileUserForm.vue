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
                    v-model="displayedGroups"
                :items="groupsChoices"
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
                    v-model="displayedMaritalStatus"
                :items="maritalStatusChoices"
                item-text="title"
                item-value="id"
                label="Situation amoureuse"
            >
            </v-select>
        </v-flex>
        <v-flex xs6>
            <v-select
                    v-model="displayedEthnicity"
                :items="ethnicityChoices"
                item-text="title"
                item-value="id"
                label="Origine"
            >
            </v-select>
        </v-flex>
        <v-flex xs6>
            <v-select
                    v-model="displayedMorphology"
                :items="morphologyChoices"
                item-text="title"
                item-value="id"
                label="Morphologie"
            >
            </v-select>
        </v-flex>
        <v-flex xs6>
            <v-select
                    v-model="displayedSexualPosition"
                :items="sexualPositionChoices"
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
            weight: Number,
            marital: Object,
            groups: Array,
            ethnicity: Object,
            morphology: Object,
            sexualPosition: Object
        },
        data(){
            return{
                displayedTitle: this.title,
                displayedDescription: this.description,
                displayedAge: this.age,
                displayedTall: this.height,
                displayedWeight: this.weight,
                displayedMaritalStatus: this.marital ? this.marital.id : null,
                displayedGroups: this.groups,
                displayedEthnicity: this.ethnicity ? this.ethnicity.id : null,
                displayedMorphology: this.morphology ? this.morphology.id : null,
                displayedSexualPosition: this.sexualPosition ? this.sexualPosition.id: null,
                shownAge: this.showAge,
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
            groupsChoices() {
                return this.$store.getters['app/groups'];
            },
            maritalStatusChoices() {
                return this.$store.getters['app/maritalStatus'];
            },
            ethnicityChoices() {
                return this.$store.getters['app/ethnicity'];
            },
            morphologyChoices() {
                return this.$store.getters['app/morphology'];
            },
            sexualPositionChoices() {
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
                    maritalStatus: this.displayedMaritalStatus,
                    groups: this.displayedGroups,
                    ethnicity: this.displayedEthnicity,
                    morphology: this.displayedMorphology,
                    sexualPosition: this.displayedSexualPosition
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
