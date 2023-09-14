<template>
  <div>
    <div class="card max-w-[35%] mx-auto" v-for="post in posts" :key="post.id">
      <div class="flex justify-between p-3">
        <div class="flex flew-row">
          <div class="pic-profile-card mr-3">
            <img src="/assets/images/E-TAfEiWYAI_Qgu.jpg" alt="profile-pic" />
          </div>
          <p class="text-xl text-black">{{ post.description }}</p>
        </div>
        <div>
          <button>
            <i class="fa-solid fa-bars"></i>
          </button>
        </div>
      </div>
      <img
        class="rounded-[6px] h-[400px] w-[468px]"
        :src="post.post_picture"
        alt="post picture"
      />
      <div class="flex justify-around pb-6">
        <button class="cardButton p-2">
          <i class="fa-regular fa-heart"></i>
        </button>
        <button class="cardButton p-2">
          <i class="fa-regular fa-comment"></i>
        </button>
        <button class="cardButton p-2">
          <i class="fa-solid fa-download"></i>
        </button>
      </div>
      <Comment />
    </div>
  </div>
</template>

<script>
import Comment from "./Comment.vue";

export default {
  name: "PostCard",
  props: {
    posts: Array,
  },
  components: { Comment },
};
</script>
