<script>
import { onMounted, reactive, ref, watch } from 'vue';
import Footer from '../src/components/Footer.vue';
import NavBar from '../src/components/NavBar.vue';
import axios from "axios";
import { useRoute, useRouter } from 'vue-router';


export default {
  name: 'App',

  setup() {
    const isUserConnected = ref(false); // Utilisez ref pour stocker la valeur de isUserConnected
    const route = useRoute();
    const router = useRouter();
    const instance = axios.create({
      baseURL: "http://localhost/instaGame/controller/",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      withCredentials: true,
    });
    const formData = reactive({
      action: "checkConnection",
      username: "",
    });
    const checkConnection = async () => {
      try {
        const response = await instance.post("memberController.php", formData);

        if (response.data.user) {
          isUserConnected.value = true; // Mettez à jour la valeur de isUserConnected
        }
      } catch (error) {
        console.error(error);
      }
    };

    onMounted(async () => {
      await checkConnection();

      if (isUserConnected.value) {
        console.log("User connected :", isUserConnected.value);
        router.push("/");
      } else {
        router.push("/signup");
        console.log("Not connected", isUserConnected.value);
      }
    })

    return {
      isUserConnected,
    };
  },

  components: { NavBar, Footer }
  ,
  method: {}
}
</script>
<template>
  <header></header>
  <main>
    <NavBar />
    <router-view></router-view>
  </main>
  <Footer></Footer>
</template>

<style></style>
