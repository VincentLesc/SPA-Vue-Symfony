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
                            v-on:keyup="isUniqueEmail"
                            required
                            :error="validEmail"
                    ></v-text-field>
                    {{validEmail}}
                    <v-text-field
                            v-model="password"
                            label="Mot de passe"
                            type="password"
                            required
                    ></v-text-field>
                    <v-text-field
                            v-model="passwordConfirm"
                            label="Confirmation Mot de passe"
                            type="password"
                            required
                    ></v-text-field>
                    <v-btn v-on:click="register">
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
        name: 'registration',
        data: () => ({
            email: '',
            emailErrors: [],
            password: '',
            passwordConfirm: '',
            username: '',
            timeout: '',
            errors: [],
            validEmail: false,

        }),
        computed: {
            seEmailErrors() {
                return this.validEmail ? this.emailErrors()
            }
        },
        methods: {
            register() {

            },
            isUniqueEmail() {
                clearTimeout(this.timeout);
                let self = this;
                this.timeout = setTimeout(function () {
                    let data = {email: self.email};
                    SecurityAPI.isUnique(data)
                        .then( response =>
                            self.validEmail = !response.data
                        )
                        .catch( error => self.errors.push('Service indisponible'))
                }, 1000)

            }
        }
    }
</script>