<template>
    <v-app-bar
            app
            clipped-left
    >
        <v-app-bar-nav-icon v-on:click="$emit('switch-drawer')"><v-icon>menu</v-icon></v-app-bar-nav-icon>
        <v-toolbar-title>Application</v-toolbar-title>
    </v-app-bar>
</template>
<script>
    export default {
        name: 'AppNavigationTopBar',
    }
</script>