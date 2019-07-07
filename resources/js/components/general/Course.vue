<template>
    <div>
        <div class="btn-group row mb-3 w-100" role="group" aria-label="Basic example">
            <button type="button" class="btn rounded-0 flex-grow-0 text-uppercase" v-for="course in courses" :key="course.id" :class="{activeLine: choose === course.name}" v-on:click="CourseChoose(course.name)">{{course.name}}</button>
        </div>
        <div class="row container-videos">
            <div class="p-1" style="min-width: 210px; max-width: 210px;" v-for="test in tests" :key="test.id">
                <div class="card border-0 bg-transparent">
                    <router-link to="/video" class="nav-link p-0">
                        <div class="position-relative">
                            <img class="card-img-top p-0 rounded" :src="'img/thumbnail/video-background.jpg'" alt="thumbnail">
                            <span class="badge badge-videos">00:00:00</span>
                        </div>
                        <div class="card-body px-0 py-1">
                            <div class="d-flex flex-column">
                                <h5 class="card-title m-0 text-muted">Title</h5>
                                <p class="card-text m-0"><small class="text-muted">Uploader</small></p>
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
                tests: [
                    {id: '1'},
                    {id: '2'},
                    {id: '3'},
                    {id: '4'},
                    {id: '5'},
                    {id: '6'},
                    {id: '7'},
                    {id: '8'},
                    {id: '9'},
                    {id: '10'},
                    {id: '11'},
                ],
                courses: [
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
                    // api
                }
            }
        }
    }
</script>

<style scoped>

</style>
