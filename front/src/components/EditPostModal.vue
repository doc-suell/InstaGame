<script setup>
import axios from 'axios';
import { ref, defineProps } from 'vue';

const { isOpenEdit, closeModalEdit } = defineProps(['isOpenEdit', 'closeModalEdit']);

const formData = new FormData();
const error = ref('');
const postId = ref(null); 
const newDescription = ref(''); 

const submitForm = async () => {
  if (!newDescription.value) {
    error.value = "The description is required.";
    return;
  }

  try {
    const response = await axios.put(`http://localhost/instaGame/controller/postController.php?action=editPost&id=${postId.value}`, { new_description: newDescription.value });
    
    if (response.data.error) {
      error.value = response.data.error;
    } else {
      console.log("Server Response", response.data);
      closeModalEdit();
      window.location.reload();
    }
  } catch (error) {
    console.error(error);
    error.value = "An error occurred while submitting the form.";
  }
};
</script>

<style>
</style>

<template>
  <div class="post-container" v-if="isOpenEdit">
    <div @click="closeModalEdit" class="overlay-small-modal"></div>
    <button @click="closeModalEdit" class="close-modal-post-btn"><i class="fa-solid fa-x"></i></button>
    <div class="form-container-post">
      <div class="post-header"><h2>Edit post</h2></div>
      <form @submit.prevent="submitForm" enctype="multipart/form-data" class="form-items post-form">
        <textarea v-model="formData.description"  name="description" placeholder="Write a caption..."></textarea>
        <div>
          <label class="input-file" for="file">
            <input @change="handleImageUpload"  type="file" name="file" id="file">
          </label>
        </div>
        <button class="button btn-save-post" type="submit">Edit</button>
      </form>
    </div>
  </div>
</template>