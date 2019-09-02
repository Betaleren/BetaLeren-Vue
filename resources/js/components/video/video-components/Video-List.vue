<template>
    <div class="list-group card-body px-0 overflow-auto" style="scroll-behavior: smooth">
        <router-link class="list-group-item list-group-item-action bg-transparent rounded-0 border-0 px-0 py-1 text-decoration-none" :to="{query: { test: video.id }}" v-for="video in videos" :key="video.id">
            <div class="row m-0">
                <div class="position-relative" style="width: 168px; height: 94.55px">
                    <span class="badge badge-videos">00:00:00</span>
                    <img :src="'img/thumbnail/video-background.jpg'" class="card-img" alt="thumbnail" width="168px" height="94.55px">
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
</template>

<script>
    export default {
        name: "Video-List",
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
