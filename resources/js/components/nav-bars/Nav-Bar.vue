<template>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top align-items-start justify-content-between">
        <div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <router-link to="/" class="nav-link">Home<span class="sr-only">(current)</span></router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link to="" class="nav-link">Categories</router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link to="" class="nav-link">Examination</router-link>
                    </li>
                </ul>
            </div>
        </div>
        <div v-if="isLoggedIn">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <div class="nav-link dropdown-toggle active p-0" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{user}}
                        <img :src="'/img/Profile/default-avatar.png'" class="ml-2 rounded-circle" alt="Picture" width="40px" height="40px">
                    </div>
                    <div class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdownMenuLink">
                        <Sub-Nav></Sub-Nav>
                    </div>
                </li>
            </ul>
        </div>
        <div v-if="!isLoggedIn">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <div class="nav-link dropdown-toggle active p-0" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Login or Register
                        <img :src="'/img/Profile/default-avatar.png'" class="ml-2 rounded-circle" alt="Picture" width="40px" height="40px">
                    </div>
                    <div class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdownMenuLink">
                        <Sub-Nav></Sub-Nav>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    import SubNav from './Sub-Nav';

    export default {
        components: {
            SubNav,
        },
        data(){
            return{
                isLoggedIn: localStorage.getItem('beta.jwt') != null,
                user: localStorage.getItem('beta.firstname')
            }
        },
        mounted() {
            this.$root.$on('myEvent', (text) => {
                this.isLoggedIn = text
                this.user = localStorage.getItem('beta.firstname')
            })
        },
        name: "Nav-Bar"
    }
</script>

<style scoped>

</style>
