<script>

// import axios from 'axios';
// import NavBar from "../components/NavBar.vue";
// import PostCard from "../components/PostCard.vue";

// export default {
//     methods: {
//         handlePostDeleted(deletedPostId) {
//             this.posts = this.posts.filter(post => post.id !== deletedPostId);
//         },
//     },
//     data() {
//         return {
//             posts: [], 
//         };
//     },
//     async created() {
//         await axios.get('http://localhost/instaGame/controller/postController.php?action=getPosts', {
//             headers: {
//                             'Content-Type': 'application/x-www-form-urlencoded',
//                         },
//         } )
//             .then((response) => {
  
//                 this.posts = response.data;

//             })
//             .catch((error) => {
//                 console.error(error);
//             });
//     },
//     components: {
//         NavBar,
//         PostCard,

//     }
// };

import axios from 'axios';
import NavBar from "../components/NavBar.vue";
import PostCard from "../components/PostCard.vue";

export default {
    methods: {
        handlePostDeleted(deletedPostId) {
            this.posts = this.posts.filter(post => post.id !== deletedPostId);
        },
        handlePostAdded(newPostId) {
            axios.get(`http://localhost/instaGame/controller/postController.php?action=getPost&id=${newPostId}`)
                .then((response) => {
                    const newPost = response.data;
                    this.posts.unshift(newPost);
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
    data() {
        return {
            posts: [], 
        };
    },
    async created() {
        await axios.get('http://localhost/instaGame/controller/postController.php?action=getPosts', {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
        })
        .then((response) => {
            this.posts = response.data;
        })
        .catch((error) => {
            console.error(error);
        });
    },
    components: {
        NavBar,
        PostCard,
    }
};

</script>

<template>
    <NavBar/>
    <PostCard @postDeleted="handlePostDeleted" :posts="posts"/>
</template>

<style></style>