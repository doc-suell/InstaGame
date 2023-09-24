<script setup>
import axios from 'axios';
import { ref, defineEmits, defineProps } from 'vue';
const { isOpen } = defineProps(['isOpen', 'closeModal']);
const handleCloseModal = () => {
  closeModal();
};

const formData = new FormData();

const submitForm = async () => {
  try {
    formData.append('action', 'addPost');
    formData.append('description', formData.description);
    formData.append('file', formData.postPicture);
    const response = await axios.post('http://localhost/instaGame/controller/postController.php', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });
    console.log("Server Response", response.data);
  } catch (error) {
    // console.error(error);
  }
};

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  formData.set('file', file);
};

</script>

<template>
    <div class="post-container" v-if="isOpen">
        <button @click="closeModal" class="close-modal-post-btn"><i class="fa-solid fa-x"></i></button>
        <div class="form-container-post">
            <div class="post-header"><h2>Create new post</h2></div>
            <form @submit.prevent="submitForm" enctype="multipart/form-data" class="form-items post-form">
                    <textarea v-model="formData.description" name="description" placeholder="Write a caption..."></textarea>
                <div>
                    <label class="input-file" for="file">
                    <input  @change="handleImageUpload" type="file" name="file" id="file">
                    </label>
                </div>
                <button class="button btn-save-post" type="submit">Share</button>
            </form>
        </div>
    </div>
</template>