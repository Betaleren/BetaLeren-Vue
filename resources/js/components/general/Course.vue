<template>
    <div>
        <div class="btn-group row mb-3 w-100" role="group" aria-label="Basic example">
            <button type="button" class="btn rounded-0 flex-grow-0 text-uppercase" v-for="course_label in courses_labels" :key="course_label.id" :class="{activeLine: choose === course_label.name}" v-on:click="CourseChoose(course_label.name)">{{course_label.name}}</button>
        </div>
        <div class="row container-videos">
            <div class="p-1" style="min-width: 210px; max-width: 210px;" v-for="course in courses" :key="course.id">
                <div class="card border-0 bg-transparent">
                    <router-link to="/video" class="nav-link p-0">
                        <div class="position-relative">
                            <img class="card-img-top p-0 rounded" v-lazy="'img/thumbnail/' + course.thumbnail" alt="thumbnail">
                            <span class="badge badge-videos">{{ course.time_length }}</span>
                        </div>
                        <div class="card-body px-0 py-1">
                            <div class="d-flex flex-column">
                                <h5 class="card-title m-0 text-muted">{{ course.title }}</h5>
                                <p class="card-text m-0"><small class="text-muted">{{ course.name }}</small></p>
                            </div>
                        </div>
                    </router-link>
                </div>
                <div class="dropdown-divider line"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Course",
        data(){
            return {
                courses: [],
                courses_labels: [
                    {
                        id: '1',
                        name: 'all',
                    },
                    {
                        id: '2',
                        name: 'html',
                    },
                    {
                        id: '3',
                        name: 'css',
                    },
                    {
                        id: '4',
                        name: 'php',
                    },
                ],
                choose: 'all',
            }
        },
        methods: {
            CourseChoose(e) {
                if (this.choose !== e){
                    this.choose = e;
                }
            },
            GetCourse() {
                let app = this;
                this.$http({
                    url: 'course/courses',
                    method: 'GET',
                }).then((res) => {
                    app.courses = res.data;
                })
            },
        },
        mounted() {
            this.GetCourse()
        }
    }
</script>

<style scoped>

</style>
