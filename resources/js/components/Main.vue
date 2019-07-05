<template>
    <fragment>
        <header>
            <nav-bar></nav-bar>
        </header>
        <main class="mt-7 w-lg-75 mx-lg-auto mx--lg-3">
            <router-view></router-view>
        </main>
        <footer>

        </footer>
    </fragment>
</template>

<script>
    import NavBar from './nav-bars/Nav-Bar';

    export default {
        components: {
            NavBar,
        },
        data(){
            return{
                isLoggedIn: localStorage.getItem('beta.jwt') != null,
            }
        },
        name: "Main",
        mounted() {
            this.$root.$on('myEvent', (text) => { // here you need to use the arrow function
                this.isLoggedIn = text
            })
        }
    }
</script>
