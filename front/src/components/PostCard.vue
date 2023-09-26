<script>
import Comment from "./Comment.vue";
import axios from 'axios'; 

export default {
  name: "PostCard",
  props: {
    posts: Array,
  },
  data() {
    return {
      showSmallModal: false,
    };
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
      <!-- SINGLE CARD :// -->
      <div class="card-items">
        <div class="card-header">
          <div class="small-modal-post"  v-if="showSmallModal" @click="showSmallModal = false">
            <ul>
              <button @click="deletePost(post.id)">
                <span>Delete</span>
                <i class="fa-regular fa-trash-can"></i></button>
              <button>
                <span>Edit</span>
                <i class="fa-regular fa-pen-to-square"></i>
              </button>
            </ul>
          </div>
          <div class="pic-profile-nav">
            <img src="/assets/images/E-TAfEiWYAI_Qgu.jpg" alt="profile-pic">
          </div>
          <span class="user-name">{{ post.username }}</span>
          <span @click="showSmallModal = true" class="open-small-modal-post"><i class="fa-solid fa-ellipsis"></i></span>
        </div>
        <div class="card-body">
          <img :src="post.post_picture" alt="post-pic">
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


<style>

</style>