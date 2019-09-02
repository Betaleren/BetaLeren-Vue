<template>
    <fragment>
        <div class="card bg-transparent border-0 mx-auto" style="width: 18rem">
            <img class="card-img-top mx-auto rounded-circle" style="width: 160px; height: 160px;" :src="img"  alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">{{ user.first_name + " " + user.last_name}}:</h5>
                <hr>
                <p class="card-text">{{permission}}</p>
                <p class="card-text">Joined: {{ user.created_at }}</p>
            </div>
        </div>
        <hr>
        <div>
            <div class="btn-group row mb-3 w-100" role="group" aria-label="Basic example">
                <button type="button" class="btn rounded-0 flex-grow-0" value="progress" :class="{activeLine: info.progress}" v-on:click="infoOpen($event)">Progress</button>
                <button type="button" class="btn rounded-0 flex-grow-0" value="course" :class="{activeLine: info.course}" v-on:click="infoOpen($event)">Joined Courses</button>
                <button type="button" class="btn rounded-0 flex-grow-0" value="repo" :class="{activeLine: info.repo}" v-on:click="infoOpen($event)">Repositories</button>
            </div>
            <div>
                <div v-if="info.progress">
                    <Progress></Progress>
                </div>
                <div v-if="info.course">
<!--                    <profile_courses></profile_courses>-->
                </div>
                <div v-if="info.repo">
                    <repository></repository>
                </div>
            </div>
        </div>
    </fragment>
</template>

<script>
    import axios from 'axios';
    import Progress from './info/Progress';
    import Profile_courses from './info/Profile-Courses';
    import Repository from "./info/Repository";
    export default {
        name: "Profile",
        components: {
            Progress,
            Profile_courses,
            Repository
        },
        data() {
            return {
                user: {},
                img: null,
                permission: '',
                connecting: true,
                info: {
                    progress: true,
                    course: false,
                    repo: false,
                },
                previous: 'progress',
                data : this.$route.query.u_id,
                test : '',
            }
        },

        methods: {
            /**
             *  gets user data from the UserController and gets if you are the logged in user
             */
            getUsers() {
                this.$http({
                    url: "users/" + this.data,
                    method: 'GET',
                })
                    .then((res) => {
                        this.user = res.data.user;
                        this.permission = this.getPermission(res.data.user.role)
                    }, () => {
                        this.has_error = true;
                    })
            },

            infoOpen(e) {
                let value = e.target.value;
                let previousValue = this.previous;
                if (previousValue !== value){
                    this.info[previousValue] = false;
                    this.info[value] = true;
                    this.previous = value;
                }
            },

            /**
             *  this function retrieves the user his permission and will return it to plain text
             *
             * @param int             the permission of the user of this profile
             * @returns {string}      plain text
             */
            getPermission: function(int){
              if(int === 0) {
                  return 'Normal watcher';
              } else if(int === 1) {
                  return 'Course holder';
              }else{ return "administrator";}
            },
        },

        mounted() {
            this.getUsers();

            if (this.$route.query.code !== null){
                this.info.progress = false;
                this.info.repo = true;
                this.previous = 'repo';
            }
    },
    }
</script>

<style scoped>

</style>
