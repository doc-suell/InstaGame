<script setup>

// import NavBar from '../components/NavBar.vue';


</script>

<template>
    <div class="container-all-forms">
        <div class="form-container">
            <form class="form-items" action="" method="post">
                <h2 class="login-h2">LOGIN</h2>
                <div class="input">
                    <input  type="text-login" name="username" placeholder="Type your Username">
                </div>
                <div class="input">
                    <input type="password" name="password" placeholder="Type your Password">
                </div>
                <button class="button" type="submit">LOGIN</button>
                <router-link to="/">Forgot password ?</router-link>
            </form>
            <router-link type="submit" to="/signup">Or SIGN UP</router-link>
        </div>
    </div>











    <!-- <NavBar/> -->
        
</template>

<style></style>