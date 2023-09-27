<script setup>
import axios from 'axios';
import { ref, defineProps, withCtx } from 'vue';

const { isOpen, closeModal } = defineProps(['isOpen', 'closeModal']);


const formData = new FormData();
const error = ref('');

const submitForm = async () => {
  if (!formData.get('file')) {
    error.value = "The image is required.";
    return;
  }
  const instance = axios.create({
  baseURL: "http://localhost/instaGame/controller/",
  headers: {
    "Content-Type": "application/x-www-form-urlencoded",
    'Content-Type': 'multipart/form-data',
  },
  withCredentials: true,
});

try {
    formData.append('action', 'addPost');
    formData.append('description', formData.description || '');
    const response = await instance.post("postController.php", formData);


  // try {
  //   formData.append('action', 'addPost');
  //   formData.append('description', formData.description || '');
  //   const response = await axios.post('http://localhost/instaGame/controller/postController.php', formData, {
  //     headers: {
  //       'Content-Type': 'multipart/form-data',
  //     },
  //   });

    if (response.data.error) {
      error.value = response.data.error;
    } else {
      console.log("Server Response", response.data);
      closeModal(); 
      window.location.reload();
    }
  } catch (error) {
    console.error(error);
    error.value = "An error occurred while submitting the form.";
  }
};

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  formData.set('file', file);
};
</script>

<style>
.error-message {
  color: rgb(250, 108, 108);
  margin: 0 0 30px 0;
}
</style>

<template>
  <div class="post-container" v-if="isOpen">
    <div @click="closeModal" class="overlay-small-modal"></div>
    <button @click="closeModal" class="close-modal-post-btn"><i class="fa-solid fa-x"></i></button>
    <div class="form-container-post">
      <div class="post-header"><h2>Create new post</h2></div>
      <form @submit.prevent="submitForm" enctype="multipart/form-data" class="form-items post-form">
        <textarea v-model="formData.description" name="description" placeholder="Write a caption..."></textarea>
        <div>
          <label class="input-file" for="file">
            <input @change="handleImageUpload" type="file" name="file" id="file">
          </label>
        </div>
        <div v-if="error" class="error-message">{{ error }}</div>
        <button class="button btn-save-post" type="submit">Share</button>
      </form>
    </div>
  </div>
</template>