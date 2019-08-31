<template>
    <fragment>
        <header>
            <nav-bar></nav-bar>
        </header>
        <main class="mt-7 mx-lg-auto w-lg-75 px-15 mx--lg-3" id="content" :class="{'w-lg-90': this.$route.meta.show === 1}">
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
    }
</script>
