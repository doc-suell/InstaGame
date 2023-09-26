<script>

import axios from "axios";

const instance = axios.create({
  baseURL: "http://localhost/insta/instaGame/controller/",
  headers: {
    "Content-Type": "application/x-www-form-urlencoded",
  },
  withCredentials: true,
});


export default {
    setup() {
        return {
            formData: {
                action: "checkConnection",
            },
            loginError: false,            
        };
    },
     methods: {
        async checkConnection() {
            try {
                const response = await instance.post(
                    "memberController.php",
                    this.formData,                
                );
                console.log(response);
            } catch (error) {
                console.error(error);
            }
        },
     },

    mounted() {

        this.checkConnection();
    }

}
</script>
<template>
    <div class="text-black text-4xl">

        Profile Page

        
    </div>
</template>

<style></style>