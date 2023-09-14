<template>
    <div>
        <h1 class="text-center">Create Post Page</h1>
        <form class="flex flex-col align-center" @submit.prevent="submitForm">
            <input v-model="formData.postPicture" class="border border-black w-[30%] mx-auto" type="text" name="username"
                placeholder="postPicture">
            <input v-model="formData.description" class="border border-black w-[30%] mx-auto" type="text" name="email"
                placeholder="description">
            <input v-model="formData.user_id" class="border border-black w-[30%] mx-auto" type="text" name="user_id"
                placeholder="user_id">
            <button class="border border-black w-[30%] mx-auto" type="submit">Go</button>
        </form>
    
    </div>
</template>
  
<script>

import axios from 'axios';

export default {
    data() {
        return {
            formData: {
                action: "addPost",
                username: "",
                email: "",
                password: "",
            }
        };
    },
    methods: {
        async submitForm() {

            {
                try {
                    const response = await axios.post('http://localhost/instaGame/controller/postController.php?action=addPost', this.formData, {
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                    });
                    console.log("fffffffff",response.data);
                } catch (error) {
                    console.error(error);
                }
            }

        }
    }
};
</script>
  
<style></style>