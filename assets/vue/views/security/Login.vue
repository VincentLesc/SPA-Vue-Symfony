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
        created() {
          if (this.$store.getters['security/isAuthenticated']) {
              this.$router.push('/home');
              this.$notify({
                  type: 'success',
                  duration: 5000,
                  closeOnClick : true,
                  title: 'Vous êtes déjà connecté !',
              })
          }
        },
        methods: {
            login(){
                let data = {email: this.email, plainPassword: this.password};
                this.$store.dispatch('security/login', data)
                    .then(() => this.$router.push('/home'))
                    .then(()=>(this.$store.dispatch('profile/loadProfile')))
                    .then(() => this.$notify({
                        type: 'success',
                        duration: 5000,
                        closeOnClick : true,
                        title: 'Bonjour '+ this.$store.getters['security/getUsername'],
                        text: 'Vous êtes bien connecté, cela fait plaisir de vous voir ;-)'
                    }))
                    .catch(() => this.$notify({
                        type: 'error',
                        duration: 5000,
                        closeOnClick : true,
                        title: 'La connexion a échouée',
                        text: 'Vérifiez vos identifiants, votre connexion, ou revenez plus tard ;-)'
                    }))
            }
        }
    }
</script>
