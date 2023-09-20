<script setup>


</script>


<template>
    <div class="post-container" id="post-container">
        <div class="form-container-post">
            <div class="post-header"><h2>Create new post</h2></div>
            <form  class="form-items post-form">
                    <textarea name="description" placeholder="Write a caption..."></textarea>
                <div>
                    <label class="input-file" for="file">
                    <input type="file" name="file" id="file">
                    </label>
                </div>
                <button class="button" type="submit" >Share</button>
            </form>
        </div>
    </div>
</template>