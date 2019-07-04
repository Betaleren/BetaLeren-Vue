<template>
    <div>
        <router-link to="" class="nav-link text-dark active"><i class='fas fa-tasks px-2'></i>Progress</router-link>
        <router-link to="/settings" class="nav-link text-dark"><i class='fas fa-user-cog px-2'></i>Settings</router-link>
        <div class="dropdown-divider mx-2 border-dark"></div>
        <router-link to="" class="nav-link text-dark"><i class='fas fa-sign-out-alt px-2'></i>Logout</router-link>
    </div>
</template>

<script>
    export default {
        name: "SubNav"
    }
</script>

<style scoped>

</style>
