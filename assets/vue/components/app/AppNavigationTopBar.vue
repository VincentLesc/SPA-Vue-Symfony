<template>
    <v-app-bar
            app
            clipped-left
    >
        <v-btn icon to="/user/profile">
            <v-icon>mdi-settings-outline</v-icon>
        </v-btn>

        <v-toolbar-title>Page title</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-menu bottom left offset-y>
            <template v-slot:activator="{ on }">
                <v-btn
                        dark
                        icon
                        v-on="on"
                >
                   <v-avatar>
                       <v-img :src="mainProfilePicture" v-if="isAuthenticated"></v-img>
                       <v-icon v-else>mdi-power</v-icon>
                   </v-avatar>
                </v-btn>
            </template>

            <v-list>
                <v-list-item to="/user/profile" v-if="isAuthenticated">
                    <v-list-item-action>
                        <v-icon>mdi-account</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Profile</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item to="/api/logout" v-on:click="logout" v-if="isAuthenticated">
                    <v-list-item-action>
                        <v-icon>mdi-account-off</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Déconnexion</v-list-item-title>
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
                <v-list-item to="/register" v-if="!isAuthenticated">
                    <v-list-item-action>
                        <v-icon>power_settings_new</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Inscription</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-menu>

    </v-app-bar>
</template>
<script>
    export default {
        name: 'AppNavigationTopBar',
        computed: {
            isAuthenticated () {
                return this.$store.getters['security/isAuthenticated']
            },
            mainProfilePicture () {
                return this.$store.getters['profile/getMainPicture'] ?
                    this.$store.getters['profile/getMainPicture'].file :
                    require('../../../images/image-placeholder-350x350.png');
            }
        },
        methods: {
            logout () {
                return this.$store.dispatch('security/logout');
            }
        }
    }
</script>
