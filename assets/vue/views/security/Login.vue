<template>
    <v-layout justify-center fill-height raw>
        <v-flex xs8 text-center>
            <h1 class="ma-3">Connexion</h1>
            <v-card
                    class="md6 pa-5"
            >
                <v-form
                >
                    <v-text-field
                            v-model="email"
                            label="E-mail"
                            type="email"
                            :rules="emailRules"
                            required
                    ></v-text-field>
                    <v-text-field
                            v-model="password"
                            label="Mot de passe"
                            type="password"
                            :rules="passwordRules"
                            required
                    ></v-text-field>
                    <v-btn v-on:click="login">
                        Se connecter
                    </v-btn>
                </v-form>
            </v-card>
        </v-flex>
    </v-layout>
</template>
<script>
    import SecurityAPI from '../../api/security';

    export default {
        name: 'login',
        data: () => ({
            email : '',
            emailRules: [
                v => !!v || 'E-mail est obligatoire',
            ],
            password : '',
            passwordRules: [
                v => !!v || 'Mot de passe obligatoire',
            ]
        }),
        methods: {
            login(){
                let data = {email: this.email, plainPassword: this.password};
                SecurityAPI.login(data)
                    .then(() => (
                        this.$notify({
                            title: 'Vous êtes connecté !',
                            type: 'success'
                        })
                    ))
                    .catch(() => (
                        this.$notify({
                            title: 'Erreur lors de votre identification !',
                            type: 'error'
                        })
                    ))
            }
        }
    }
</script>
