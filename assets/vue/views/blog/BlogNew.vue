<template>
    <v-layout justify-center class="overflow-auto" raw style="max-height: 90%">
        <v-flex xs8 text-center>
            <h1 class="ma-3">Nouvel article</h1>
            <v-card
                    class="md6 pa-5 overflow-auto"
            >
                <v-form
                >
                    <v-text-field
                            v-model="title"
                            :counter="64"
                            label="Titre"
                            required
                    ></v-text-field>
                    <v-textarea
                            v-model="content"
                            label="Corps de l'article"
                            auto-grow
                            required
                    ></v-textarea>
                    <v-img :src="media"></v-img>
                    <media-upload
                            class="ma-2"
                            v-on:media-uploaded="mediaUploaded"
                    >
                    </media-upload>
                    <v-btn v-on:click="create">
                        Enregistrer
                    </v-btn>
                </v-form>
            </v-card>
        </v-flex>
    </v-layout>
</template>
<script>
    import PostAPI from '../../api/post';
    import PostMediaUpload from '../../components/blog/BlogPostNewMediaUpload';

    export default {
        name: 'blog-create',
        components : {
            'media-upload': PostMediaUpload
        },
        data: () => ({
            title: '',
            content: '',
            media: '',
            mediaId: 0
        }),
        methods: {
            create() {
                let data = {title: this.title, content: this.content, media: {id: this.mediaId, file: this.media}};
                PostAPI.create(data)
                    .then(() => (this.$router.push('/blog')))
                    .catch(() => (
                        this.$notify({
                        title: 'Erreur lors de l\'enregistrement',
                        text: 'Une erreur s\'est produite, veuillez réessayer ultérieurement.'
                    })))
            },
            mediaUploaded(media) {
                this.mediaId = JSON.parse(media.data).id;
                console.log(this.mediaId);
                return this.media = JSON.parse(media.data).file;
            }
        }
    }
</script>
