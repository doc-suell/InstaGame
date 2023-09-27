import './style/css/style.css';

import { createApp } from 'vue'
import App from './App.vue'
import * as VueRouter from 'vue-router'
import Home from './views/Home.vue'
import Login from './views/Login.vue'
import Profil from './views/Profil.vue'
import Create from './views/Create.vue'
import Saved from './views/SavedPosts.vue'
import SignUp from './views/SignUp.vue'

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/profil',
            name: 'Profil',
            component: Profil
        },
        {
            path: '/create',
            name: 'Create',
            component: Create
        },
        {
            path: '/saved',
            name: 'Saved',
            component: Saved
        },
        {
            path: '/signup',
            name: 'SignUp',
            component: SignUp
        },

    ]
})


const app = createApp(App)
app.use(router).mount('#app')
app.mount('app')