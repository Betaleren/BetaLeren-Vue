<template>
    <div>
        <div class="pt-3 px-15 row">
            <h4 class="text-muted m-0">Tilte</h4>
            <button class="btn bg-transparent p-0 ml-auto text-muted" id="video_share_button"><i class="far fa-share-square pr-1"></i>Share</button>
        </div>
        <div class="modal fade" id="share" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title">Share video links</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3 bg-light">
                            <input type="text" class="form-control bg-transparent rounded-0 border-0" id="video_share_link" readonly placeholder="Share link" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn bg-transparent rounded-0 border-0" id="video_share_copy_button" type="button">Copy</button>
                            </div>
                        </div>
                        <div class="row justify-content-between px-15">
                            <h5 class="modal-title">Share with</h5>
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary rounded-0" id="video_share_time_button" style="cursor: pointer">
                                    <input type="checkbox"> Time
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dropdown-divider line"></div>
        <div class="media">
            <router-link to="/profile?u_id=21">
                <img :src="'/img/Profile/default-avatar.png'" class="mr-3 rounded-circle" alt="picture" width="48" height="48">
            </router-link>
            <div class="media-body">
                <div class="row m-0" style="height: 48px">
                    <div class="align-self-center">
                        <router-link to="/profile?u_id=21" class="text-decoration-none text-muted-darker">
                            <h6 class="m-0">Uploader</h6>
                        </router-link>
                        <small class="text-muted-lighter">Upload date</small>
                    </div>
                </div>
                <div id="summary" data-expand>
                    <p class="collapse my-1 text-muted" id="collapseSummary">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc porttitor maximus laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In hac habitasse platea dictumst. Suspendisse venenatis sollicitudin erat in gravida. Sed eget nisl tristique, commodo lectus sit amet, vulputate sem. Cras porttitor lorem ipsum, sit amet iaculis massa feugiat vitae. Curabitur sapien odio, ullamcorper tincidunt interdum vitae, vestibulum eu neque. Nam leo massa, fringilla eget mauris feugiat, auctor suscipit justo.
                    </p>
                    <a class="collapsed text-decoration-none text-muted hidden" data-toggle="collapse" href="#collapseSummary" aria-expanded="false" aria-controls="collapseSummary"></a>
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
