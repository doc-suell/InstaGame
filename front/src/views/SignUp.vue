<script>



</script>






<template>
    <div>
        <h1 class="text-center">SignUp Page</h1>
        <form class="flex flex-col align-center" action="../../../controller/memberController.php?action=addMember" method="post">
            <input class="border border-black w-[30%] mx-auto" type="text" name="username" placeholder="username">
            <input  class="border border-black w-[30%] mx-auto" type="text" name="email" placeholder="email">
            <input  class="border border-black w-[30%] mx-auto" type="password" name="password" placeholder="password">
            <button  class="border border-black w-[30%] mx-auto" type="submit">Go</button>
        </form>
    </div>
</template>
<style>

</style>