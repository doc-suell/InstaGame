<!-- DEAD CODE ALREADY USED -->



<!-- <template>
    <div>
        <h1 class="text-center">Create Post Page</h1>
        <form class="flex flex-col align-center" @submit.prevent="submitForm" enctype="multipart/form-data">
            <input v-model="formData.description" class="border border-black w-[30%] mx-auto" type="text" name="description"
                placeholder="Description">
            <input @change="handleImageUpload" type="file" name="file" id="file">
            <button class="border border-black w-[30%] mx-auto" type="submit">Go</button>
        </form>
    </div>

    
</template> -->
  
<!-- <script>
import axios from 'axios';

export default {
    data() {
        return {
            formData: new FormData(),
        };
    },
    // https://www.appsloveworld.com/vuejs/100/96/how-to-async-await-multiple-uploads-before-final-form-submit
    methods: {
        async submitForm() {
            try {
                this.formData.append('action', 'addPost');
                this.formData.append('description', this.formData.description);
                this.formData.append('file', this.formData.postPicture);
                const response = await axios.post('http://localhost/instaGame/controller/postController.php', this.formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                console.log("Server Response", response.data);
            } catch (error) {
                console.error(error);
            }
        },
        handleImageUpload(event){
            const file = event.target.files[0];
            this.formData.set('file', file);
            // console.log(file);
        }
    }
};
</script>
  
<style></style> -->


<script>
</script>

<template>
    
</template>