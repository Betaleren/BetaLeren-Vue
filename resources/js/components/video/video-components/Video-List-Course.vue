<template>
    <div class="border bg-light h-100">
        <div class="card bg-transparent border-0 rounded-0 h-100">
            <div class="card-header" style="height: 75px">
                <p class="card-text text">Title</p>
            </div>
            <div class="list-group card-body p-0 overflow-auto" style="scroll-behavior: smooth">
                <router-link id="count" class="list-group-item list-group-item-action bg-transparent rounded-0 border-0 px-0 py-1 text-decoration-none" :to="{query: { test: video.id }}" v-for="video in videos" :key="video.id">
                    <div class="row m-0">
                        <div class="d-flex flex-row align-items-center px-1">
                            <p class="counter text-muted m-0 text-center" style="min-width: 30px"></p>
                        </div>
                        <div class="position-relative" style="width: 100px; height: 56.2833px">
                            <span class="badge badge-videos">00:00:00</span>
                            <img :src="'img/thumbnail/video-background.jpg'" class="card-img" alt="thumbnail" width="100px" height="56.2833px">
                        </div>
                        <div class="card-body px-1 py-0">
                            <div class="d-flex flex-column">
                                <h6 class="card-title m-0 text-muted text-break">Title</h6>
                                <p class="card-text m-0"><small class="text-muted">Uploader</small></p>
                            </div>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Video-List-Course",
        data(){
            return {
                videos: [
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
                    {id: '12'},
                    {id: '13'},
                ],
            }
        },
    }
</script>

<style scoped>

</style>
