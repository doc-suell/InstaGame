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
                            console.log("test",response.data);
                        } catch (error) {
                            console.error(error);
                        }
                    }
        
                }
            }
        };
        </script>
<template>
    <div class="flex justify-center items-center h-screen">
      <form
        class="form-container flex flex-col p-16 "
        @submit.prevent="submitForm"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          height="80px"
          viewBox="0 0 512 512"
          class="zoom-animation"
          style="margin-top: 0; z-index: 100"
        >
          <defs>
            <radialGradient
              id="mondegrade"
              cx="50%"
              cy="50%"
              r="50%"
              fx="50%"
              fy="50%"
            >
              <stop offset="0%" style="stop-color: rgba(63, 94, 251, 1)" />
              <stop offset="100%" style="stop-color: rgba(252, 70, 107, 1)" />
            </radialGradient>
          </defs>
          <g fill="url(#mondegrade)">
            <path
              class="highlight-animation"
              d="M48.7 125.8l53.2 31.9c7.8 4.7 17.8 2 22.2-5.9L201.6 12.1c3-5.4-.9-12.1-7.1-12.1c-1.6 0-3.2 .5-4.6 1.4L47.9 98.8c-9.6 6.6-9.2 20.9 .8 26.9zM16 171.7V295.3c0 8 10.4 11 14.7 4.4l60-92c5-7.6 2.6-17.8-5.2-22.5L40.2 158C29.6 151.6 16 159.3 16 171.7zM310.4 12.1l77.6 139.6c4.4 7.9 14.5 10.6 22.2 5.9l53.2-31.9c10-6 10.4-20.3 .8-26.9L322.1 1.4c-1.4-.9-3-1.4-4.6-1.4c-6.2 0-10.1 6.7-7.1 12.1zM496 171.7c0-12.4-13.6-20.1-24.2-13.7l-45.3 27.2c-7.8 4.7-10.1 14.9-5.2 22.5l60 92c4.3 6.7 14.7 3.6 14.7-4.4V171.7zm-49.3 246L286.1 436.6c-8.1 .9-14.1 7.8-14.1 15.9v52.8c0 3.7 3 6.8 6.8 6.8c.8 0 1.6-.1 2.4-.4l172.7-64c6.1-2.2 10.1-8 10.1-14.5c0-9.3-8.1-16.5-17.3-15.4zM233.2 512c3.7 0 6.8-3 6.8-6.8V452.6c0-8.1-6.1-14.9-14.1-15.9l-160.6-19c-9.2-1.1-17.3 6.1-17.3 15.4c0 6.5 4 12.3 10.1 14.5l172.7 64c.8 .3 1.6 .4 2.4 .4zM41.7 382.9l170.9 20.2c7.8 .9 13.4-7.5 9.5-14.3l-85.7-150c-5.9-10.4-20.7-10.8-27.3-.8L30.2 358.2c-6.5 9.9-.3 23.3 11.5 24.7zm439.6-24.8L402.9 238.1c-6.5-10-21.4-9.6-27.3 .8L290.2 388.5c-3.9 6.8 1.6 15.2 9.5 14.3l170.1-20c11.8-1.4 18-14.7 11.5-24.6zm-216.9 11l78.4-137.2c6.1-10.7-1.6-23.9-13.9-23.9H183.1c-12.3 0-20 13.3-13.9 23.9l78.4 137.2c3.7 6.4 13 6.4 16.7 0zM174.4 176H337.6c12.2 0 19.9-13.1 14-23.8l-80-144c-2.8-5.1-8.2-8.2-14-8.2h-3.2c-5.8 0-11.2 3.2-14 8.2l-80 144c-5.9 10.7 1.8 23.8 14 23.8z"
            />
          </g>
        </svg>
        <div class="mt-20 flex flex-col items-start z-0">
          <!-- <label for="username" class="mt-6">Choose a username:</label>
          <input
            v-model="formData.username"
            class="border border-slate-300 w-96 mt-1 rounded-lg p-1"
            type="text"
            name="username"
            placeholder="Username"
            required
          />
          <label for="email" class="mt-6">Provide your email:</label>
          <input
            v-model="formData.email"
            class="border border-slate-300 w-96 mt-1 rounded-lg p-1"
            type="email"
            name="email"
            placeholder="email@email.com"
            required
          />
          <label for="password" class="mt-6">Choose a password:</label>
          <input
            v-model="formData.password"
            class="border border-slate-300 w-96 mt-1 rounded-lg p-1"
            type="password"
            name="password"
            placeholder="Password"
            required
          />
          <label for="confirmPassword" class="mt-6">Confirm your password</label>
          <input
          v-model="formData.confirmPassword"
            class="border border-slate-300 w-96 mt-1 rounded-lg p-1"
            type="password"
            name="confirmPassword"
            placeholder="Password"
            required
          /> -->
  
          <div class="input">
            <span class="test"><i class="fa-solid fa-user"></i></span>
            <input
              v-model="formData.username"
              class=""
              type="text"
              name="username"
              placeholder="Choose your Username"
            />
          </div>
          <div class="input">
            <span class="test"><i class="fa-solid fa-at"></i></span>
            <input
              v-model="formData.email"
              class=""
              type="text"
              name="email"
              placeholder="Type your Email"
            />
          </div>
          <div class="input">
            <span class="test"><i class="fa-solid fa-fingerprint"></i></span>
            <input
              v-model="formData.password"
              class=""
              type="password"
              name="password"
              placeholder="Type your Password"
            />
          </div>
  
          <div class="input">
            <span class="test"><i class="fa-solid fa-fingerprint"></i></span>
            <input
              v-model="formData.confirmPassword"
              type="password"
              name="confirmPassword"
              placeholder="Confirm your Password"
              required
            />
          </div>
          <label class="input-file" for="file">
            <input type="file" name="file" id="file" class="rounded-xl"/>
          </label>
  
          <div class="flex mx-auto">
            <button
              class="cursor-pointer mt-3 w-56 rounded-xl text-white p-2 custom-button transform hover:scale-105 transition-all duration-300 ease-in-out"
              type="submit"
            >
              Create account
            </button>
          </div>
          <div class="mt-2 cursor-pointer text-blue-500 mx-auto">
            <router-link to="/login">Already got an account ? Log in now !</router-link>
          </div>
        </div>
      </form>
    </div>
  </template>
  <style>
  .highlight-animation {
    animation: highlight 2s alternate infinite;
  }
  
  .zoom-animation {
    animation: zoom 2s infinite alternate; /* Ajustez la durée de l'animation selon vos besoins */
  }
  
  @keyframes highlight {
    0% {
      fill: rgba(63, 94, 251, 1);
    }
    100% {
      fill: rgba(252, 70, 107, 1);
    }
  }
  
  @keyframes scale {
    0% {
      transform: scale(1);
    }
    100% {
      transform: scale(
        1.1
      ); /* Ajustez la valeur pour définir l'ampleur du grossissement */
    }
  }
  
  @keyframes zoom {
    0% {
      transform: scale(1);
    }
    100% {
      transform: scale(
        1.1
      ); /* Ajustez la valeur de l'échelle pour l'agrandissement */
    }
  }
  
  .form-container {
    background: linear-gradient(white, white) padding-box,
                linear-gradient(to right, #4f46e5, #8c3afd, #f45d93) border-box;
    border-radius: 0.75em;
    border: 3px solid transparent;
  }
  
  
  
    
  
  .custom-button {
    background-image: linear-gradient(to right, #4f46e5, #8c3afd, #f45d93);
    background-size: 100% 100%;
    background-position: 0 0;
    transition: transform 0.3s ease;
  }
  
  .custom-button:hover {
    transform: scale(1.1);
  }
  
  
  </style>