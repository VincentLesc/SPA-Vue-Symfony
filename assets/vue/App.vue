<template>
    <v-app id="inspire">
        <app-navigation-drawer
                v-if="drawer"
        >
        </app-navigation-drawer>
        <app-navigation-top
                v-on:switch-drawer="drawer = !drawer"
        >
        </app-navigation-top>
        <v-content>
                <router-view></router-view>
        </v-content>
        <app-footer></app-footer>
    </v-app>
</template>

<script>
    import AppFooter from './components/app/AppFooter';
    import AppNavigationDrawer from './components/app/AppNavigationDrawer';
    import AppNavigationTopBar from './components/app/AppNavigationTopBar';

    export default {
        props: {
            source: String,
        },
        components: {
            'app-footer': AppFooter,
            'app-navigation-drawer': AppNavigationDrawer,
            'app-navigation-top': AppNavigationTopBar,
        },
        data: () => ({
            drawer: true,
        }),
        created () {
            this.$vuetify.theme.dark = true
        },
    }
</script>
