<template>
    <div class="container-all-forms">
        <div class="form-container">
            <form class="form-items" @submit.prevent="submitForm">
                <h2>SIGN UP</h2>
                <div class="input">
                    <input v-model="formData.username" class="" type="text" name="username" placeholder="Type your Username">
                </div>
                <div class="input">
                    <input v-model="formData.email" class="" type="text" name="email"
                    placeholder="Type your Email">
                </div>  
                <div class="input">
                    <input v-model="formData.password" class="" type="password" name="password"
                        placeholder="Type your Password">
                </div> 
                <label class="input-file" for="file">
                        <input type="file" name="file" id="file">
                </label>
                <button class="button" type="submit" >Sign Up</button>
            </form>
        </div>
    </div>
</template>
  
<script>

import axios from 'axios';

export default {
    data() {
        return {
            formData: {
                action: "addMember",
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
                    const response = await axios.post('http://localhost/instaGame/controller/memberController.php?action=addMember', this.formData, {
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