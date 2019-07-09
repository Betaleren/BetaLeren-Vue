<template>
        <div>
                {{ data }}
        </div>
</template>

<script>
    export default {
        name: "Progress",

        data() {
            return {
                data : this.$route.query.u_id,
            }
        },

        methods: {

        },

        mounted() {
        }
    }
</script>

<style scoped>

</style>