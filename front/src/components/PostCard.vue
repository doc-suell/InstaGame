<script>
import Comment from "./Comment.vue";

import axios from 'axios'; 

// export default {
//   methods: {
//   async deletePost(postId) {
//     try {
//       // Faites une requête HTTP DELETE au backend pour supprimer le post.
//       await axios.delete(`http://localhost/instaGame/controller/postController.php?action=deletePost&id=${postId}`);
//       // Après la suppression réussie, mettez à jour votre liste de posts pour refléter les changements.
//       this.$emit('postDeleted', postId); // Émettez un événement pour indiquer au composant parent de mettre à jour les données.
//     } catch (error) {
//       console.error('Erreur lors de la suppression du post :', error);
//     }
//   },
// },
//   name: "PostCard",
//   props: {
//     posts: Array,
//   },
//   components: { Comment },
//   created() {
//     this.posts.forEach(post => {
//       console.log("here PIC",post.postPicturePath);
//       // console.log("here description",post.description);
//       console.log("Post ID",post.id);
      
//     });
//   },
// };

export default {
  name: "PostCard",
  props: {
    posts: Array,
  },
  components: { Comment },
  methods: {
    async deletePost(postId) {
  try {
    await axios.delete(`http://localhost/instaGame/controller/postController.php?action=deletePost&id=${postId}`);
    this.$emit('postDeleted', postId);
  } catch (error) {
    console.error('Erreur lors de la suppression du post :', error);
  }
}
  },
};

</script>


<template>
  
  <div class="container">
    
    <div class="cards" v-for="post in posts" :key="post.id">
      <button @click="deletePost(post.id)">suprimer</button>
      <!-- SINGLE CARD :// -->
      <div class="card-items">
        <div class="card-header">
          <div class="pic-profile-nav">
            <img src="/assets/images/E-TAfEiWYAI_Qgu.jpg" alt="profile-pic"></div>
            <span class="user-name">{{ post.username }}</span>
          <span><i class="fa-solid fa-ellipsis"></i></span>
        </div>
        <div class="card-body">
          <img :src="post.post_picture"  alt="post-pic">
        </div>
        <div class="card-footer">
          <div class="card-footer-icons">
            <i class="fa-regular fa-heart"></i>
            <i class="fa-regular fa-comment"></i>
          </div>
          <span class="card-footer-icons"><i class="fa-regular fa-bookmark"></i></span>
        </div>
        <p class="description">{{ post.description }}</p>
        <div class="comment">
          <Comment />
        </div>
      </div>
      <!-- END SINGLE CARD :// -->
    </div>
  </div>

  
</template>

