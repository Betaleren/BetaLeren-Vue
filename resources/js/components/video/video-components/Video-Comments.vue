<template>
    <div>
        <div class="media" v-for="comment_1 in comments" :key="comment_1.id">
            <router-link to="/profile?u_id=21">
                <img :src="'/img/Profile/default-avatar.png'" class="mr-3 rounded-circle" alt="picture" width="64" height="64">
            </router-link>
            <div class="media-body">
                <div class="row m-0" style="height: 64px">
                    <router-link to="/profile?u_id=21" class="align-self-center text-decoration-none text-muted">
                        <h5 class="m-0">Name</h5>
                    </router-link>
                </div>
                <div id="summary">
                    <p class="collapse text-muted" :id="'comment_' + comment_1.id">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc porttitor maximus laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In hac habitasse platea dictumst. Suspendisse venenatis sollicitudin erat in gravida. Sed eget nisl tristique, commodo lectus sit amet, vulputate sem. Cras porttitor lorem ipsum, sit amet iaculis massa feugiat vitae. Curabitur sapien odio, ullamcorper tincidunt interdum vitae, vestibulum eu neque. Nam leo massa, fringilla eget mauris feugiat, auctor suscipit justo.
                    </p>
                    <a class="collapsed text-decoration-none text-muted" data-toggle="collapse" :href="'#comment_' + comment_1.id" aria-expanded="false" aria-controls="collapseSummary"></a>
                </div>
                <div class="media mt-3" v-for="comment_2 in comment_1.comments" :key="comment_1.id + '_' + comment_2.id">
                    <router-link to="/profile?u_id=21">
                        <img :src="'/img/Profile/default-avatar.png'" class="mr-3 rounded-circle" alt="picture" width="32" height="32">
                    </router-link>
                    <div class="media-body">
                        <div class="row m-0" style="height: 32px">
                            <router-link to="/profile?u_id=21" class="align-self-center text-decoration-none text-muted">
                                <h6 class="m-0">Name</h6>
                            </router-link>
                        </div>
                        <div id="summary">
                            <p class="collapse text-muted" :id="'comment_' + comment_1.id + '_' + comment_2.id">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc porttitor maximus laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In hac habitasse platea dictumst. Suspendisse venenatis sollicitudin erat in gravida. Sed eget nisl tristique, commodo lectus sit amet, vulputate sem. Cras porttitor lorem ipsum, sit amet iaculis massa feugiat vitae. Curabitur sapien odio, ullamcorper tincidunt interdum vitae, vestibulum eu neque. Nam leo massa, fringilla eget mauris feugiat, auctor suscipit justo.
                            </p>
                            <a class="collapsed text-decoration-none text-muted" data-toggle="collapse" :href="'#comment_' + comment_1.id + '_' + comment_2.id" aria-expanded="false" aria-controls="collapseSummary"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Video-Commands",
        data(){
            return {
                comments: [
                    {
                        id: '1',
                        comments: [
                            {id: '1'},
                            {id: '2'},
                            {id: '3'},
                        ],
                    },
                    {
                        id: '2',
                        comments: [
                            {id: '1'},
                            {id: '2'},
                        ],
                    },
                    {
                        id: '3',
                        comments: [
                            {id: '1'},
                            {id: '2'},
                        ],
                    },
                ],
            }
        },
    }
</script>

<style scoped>

</style>
