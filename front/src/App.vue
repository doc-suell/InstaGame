<script>
import Footer from '../src/components/Footer.vue';
import NavBar from '../src/components/NavBar.vue';



export default {
  name: 'App',
  setup() {
    return {
    }

  },
  components: { NavBar }

}

</script>

<template>
  <header>

  </header>
  <main>
    <NavBar />
    <router-view></router-view>

  </main>

  <Footer></Footer>
</template>

<style></style>