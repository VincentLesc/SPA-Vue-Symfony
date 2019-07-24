<template>
    <v-layout
            align-center
            justify-center
    >
        <v-flex shrink>
            <h1>Mes articles de blog</h1>
            <div v-for="post in posts">
                <h3>{{post.title}}</h3>
                <p>{{post.description}}</p>
            </div>
        </v-flex>
    </v-layout>
</template>
<script>
    export default {
        name: 'blog',
        data: () => ({
            posts : [
                {
                    id:1,
                    title: 'Mon titre 1',
                    description: 'Nulla facilisi. Duis quis lorem nisl. Etiam tempus tempus nulla.' +
                        'Suspendisse potenti. Nulla vehicula interdum vestibulum. Etiam lobortis egestas bibendum.' +
                        'Morbi id tellus ultricies, tristique ex eget, molestie sem. Aliquam sagittis imperdiet lorem ac auctor. ' +
                        'Nam ut neque eros. Nullam eget ipsum tincidunt, lobortis nibh non, ultrices purus.'
                },
                {
                    id:2,
                    title: 'Mon titre 2',
                    description: 'Nulla facilisi. Duis quis lorem nisl. Etiam tempus tempus nulla.' +
                        'Suspendisse potenti. Nulla vehicula interdum vestibulum. Etiam lobortis egestas bibendum.' +
                        'Morbi id tellus ultricies, tristique ex eget, molestie sem. Aliquam sagittis imperdiet lorem ac auctor. ' +
                        'Nam ut neque eros. Nullam eget ipsum tincidunt, lobortis nibh non, ultrices purus.'
                },
                {
                    id:3,
                    title: 'Mon titre 3',
                    description: 'Nulla facilisi. Duis quis lorem nisl. Etiam tempus tempus nulla.' +
                        'Suspendisse potenti. Nulla vehicula interdum vestibulum. Etiam lobortis egestas bibendum.' +
                        'Morbi id tellus ultricies, tristique ex eget, molestie sem. Aliquam sagittis imperdiet lorem ac auctor. ' +
                        'Nam ut neque eros. Nullam eget ipsum tincidunt, lobortis nibh non, ultrices purus.'
                },

            ]
        }),
    }
</script>
