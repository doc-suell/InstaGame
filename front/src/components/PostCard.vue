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


<!-- <template>
  <div>
    <div class="card max-w-[35%] mx-auto" v-for="post in posts" :key="post.id">
          <p class="text-xl text-black">{{ post.description }}</p>
          <p class="text-xl text-black">{{ post.username }}</p>
    </div>
  </div>
</template> -->

<template>
  <div class="container">
    <div class="cards">
      <!-- SINGLE CARD :// -->
      <div class="card-items">
        <div class="card-header">
          <div class="pic-profile-nav"><img src="/assets/images/E-TAfEiWYAI_Qgu.jpg" alt="profile-pic"></div>
          <span><i class="fa-solid fa-ellipsis"></i></span>
        </div>
        <div class="card-body">
          <img src="/assets/images/test.jpeg" alt="post-pic">
        </div>
        <div class="card-footer">
          <div class="card-footer-icons">
            <i class="fa-regular fa-heart"></i>
            <i class="fa-regular fa-comment"></i>
          </div>
          <span class="card-footer-icons"><i class="fa-regular fa-bookmark"></i></span>
        </div>
        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, consequatur!</p>
        <div class="comment">
          <Comment />
        </div>
      </div>
      <!-- END SINGLE CARD :// -->
      <!-- SINGLE CARD :// -->
      <div class="card-items">
        <div class="card-header">
          <div class="pic-profile-nav"><img src="../../public/assets/images/E-TAfEiWYAI_Qgu.jpg" alt="profile-pic"></div>
          <span><i class="fa-solid fa-ellipsis"></i></span>
        </div>
        <div class="card-body">
          <img src="../../public/assets/images/E-TAfEiWYAI_Qgu.jpg" alt="post-pic">
        </div>
        <div class="card-footer">
          <div class="card-footer-icons">
            <i class="fa-regular fa-heart"></i>
            <i class="fa-regular fa-comment"></i>
          </div>
          <span class="card-footer-icons"><i class="fa-regular fa-bookmark"></i></span>
        </div>
        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, consequatur!</p>
        <div class="comment">
          <Comment />
        </div>
      </div>
      <!-- END SINGLE CARD :// -->
    </div>
  </div>
  
</template>

