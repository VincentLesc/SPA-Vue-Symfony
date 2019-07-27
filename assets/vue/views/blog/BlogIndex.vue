<template>
    <v-layout
            align-center
            justify-center
    >
        <v-flex shrink>
            <h1>Mes articles de blog</h1>

            <section v-if="hasError">
                <v-alert
                        border="left"
                        color="red"
                        elevation="2"
                >
                    <v-icon>error</v-icon>
                    Oupss...Ce service est indisponible pour le moment
                </v-alert>
            </section>
            <section v-else>
                <div v-if="loading">
                    <v-progress-linear
                            indeterminate
                            color="cyan"
                    ></v-progress-linear>
                </div>
                <div v-for="post in posts">
                    <h3>{{post.title}}</h3>
                    <p>{{post.content}}</p>
                </div>
            </section>
        </v-flex>
    </v-layout>
</template>
<script>
    import PostAPI from '../../api/post';

    export default {
        name: 'blog',
        data: () => ({
            posts : [],
            error: '',
            loading: true

        }),
        created(){
            PostAPI.getAll()
                .then(response => this.posts = response.data)
                .catch(error => this.error = error)
                .finally(() => this.loading = false)
        },
        computed: {
            hasError() {
                return this.error !== '';
            }
        }
    }
</script>
