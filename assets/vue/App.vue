<template>
    <v-app
            id="inspire"
            style="max-height: 100vh;"
    >
        <app-navigation-top
        >
        </app-navigation-top>
        <notifications></notifications>
        <v-content>
                <router-view></router-view>
        </v-content>
        <app-footer></app-footer>
    </v-app>
</template>

<script>
    import AppFooter from './components/app/AppFooter';
    import AppNavigationTopBar from './components/app/AppNavigationTopBar';

    export default {
        props: {
            source: String,
        },
        components: {
            'app-footer': AppFooter,
            'app-navigation-top': AppNavigationTopBar,
        },
        created () {
            this.$vuetify.theme.dark = true;
            let isAuthenticated = JSON.parse(this.$parent.$el.attributes['data-is-authenticated'].value);
            this.$store.dispatch('security/onRefreshAuthentication', isAuthenticated)
                .then(()=>(this.$store.dispatch('profile/loadProfile')))

        }
    }
</script>
<style>
    /* width */
    ::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px #303030;
        border-radius: 10px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: dimgrey;
        border-radius: 10px;
    }
</style>
