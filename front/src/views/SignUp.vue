<template>
    <div>
        <h1 class="text-center">SignUp Page</h1>
        <form class="flex flex-col align-center" @submit.prevent="submitForm">
            <input v-model="formData.username" class="border border-black w-[30%] mx-auto" type="text" name="username" placeholder="username">
            <input v-model="formData.email" class="border border-black w-[30%] mx-auto" type="text" name="email" placeholder="email">
            <input v-model="formData.password" class="border border-black w-[30%] mx-auto" type="password" name="password" placeholder="password">
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
                action: "addMember",
                username: "",
                email: "",
                password: "",
            }
        };
    },
    methods: {
        submitForm() {
  
          console.log(this.formData);
  
            // Envoie des données au serveur
            axios.post("http://localhost/instaGame/controller/memberController.php?action=addMember", JSON.stringify(this.formData))
                .then(response => {
                    // Traitez la réponse du serveur ici si nécessaire
                    console.log("Le lien :",response.data);
                })
                .catch(error => {
                    // Gérez les erreurs ici
                    console.error(error);
                });
        }
    }
  };
  </script>
  
  <style>
  </style>