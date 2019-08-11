<template>
    <v-bottom-navigation app>
        <v-btn value="blog" to="/blog">
            <span>Blog</span>
            <v-icon>mdi-newspaper</v-icon>
        </v-btn>

        <v-btn value="favorites">
            <span>Favorites</span>
            <v-icon>favorite</v-icon>
        </v-btn>

        <v-btn value="nearby">
            <span>Nearby</span>
            <v-icon>place</v-icon>
        </v-btn>
    </v-bottom-navigation>
</template>
<script>
    export default {
        name: 'AppFooter'
    }
</script>
