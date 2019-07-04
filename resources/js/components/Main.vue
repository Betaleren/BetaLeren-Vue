<template>
    <fragment>
        <header>
            <nav-bar></nav-bar>
        </header>
        <main>
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
