<template>
    <div>
        <router-link to="/login" class="nav-link text-dark active" v-if="!$auth.check()">Login</router-link>
        <router-link to="/register" class="nav-link text-dark active" v-if="!$auth.check()">Register</router-link>
        <router-link to="/profile?u_id=7" class="nav-link text-dark active" v-if="$auth.check()"><i class='fas fa-user px-2'></i>Profile</router-link>
        <router-link to="/settings" class="nav-link text-dark active" v-if="$auth.check()"><i class='fas fa-user-cog px-2'></i>Settings</router-link>
        <div class="dropdown-divider mx-2 border-dark" v-if="$auth.check()"></div>
        <p class="nav-link text-dark clickable m-0" v-if="$auth.check()" @click.prevent="$auth.logout()"><i class='fas fa-sign-out-alt px-2'></i>Logout</p>
    </div>
</template>

<script>
    export default {
        name: "SubNav",
    }
</script>

<style scoped>

</style>
