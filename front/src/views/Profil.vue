<template>
    <NavBar  />
    <div class="flex items-center w-full justify-center">

<div class="max-w-xs">
    <div class="bg-white shadow-2xl rounded-lg py-3">
        <div class="photo-wrapper p-2">
            <img class="w-32 h-32 rounded-full mx-auto" :src="profilePicture" alt="John Doe">
        </div>
        <div class="p-2">
            <h3 class="text-center text-xl text-gray-900 font-medium leading-8">{{ username }}</h3>
            <div class="text-center text-gray-400 text-xs font-semibold">
                <p>Web Developer</p>
            </div>
            <table class="text-xs my-3">
                <tbody><tr>
                    <td class="px-2 py-2 text-gray-500 font-semibold">Address</td>
                    <td class="px-2 py-2">xxxx - Bordeaux Dawan </td>
                </tr>
                <tr>
                    <td class="px-2 py-2 text-gray-500 font-semibold">Phone</td>
                    <td class="px-2 py-2">+33 9955221114</td>
                </tr>
                <tr>
                    <td class="px-2 py-2 text-gray-500 font-semibold">Email</td>
                    <td class="px-2 py-2">john@exmaple.com</td>
                </tr>
            </tbody></table>
        </div>
    </div>
</div>

</div>
    <!-- <div class="container profile-container">
        <div class="header-profile">
        <div class="profile"> -->
            <!-- <img :src="profilePicture" alt="profil picture" class=""> -->
        <!-- </div> -->
        <!-- <p>User Name : <span class="">{{ username }}</span></p>  -->
        <!-- <span>{{ email }}</span> -->
    <div class="container profile-container">
        <div v-if="posts && posts.length > 0">
            <PostCard @postDeleted="handlePostDeleted" :posts="posts" />
        </div>
        <span v-else>No posts available</span>
    </div>

</template>
    
  
  
<script>

// import { modalStates, toggleModal } from '../modal';


import axios from "axios";
import { onMounted, reactive, ref } from "vue";
import PostCard from "@/components/PostCard.vue";
import NavBar from "../components/NavBar.vue";




const instance = axios.create({
    baseURL: "http://localhost/instaGame/controller/",
    headers: {
        "Content-Type": "application/x-www-form-urlencoded",
    },
    withCredentials: true,
});


export default {
    components: {
        PostCard,
        NavBar
    },
    setup() {
        const email = ref("");
        const username = ref("");
        const id = ref("");
        const profilePicture = ref("");
        const posts = ref([]);

        const formData = reactive({
            action: "checkConnection",
            username: "",
            email: "",
        });
        const postData = reactive({
            action: "getPostsByUserId",
            id: id,
        });

        const handlePostDeleted = (deletedPostId) => {
            this.posts = this.posts.filter(post => post.id !== deletedPostId);
        }

        const loginError = ref(false);

        const checkConnection = async () => {
            try {
                const response = await instance.post("memberController.php", formData);

                // Vérifiez si la réponse contient un utilisateur
                if (response.data.user) {
                    // Insérez la valeur de response.data.user dans la référence username
                    username.value = response.data.user.username;
                    profilePicture.value = response.data.user.profile_picture;
                    id.value = response.data.user.id;
                }
            } catch (error) {
                console.error(error);
            }
        };
        const getPostsByUserId = async () => {
            try {
                const response = await instance.post("postController.php", postData);
                if (response.data) {
                    posts.value = response.data
                }

            } catch (error) {
                console.error(error);
            }
        };


        onMounted(() => {
            checkConnection().then(() => { // On check d'abord la connexion, puis on récupère les données de l'utilisateur connecté
                getPostsByUserId();
            });
        });

        return {
            username,
            profilePicture,
            formData,
            loginError,
            posts,
            email
        }
    },
};
</script>
  
<style></style>