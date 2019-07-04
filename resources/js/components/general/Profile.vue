<template>
    <fragment>
        <div class="col-md-8 mt-4">
            <div class="card  card-default">
                <div class="card-header"> User list</div>
                <div class="card-body">
                    <ul v-for="u in user">
                            {{u.firstname}}
                    </ul>

                </div>
            </div>
        </div>
    </fragment>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "Profile",

        data() {
            return {
                user: [],
                data : this.$route.query.test,
            }
        },

        methods: {
            getUser:function() {
                axios.get('api/user/' + this.data)
                    .then(response => (this.user = response.data));
            }
        },
        mounted() {
            this.getUser();
        }
    }
</script>

<style scoped>

</style>