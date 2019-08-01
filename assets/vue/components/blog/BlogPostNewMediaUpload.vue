<template>
    <v-layout justify-center>
        <v-dialog v-model="dialog" persistent max-width="600px">
            <template v-slot:activator="{ on }">
                <v-btn color="primary" dark v-on="on">Open Dialog</v-btn>
            </template>
            <v-card>
                <v-card-title>
                    <span class="headline">Télécharger une image</span>
                </v-card-title>
                <v-layout wrap>
                    <v-flex xs12>
                        <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                        <v-text-field
                                label="Description de l'image"
                                v-on:change="handleFileUpload"
                                v-model="alt"
                                class="ma-2"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
                    <v-btn color="blue darken-1" text @click="submitFile">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
</template>
<script>
    import axios from 'axios';

    export default {
        name: 'post-media-dialog',
        data: () => ({
            dialog:false,
            file : '',
            alt : ''
        }),
        methods: {
            submitFile() {
                let formData = new FormData();
                formData.append('file', this.file);
                console.log(formData.getAll('file'));
                axios.post(
                    '/api/post/media',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                )
                    .then(()=>(console.log('Upload done')))
            },
            handleFileUpload(){
                console.log('toto');
                this.file = this.$refs.file.files[0];
                console.log(this.file)
            },
            test(){
              console.log('change')
            }
        }
    }
</script>