<template>
    <div>
        <div class="pt-3">
            <h4 class="text-muted">Tilte</h4>
        </div>
        <div class="dropdown-divider line"></div>
        <div class="media">
            <router-link to="/profile?u_id=21">
                <img :src="'/img/Profile/default-avatar.png'" class="mr-3 rounded-circle" alt="picture" width="64" height="64">
            </router-link>
            <div class="media-body">
                <div class="row m-0" style="height: 64px">
                    <div class="align-self-center">
                        <router-link to="/profile?u_id=21" class="text-decoration-none text-muted">
                            <h5 class="m-0 text-muted">Uploader</h5>
                        </router-link>
                        <p class="m-0"><small class="text-muted">Upload date</small></p>
                    </div>
                </div>
                <div id="summary">
                    <p class="collapse text-muted" id="collapseSummary">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc porttitor maximus laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In hac habitasse platea dictumst. Suspendisse venenatis sollicitudin erat in gravida. Sed eget nisl tristique, commodo lectus sit amet, vulputate sem. Cras porttitor lorem ipsum, sit amet iaculis massa feugiat vitae. Curabitur sapien odio, ullamcorper tincidunt interdum vitae, vestibulum eu neque. Nam leo massa, fringilla eget mauris feugiat, auctor suscipit justo.
                    </p>
                    <a class="collapsed text-decoration-none text-muted" data-toggle="collapse" href="#collapseSummary" aria-expanded="false" aria-controls="collapseSummary"></a>
                </div>
            </div>
        </div>
        <div class="dropdown-divider line"></div>
    </div>
</template>

<script>
    export default {
        name: "Video-Info"
    }
</script>

<style scoped>

</style>
