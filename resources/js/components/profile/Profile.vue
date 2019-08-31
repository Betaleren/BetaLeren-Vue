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
        </div>
        <profile_courses></profile_courses>
    </fragment>
</template>

<script>
    import axios from 'axios';
    import Progress from './info/Progress';
    import profile_courses from './info/Profile-Courses';
    export default {
        name: "Profile",
        components: {
            Progress,
            profile_courses
        },
        data() {
            return {
                user: [],
                permission: '',
                loggedInUserId: null,
                time: '',
                courses: [],
                data : this.$route.query.u_id,
                test : '',
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
    },
    }
</script>

<style scoped>

</style>
