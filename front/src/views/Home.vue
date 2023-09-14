<script>

import axios from 'axios';
import PostCard from "../components/PostCard.vue";



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
                // console.log(response.data);
                // Stockez les données dans la variable "posts"
                this.posts = response.data;
            })
            .catch((error) => {
                console.error(error);
            });
    },
    components: {
        PostCard,
    }
};


</script>

<template>
    <div class="text-black text-4xl">
        <h1>Hooooooome page</h1>
        
        <PostCard :posts="posts"/>
    </div>
</template>

<style></style>