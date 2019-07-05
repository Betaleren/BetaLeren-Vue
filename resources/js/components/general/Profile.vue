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
                    <h5 class="card-title font-weight-bold">User information</h5>
                    <p class="card-text">{{permission}}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Joined: {{ time }}</li>
                    <li class="list-group-item"><a class="text-primary" style="cursor: pointer; text-decoration: none;">Watch progress</a></li>
                </ul>
            </div>

            <hr>

            <div class="center text-center mb-5">
                <div class="caption">
                    <h3 class="title display-4 ">{{ u.firstname + " " + u.lastname}} joined courses:</h3>
                </div>
            </div>
            <div v-for="course in courses" :key="course.id">
                <div style="width: 50px;"></div>
                <div class="card mb-3 text-center  bg-light">
                    <div class="">
                        <div class="">
                            <div class="card-body">
                                <h4 class="card-title"><a class="text-primary" style="cursor: pointer; text-decoration: none;" href="">{{ course.title}}</a></h4>
                                <p class="card-text">{{ course.description }}</p>
                                <hr style="max-width: 80%">
                            </div>
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
                permission: '',
                time: '',
                courses: [],
                data : this.$route.query.u_id,
            }
        },

        methods: {
            getUser: async function() {
                axios.get('api/user/' + this.data)
                    .then(response => {this.user = response.data; this.permission = this.getPermission(this.user[0].permission);
                             console.log(this.user)});
                axios.get('api/time/' + this.data)
                    .then(response => (this.time = response.data));

            },

            getJoinedCourses:function() {
                axios.get('api/course/' + this.data)
                    .then(response => (this.courses = response.data));
            },
            getPermission:function(int){
              if(int == 0) {
                  return 'Normal watcher';
              } else if(int == 1) {
                  return 'Course holder';
              }else{ return "administrator";}
            },
        },
        mounted() {
            this.getUser();
            this.getJoinedCourses();

    },
    }
</script>

<style scoped>

</style>