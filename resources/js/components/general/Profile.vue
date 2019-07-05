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
                    <h5 class="card-title font-weight-bold">User information:</h5>
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
            <div v-for="course in courses" :key="course.course_id">
                <div style="width: 50px;"></div>
                <div class="card mb-3 text-center  bg-light">
                    <div class="">
                        <div class="">
                            <div class="card-body">
                                <h4 class="card-title"><a class="text-primary" style="cursor: pointer; text-decoration: none;" href="">{{ course.title}}</a></h4>
                                <p class="card-text">{{ course.description }}</p>
                                <hr style="max-width: 80%">
                                <div v-if="loggedInUserId === data">
                                    <button type="button" v-on:click="leaveJoinedCourse(course.id); getJoinedCourses()" class="btn btn-danger"><i class='fas fa-sign-out-alt px-4'></i></button>
                                </div>
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
                loggedInUserId: null,
                time: '',
                courses: [],
                data : this.$route.query.u_id,
            }
        },

        methods: {
            /**
             *  gets user data from the UserController and gets if you are the logged in user
             */
            getUser: function() {

                // Api call to api/user/{id} to get the user data
                axios.get('api/user/' + this.data)
                    .then(response => {this.user = response.data;
                        this.permission = this.getPermission(this.user[0].permission);});

                // Api call to api/time/{id} to get the users his join date back
                axios.get('api/time/' + this.data)
                    .then(response => (this.time = response.data));

                // Stores the user his id in the data
                this.loggedInUserId = localStorage.getItem('beta.id');
            },

            /**
             *  gets all the joined courses from the user of this profile from the UserController
             */
            getJoinedCourses: function() {

                // Api call to api/course/{id} to get all the joined courses by the user
                    axios.get('api/course/' + this.data)
                        .then(response => (this.courses = response.data));
            },

            /**
             *  this function lets you leave a joined course.
             *
             * @param course_id   the selected course
             */
            leaveJoinedCourse : function(course_id) {

                // Api call to api/course with the post data 'course_id'
                axios.post('api/course', { course_id}).then(Response => console.log(Response));
            },

            /**
             *  this function retrieves the user his permission and will return it to plain text
             *
             * @param int             the permission of the user of this profile
             * @returns {string}      plain text
             */
            getPermission: function(int){
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
