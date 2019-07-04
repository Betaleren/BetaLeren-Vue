<template>
    <fragment>
        <div v-for="u in user" :key="u.id">
            <div class="center text-center mb-5">
                <div class="caption">
                    <h1 class="title display-3">{{ u.firstname + " " + u.lastname}}</h1>
                </div>
            </div>
            <div class="card mx-auto" style="width: 18rem">
                <img class="card-img-top" :src="'img/Profile/default-avatar.png'" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Bio:</h5>
                    <p class="card-text">{!! $user->bio !!}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Total videos watched: {!! $total_post !!}</li>
                    <li class="list-group-item">Total exams completed: {!! $joined[0] !!}</li>
                </ul>
            </div>

            <hr>

            <div class="center text-center mb-5">
                <div class="caption">
                    <h3 class="title display-4 ">{{ u.firstname + " " + u.lastname}} Joined courses:</h3>
                </div>
            </div>

            <div style="width: 50px;"></div>
            <div class="card mb-3 text-center  bg-light">
                <div class="">
                    <div class="">
                        <div class="card-body">
                            <h4 class="card-title"><a class="text-primary" style="cursor: pointer; text-decoration: none;" href="topic?topic_id={!! $topic->id !!}">{!! $topic->name !!}</a></h4>
                            <hr style="max-width: 80%">
                            <p class="card-text">{!! $topic->description !!}</p>
                        </div>
                    </div>
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
                courses: [],
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