<template>
  <div>
    <div class="flex justify-between" v-for="(comment, index) in comments.slice(0, showAllComments ? comments.length : 3)" :key="index">
      <p class="description">
        <strong>{{ comment.username }} : </strong>{{ truncateText(comment.comment) }} 
      </p>
      <button v-if="currentUser && currentUser.id === comment.user_id" @click="deleteComment(index)"><i class="fa-regular fa-trash-can"></i></button>
    </div>

    <!-- Afficher le bouton "See more" ou "See less" en fonction de l'état -->
    <button @click="toggleCommentsDisplay">
      {{ showAllComments ? "See less" : "See more" }}
    </button>


    <div class="comment-input p-1 mt-3 flex">
      <input class="bg-orange-100 p-2 rounded-xl w-3/4" v-model="commentText" type="text" name="comment" id="comment" placeholder="Add a comment..." />
      <div class="ml-4">
        <button @click="addComment" class="text-3xl transform hover:scale-110 transition-transform"><i class="fa-solid fa-square-plus"></i></button>
      </div>
    </div>

  </div>
</template>

<script>

import axios from "axios";

export default {
  props: {
    postId: Number, // Déclarez la prop postId ici
  },
  data() {
    return {
      currentUser: null,
      commentText: "",
      error: "",
      comments: [], // Tableau pour stocker les commentaires
      showAllComments: false,
    };
  },

  computed: {
    displayedComments() {
      return this.showAllComments ? this.comments : this.comments.slice(0, 3);
    },
  },

  methods: {

    truncateText(text) {
    const maxLength = 40;
    if (text.length > maxLength) {
      return text.substring(0, maxLength) + '...';
    }
    return text;
  },

    toggleCommentsDisplay() {
      this.showAllComments = !this.showAllComments;
    },

    async getCurrentUser() {
      try {
        const instance = axios.create({
          baseURL: "http://localhost/instaGame/controller/",
          withCredentials: true,
        });

        const response = await instance.get("commentController.php", {
          params: {
            action: "getUserInfo",
          },
        });
        console.log('Current user:', response.data.username);
        if (response.data.id) {
          // Vous pouvez stocker les informations de l'utilisateur dans la variable currentUser
          this.currentUser = response.data.username;
          // console.log(this.currentUser);
        } else {
          console.error("Unable to get current user information.");
        }
      } catch (error) {
        console.error(error);
      }
    },


    //---------------------

    async getUsernameForComment(commentId) {
      try {
        const instance = axios.create({
          baseURL: "http://localhost/instaGame/controller/",
          withCredentials: true,
        });

        const response = await instance.get("commentController.php", {
          params: {
            action: "getUsernameForComment",
            commentId: commentId,
          },
        });

        if (response.data.username) {
          console.log('----->', response.data.username);
          return response.data.username;
        } else {
          console.error("Unable to get username for comment.");
          return null;
        }
      } catch (error) {
        console.error(error);
        return null;
      }
    },

    //--------------------

    async deleteComment(index) {
      const commentId = this.comments[index].id; // Assurez-vous d'avoir une propriété "id" dans chaque commentaire

      try {
        const instance = axios.create({
          baseURL: "http://localhost/instaGame/controller/",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          withCredentials: true,
        });
        const response = await instance.delete("http://localhost/instaGame/controller/commentController.php", {
          params: {
            action: "deleteComment",
            id: commentId,
          },
        });
        // console.log(response);

        // const formData = new FormData();
        // formData.append("action", "deleteComment");
        // formData.append("id", commentId);

        // const response = await instance.delete("commentController.php", {
        //   data: formData,
        // });


        // Supprimez le commentaire du tableau des commentaires
        this.comments.splice(index, 1);
        if (response.data.error) {
          console.error(response.data.error);
        }
      } catch (error) {
        console.error(error);
      }
    },

    //(-------------------------------------)

    async getComments() {
  try {
    const response = await axios.get("http://localhost/instaGame/controller/commentController.php", {
      params: {
        action: "getComments",
        post_id: this.postId,
      },
    });

    if (response.data.error) {
      this.error = response.data.error;
    } else {
      // Mettez à jour le tableau des commentaires avec les commentaires récupérés
      for (let i = 0; i < response.data.length; i++) {
        if (response.data[i].post_id == this.postId) {
          const comment = response.data[i];
          comment.username = await this.getUsernameForComment(comment.id);
          this.comments.push(comment);
        }
      }
    }
  } catch (error) {
    console.error(error);
    this.error = "Une erreur s'est produite lors de la récupération des commentaires.";
  }
},

    //----------------

    async addComment() {
  if (!this.commentText) {
    this.error = "Le texte du commentaire est requis.";
    return;
  }

  const instance = axios.create({
    baseURL: "http://localhost/instaGame/controller/",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
      "Content-Type": "multipart/form-data",
    },
    withCredentials: true,
  });

  const formData = new FormData();
  formData.append("action", "addComment");
  formData.append("post_id", this.postId);
  formData.append("comment", this.commentText);

  try {
    const response = await instance.post("commentController.php", formData);

    if (response.data.error) {
      this.error = response.data.error;
    } else {
      
      // Utilisez directement this.currentUser.username pour le nouveau commentaire
      const newComment = {
        comment: this.commentText,
        user_id: this.currentUser.id,
        username: this.currentUser.username
      };

      // Ajoutez le nouveau commentaire au début du tableau
      this.comments.unshift(newComment);

      // Effacez le champ de texte de commentaire
      this.commentText = "";
    }
  } catch (error) {
    console.error(error);
    this.error = "Une erreur s'est produite lors de l'ajout du commentaire.";
  }
},
  },

  created() {
    this.getCurrentUser()
    this.getComments();

  },
};
</script>

<style>
.error-message {
  color: rgb(250, 108, 108);
  margin: 0 0 30px 0;
}
</style>

