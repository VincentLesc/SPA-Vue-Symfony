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
        </v-list>
    </v-navigation-drawer>
</template>
<script>
    export default {
        name: 'AppNavigationDrawer'
    }
</script>