<template>
    <div>
        <router-link to="" class="nav-link text-dark active" v-if="isLoggedIn"><i class='fas fa-tasks px-2'></i>Progress</router-link>
        <router-link to="/settings" class="nav-link text-dark" v-if="isLoggedIn"><i class='fas fa-user-cog px-2'></i>Settings</router-link>
        <router-link to="/login" class="nav-link text-dark active" v-if="!isLoggedIn">Login</router-link>
        <router-link to="/register" class="nav-link text-dark active" v-if="!isLoggedIn">Register</router-link>
        <router-link to="/profile?q_id=7" class="nav-link text-dark active"><i class='fas fa-user px-2'></i>Profile</router-link>
        <div class="dropdown-divider mx-2 border-dark"></div>
        <p class="nav-link text-dark clickable" @click="logout()" v-if="isLoggedIn"><i class='fas fa-sign-out-alt px-2'></i>Logout</p>
    </div>
</template>

<script>
    export default {
        name: "SubNav",
        data(){
            return{
                isLoggedIn: localStorage.getItem('beta.jwt') != null,
                isAdmin: localStorage.getItem('beta.admin') != null
            }
        },
        methods: {
            logout(){
                localStorage.removeItem('beta.jwt');
                localStorage.removeItem('beta.user');
                localStorage.removeItem('beta.firstname');
                localStorage.removeItem('beta.lastname');
                localStorage.removeItem('beta.admin');
                this.$root.$emit('myEvent', false);
                this.$root.$emit('admindelete', false);
                this.$router.push('/login');
                this.isLoggedIn = false
            }
        },
        mounted() {
            this.$root.$on('admindelete', (text) => {
                this.isAdmin = text
            });
            this.$root.$on('myEvent', (text) => { // here you need to use the arrow function
                this.isLoggedIn = text
            })
        }
    }
</script>

<style scoped>

</style>
