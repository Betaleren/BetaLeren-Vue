<template>
    <div>
        <router-link to="" class="nav-link text-dark active"><i class='fas fa-tasks px-2'></i>Progress</router-link>
        <router-link to="/settings" class="nav-link text-dark"><i class='fas fa-user-cog px-2'></i>Settings</router-link>
        <div class="dropdown-divider mx-2 border-dark"></div>
        <p class="nav-link text-dark" @click="logout()"><i class='fas fa-sign-out-alt px-2'></i>Logout</p>
    </div>
</template>

<script>
    export default {
        name: "SubNav",
        methods: {
            logout(){
                localStorage.removeItem('beta.jwt');
                localStorage.removeItem('beta.user');
                this.$root.$emit('myEvent', false);
                this.$router.push('/login');
            }
        }
    }
</script>

<style scoped>

</style>
