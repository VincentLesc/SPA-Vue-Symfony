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
                            :error-messages="emailErrors"
                    ></v-text-field>
                    <v-text-field
                            v-model="password"
                            label="Mot de passe"
                            type="password"
                            v-on:keyup="isStrongPassword"
                            :color="passwordStrong"
                            :messages="passwordMessage"
                            :error="validPassword"
                            required
                    ></v-text-field>
                    <v-text-field
                            v-model="passwordConfirm"
                            label="Confirmation Mot de passe"
                            type="password"
                            v-on:keyup="isSamePassword"
                            :error="validConfirmPassword"
                            :error-messages="passwordConfirmMessage"
                            required
                    ></v-text-field>
                    <v-btn
                            v-on:click="register"
                            :disabled="validForm"
                    >
                        Inscription
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
            passwordStrong: '',
            passwordMessage: '',
            passwordConfirmMessage: '',
            username: '',
            timeout: '',
            errors: [],
            validEmail: false,
            validPassword: false,
            validConfirmPassword: false,
            validForm: false
        }),
        created() {
            if (this.$store.getters['security/isAuthenticated']) {
                this.$router.push('/home')
                this.$notify({
                    type: 'warn',
                    duration: 5000,
                    closeOnClick : true,
                    title: 'Vous êtes déjà connecté !',
                })
            }
        },
        methods: {
            register() {
                let data = {
                    email: this.email,
                    plainPassword: this.password,
                    username: this.username
                };
                this.$store.dispatch('security/register', data)
                    .then(response => {
                        this.$router.push('/home');
                        this.$notify({
                            type: 'success',
                            duration: 5000,
                            closeOnClick : true,
                            title: 'Bonjour '+ this.$store.getters['security/getUsername'],
                            text: 'Vous êtes bien inscrit et connecté ! '
                        })
                    })
                    .catch(() => this.$notify({
                            type: 'error',
                            duration: 5000,
                            closeOnClick : true,
                            title: 'Erreur !',
                            text: 'Une erreur s\'est produite, merci de vérifier vos données.'
                        }))
            },
            isUniqueEmail() {
                clearTimeout(this.timeout);
                let self = this;
                this.timeout = setTimeout(function () {
                    let data = {email: self.email};
                    SecurityAPI.isUnique(data)
                        .then( response =>  {
                                self.validEmail = !response.data;
                                self.validEmail === true ? self.emailErrors.push('Email non disponible') : self.emailErrors = [];
                            }
                        )
                        .catch( error => self.errors.push('Service indisponible'))
                }, 500)
                this.isValidForm();
            },
            isStrongPassword() {
                let self = this;
                let strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                let mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

                if (strongRegex.test(self.password)) {
                    self.passwordStrong = 'green';
                    self.validPassword = false;
                    self.passwordMessage = '';
                } else if (mediumRegex.test(self.password)) {
                    self.passwordStrong= 'orange';
                    self.validPassword = false;
                    self.passwordMessage = 'Votre mot de passe pourrais être plus sécurisé';
                } else {
                    self.passwordStrong = '';
                    self.validPassword = true;
                    self.passwordMessage = 'Votre message doit contenir au moins un caractère spécial et une majuscule';
                }
                this.isValidForm();
            },
            isSamePassword() {
                if (this.password !== this.passwordConfirm) {
                    this.passwordConfirmMessage ='Les deux mots de passe ne sont pas identiques';
                    this.validConfirmPassword = true;
                } else {
                    this.passwordConfirmMessage ='';
                    this.validConfirmPassword = false;
                }
                this.isValidForm();
            },
            isValidForm() {
                if (!this.validConfirmPassword && !this.validEmail && !this.validPassword) {
                    this.validForm = false;
                } else {
                    this.validForm = true;
                }
            }
        },
    }
</script>
