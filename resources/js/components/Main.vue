<template>
    <fragment>
        <header>

        </header>
        <main>
            <router-view></router-view>
        </main>
        <footer>

        </footer>
    </fragment>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
            $(document).ready(function(){
                $("test").remove();
            });
        }
    }
</script>
