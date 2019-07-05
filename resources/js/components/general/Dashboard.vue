<template>
    <div class="row container-videos">
        <h3 class="px-1 text-muted">Continue Watching:</h3>
        <div class="p-1">
            <div class="card border-0 bg-transparent">
                <router-link to="/video" class="nav-link p-0">
                    <div class="row no-gutters">
                        <div class="col-lg-4">
                            <span class="badge badge-videos">00:00:00</span>
                            <img :src="'img/thumbnail/video-background.jpg'" class="card-img" alt="thumbnail">
                        </div>
                        <div class="col-lg-8">
                            <div class="card-body d-flex flex-column h-100">
                                <h5 class="card-title text-muted mb-2">Title</h5>
                                <p class="card-text text-muted mb-2 overflow-auto continue-videos">This is a wider card with supporting text below as a natural lead-in to additional content. This is a wider card with supporting text below as a natural lead-in to additional content.This is a wider card with supporting text below as a natural lead-in to additional content. This is a wider card with supporting text below as a natural lead-in to additional content. wwewa adawd awdawd awd wad awd awd awdawd awd a daw daw dwa. This is a wider card with supporting text below as a natural lead-in to additional content. This is a wider card with supporting text below as a natural lead-in to additional content.This is a wider card with supporting text below as a natural lead-in to additional content. This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                                <p class="card-text mt-auto"><small class="text-muted">Uploader</small></p>
                            </div>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
        <div class="dropdown-divider line mx-0"></div>
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
</template>

<script>
    export default {
        name: "Dashboard",
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
            }
        },
    }
</script>

<style scoped>

</style>
