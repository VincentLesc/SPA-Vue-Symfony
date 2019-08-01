<template>
    <v-navigation-drawer
            app
            clipped
    >
        <v-list dense>
            <v-list-item to="/">
                <v-list-item-action>
                    <v-icon>home</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Accueil</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-list-item to="/blog">
                <v-list-item-action>
                    <v-icon>menu</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Blog</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-list-item to="/blog/new" v-if="isAuthenticated">
                <v-list-item-action>
                    <v-icon>edit</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Blog - Nouvel article </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-list-item to="/login" v-if="!isAuthenticated">
                <v-list-item-action>
                    <v-icon>power_settings_new</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Connexion</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-list-item to="/api/logout" v-on:click="logout" v-else>
                <v-list-item-action>
                    <v-icon>power_settings_new</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Déconnexion</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>
<script>
    export default {
        name: 'AppNavigationDrawer',
        computed: {
            isAuthenticated () {
                return this.$store.getters['security/isAuthenticated']
            },
        },
        methods: {
            logout () {
                return this.$store.dispatch('security/logout');
            }
        }
    }
</script>
