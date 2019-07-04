<template>
    <div>
        <router-link to="" class="nav-link text-dark active" v-if="isLoggedIn"><i class='fas fa-tasks px-2'></i>Progress</router-link>
        <router-link to="/settings" class="nav-link text-dark" v-if="isLoggedIn"><i class='fas fa-user-cog px-2'></i>Settings</router-link>
        <router-link to="/login" class="nav-link text-dark active" v-if="!isLoggedIn">Login</router-link>
        <router-link to="/register" class="nav-link text-dark active" v-if="!isLoggedIn">Register</router-link>
        <div class="dropdown-divider mx-2 border-dark"></div>
        <p class="nav-link text-dark" @click="logout()" v-if="isLoggedIn"><i class='fas fa-sign-out-alt px-2'></i>Logout</p>
    </div>
</template>

<script>
    export default {
        name: "SubNav",
        data(){
            return{
                isLoggedIn: localStorage.getItem('beta.jwt') != null
            }
        },
        methods: {
            logout(){
                localStorage.removeItem('beta.jwt');
                localStorage.removeItem('beta.user');
                localStorage.removeItem('beta.firstname');
                localStorage.removeItem('beta.lastname')
                this.$root.$emit('myEvent', false);
                this.$router.push('/login');
                this.isLoggedIn = false
            }
        },
        mounted() {
            this.$root.$on('myEvent', (text) => { // here you need to use the arrow function
                this.isLoggedIn = text
            })
        }
    }
</script>

<style scoped>

</style>
