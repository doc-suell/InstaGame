<script>
import Comment from "./Comment.vue";

export default {
  name: "PostCard",
  props: {
    posts: Array,
  },
  components: { Comment },
  created() {
    this.posts.forEach(post => {
      console.log("here PIC",post.postPicturePath);
      console.log("here description",post.description);
    });
  },
};
</script>


<template>
  
  <div class="container">
    
    <div class="cards" v-for="post in posts" :key="post.id">
      <!-- SINGLE CARD :// -->
      <div class="card-items">
        <div class="card-header">
          <div class="pic-profile-nav"><img src="/assets/images/E-TAfEiWYAI_Qgu.jpg" alt="profile-pic"></div>
          <span><i class="fa-solid fa-ellipsis"></i></span>
        </div>
        <div class="card-body">
          <img :src="post.post_picture"  alt="post-pic">
        </div>
        <div class="card-footer">
          <div class="card-footer-icons">
            <i class="fa-regular fa-heart"></i>
            <i class="fa-regular fa-comment"></i>
          </div>
          <span class="card-footer-icons"><i class="fa-regular fa-bookmark"></i></span>
        </div>
        <p class="description">{{ post.description }}</p>
        <div class="comment">
          
          <Comment />
        </div>
      </div>
      <!-- END SINGLE CARD :// -->
    </div>
  </div>

  
</template>

