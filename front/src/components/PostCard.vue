<script>
import { onMounted } from "vue";
import Comment from "./Comment.vue";
import EditPostModal from "./EditPostModal.vue";
import axios from 'axios';

export default {
  name: "PostCard",
  props: {
    posts: Array,
  },
  components: { Comment, EditPostModal },
  data() {
    return {
      isModalOpenEdit: false,
      selectedPostId: null, // Ajoutez une propriété pour stocker l'ID du post sélectionné
      postProfilPicture: "",
    };
  },
  methods: {
    async deletePost(postId) {
      try {
        await axios.delete(`http://localhost/instaGame/controller/postController.php?action=deletePost&id=${postId}`);
        this.$emit('postDeleted', postId);
        this.$emit('openModalEdit', postId);
      } catch (error) {
        console.error('Erreur lors de la suppression du post :', error);
      }
    },
    // async getProfilPicture(postId) {
    //   try {
    //     const response = await axios.post("http://localhost/instaGame/controller/memberController.php", {
    //       params: {
    //         action: "getProfilPicture",
    //         post_id: postId,
    //       },
    //     });
    //     console.log("-----", response.data);

    //     if (response.data.error) {
    //       this.error = response.data.error;
    //     }
    //   } catch (error) {
    //     console.error(error);
    //     this.error = "Une erreur s'est produite lors de la récupération des photos.";
    //   }
    // },
    openModalEdit() {
      this.isModalOpenEdit = true;
    },
    closeModalEdit() {
      this.isModalOpenEdit = false;
    },
    editPost(postId) { // Fonction pour ouvrir la fenêtre modale et stocker l'ID du post sélectionné
      this.selectedPostId = postId;
      this.openModalEdit();
    },
  },
}
</script>

<template>
  <div class="container">
    <div class="cards" v-for="post in posts" :key="post.id">
      <!-- SINGLE CARD :// -->
      <div class="card-items">
        <div class="card-header">
          <!-- SMALL MODAL  -->
          <div id="smallModal" class="small-modal-post">
            <!-- <div class="overlay-small-modal"></div> -->
            <ul>
              <button @click="deletePost(post.id)">
                <span>Delete</span>
                <i class="fa-regular fa-trash-can"></i></button>
              <button @click="editPost(post.id)"> <!-- Utilisez la fonction editPost pour ouvrir la modale -->
                <span>Edit Post</span>
                <i class="fa-regular fa-pen-to-square"></i>
              </button>
              <button>
                <span>Cancel</span>
                <i class="fa-solid fa-xmark"></i>
              </button>
            </ul>
          </div>
          <!-- END SMALL MODAL  -->
          <div class="pic-profile-nav">
            <img src="/assets/images/E-TAfEiWYAI_Qgu.jpg" alt="profile-pic">
          </div>
          <span class="user-name">{{ post.username }}</span>
          <!-- SMALL MODAL OPEN  -->
          <span class="open-small-modal-post"><i class="fa-solid fa-ellipsis"></i></span>
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
          <Comment :postId="post.id" />
        </div>
      </div>
      <!-- END SINGLE CARD :// -->
      <EditPostModal :isOpenEdit="isModalOpenEdit" :closeModalEdit="closeModalEdit" :postId="selectedPostId" />
    </div>
  </div>
</template>