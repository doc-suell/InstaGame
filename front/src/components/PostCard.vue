<script>

import Comment from "./Comment.vue";

export default {
    name: "PostCard",
    setup() {
        return {

        }

    },
    components: { Comment }

}

</script>

<template>
    <div class="card max-w-[35%] mx-auto">
        <div class="flex justify-between p-3">
            <div class="flex flew-row">
                <div class="pic-profile-card mr-3"><img src="/assets/images/E-TAfEiWYAI_Qgu.jpg" alt="profile-pic"></div>
                <p class="text-xl">Jonathan</p>
            </div>
            <div>
                <button>
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
        <img class="rounded-[6px] h-[400px] w-[468px]" src="https://www.numerama.com/wp-content/uploads/2022/04/wow-dragonflight.jpg" alt="post picture">
        <div class="flex justify-around pb-6">
            <button class="cardButton p-2"><i class="fa-regular fa-heart"></i></button>
            <button class="cardButton p-2"><i class="fa-regular fa-comment"></i></button>
            <button class="cardButton p-2"><i class="fa-solid fa-download"></i></button>
        </div>
        <Comment />
    </div>
</template>