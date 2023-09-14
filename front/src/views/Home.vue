<script>

import axios from 'axios';

export default {
    data() {
        return {
            posts: [], // Pour stocker les données récupérées
        };
    },
    async created() {
        // Lorsque le composant est créé, envoyez une requête pour obtenir les données
        await axios.get('http://localhost/instaGame/controller/postController.php?action=getPosts', {
            headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
        } )
            .then((response) => {
                console.log(response.data);
                // Stockez les données dans la variable "posts"
                this.posts = response.data;
            })
            .catch((error) => {
                console.error(error);
            });
    },
};


</script>

<template>
    <div class="text-black text-4xl">
        <h1>Hooooooome page</h1>
        <PostCard/>
    </div>
</template>

<style></style>