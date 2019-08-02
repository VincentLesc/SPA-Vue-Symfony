<template>
    <v-container
            fluid
            grid-list-md
            id="scroll"
            style="max-height: 100vh;"
            class="overflow-y-auto"
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
        <section
                v-else
        >
            <v-layout
                    v-scroll:#scroll="onScroll"
                    wrap
                    justify-content-between
            >
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
                        :id="post.id"
                >
                    <v-card
                            class="pa-3 flex-grow-1 fill-height"
                    >
                        <v-layout align-space-between column fill-height>
                            <v-card-title>{{post.title}}</v-card-title>
                            <v-card-text>{{post.content.slice(0, 350) + '...'}}</v-card-text>
                            <v-spacer></v-spacer>
                            <v-card-text class="text-right align-baseline ma-auto" >
                                <small>{{post.author.username}}</small>
                                <v-spacer></v-spacer>
                                <small>{{post.createdAt | date}}</small>
                            </v-card-text>
                        </v-layout>
                    </v-card>
                </v-flex>
            </v-layout>
        </section>
    </v-container>
</template>
<script>
    import PostAPI from '../../api/post';
    import moment from 'moment';

    export default {
        name: 'blog',
        data: () => ({
            posts : [],
            error: '',
            loading: true,
            offset : 0
        }),
        created(){
            let data = {offset: this.offset};
            PostAPI.getAll(data)
                .then(response =>
                    this.posts = response.data,
                )
                .then( () => this.offset = this.posts.length
                )
                .catch(error => this.error = error)
                .finally(() => this.loading = false)
        },
        computed: {
            hasError() {
                return this.error !== '';
            },
        },
        methods: {
            onScroll(e) {
                let level = (e.target.scrollHeight - e.target.scrollTop -e.target.clientHeight);
                if (level < 100 && this.loading === false) {
                    this.loading = true;
                    let data = {offset: this.offset};
                    PostAPI.getAll(data)
                        .then(response =>
                            this.posts = this.posts.concat(response.data),
                        )
                        .catch(error => this.error = error)
                        .finally(() => this.loading = false)
                }
            },
        },
        filters: {
            date: function (value) {
                if (value) {
                    return moment(String(value)).format('DD/MM/YYYY hh:mm')
                }
            }
        }
    }
</script>
