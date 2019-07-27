<template>
    <v-container
            fluid
            grid-list-md
    >
        <v-layout
                align-center
                justify-center
        >
            <h1 class="mb-5">Mes articles de blog</h1>
        </v-layout>
        <section
                v-if="hasError"
        >
            <v-layout
                    justify-center
                    align-center
            >
                <v-alert
                        border="left"
                        color="red"
                        elevation="2"
                >
                    <v-icon>error</v-icon>
                    Oupss...Ce service est indisponible pour le moment
                </v-alert>
            </v-layout>
        </section>
        <section v-else>
            <v-layout wrap justify-content-between>
                <v-progress-linear
                        v-if="loading"
                        indeterminate
                        color="cyan"
                        xs6
                ></v-progress-linear>
                    <v-flex
                            v-for="post in posts"
                            :key="post.id"
                            d-flex
                            md4
                            xs12
                            class="pa-1"
                    >
                        <v-card
                             class="pa-3"
                        >
                            <h3 class="mb-5">{{post.title}}</h3>
                            <p>{{post.content}}</p>
                        </v-card>
                    </v-flex>
            </v-layout>
        </section>
    </v-container>
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
