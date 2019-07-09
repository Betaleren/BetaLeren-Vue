<template>
    <fragment>
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
    </fragment>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "Profile-Courses",

        data() {
            return {
                courses: [],
                data : this.$route.query.u_id,
            }
        },

        methods: {

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

        },

        mounted() {
            this.getJoinedCourses();
        },
    }
</script>

<style scoped>

</style>