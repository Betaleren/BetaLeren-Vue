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
        name: "Main"
    }
</script>
