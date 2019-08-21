<template>
    <div>
        <div class="media mb-3">
            <router-link to="/profile?u_id=21">
                <img :src="'/img/Profile/default-avatar.png'" class="mr-3 rounded-circle" alt="picture" width="40" height="40">
            </router-link>
            <div class="media-body">
                <form @submit.prevent="">
                    <div class="form-group">
                        <textarea class="form-control bg-transparent border-top-0 border-left-0 border-right-0 rounded-0 no_resize overflow-hidden" rows="1" placeholder="Comment" v-model="kanker" data-autoresize v-on:click="openSend('.comment_send')"></textarea>
                    </div>
                    <div class="form-group collapse" :class="'comment_send'">
                        <button type="submit" class="btn btn-primary mx-1 rounded-0 float-right" v-on:click="closeSend('.comment_send')">Send</button>
                        <button type="reset" class="btn bg-light mx-1 rounded-0 float-right" v-on:click="closeSend('.comment_send')">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="media" v-for="comment_1 in comments" :key="comment_1.id">
            <router-link to="/profile?u_id=21">
                <img :src="'/img/Profile/default-avatar.png'" class="mr-3 rounded-circle" alt="picture" width="40" height="40">
            </router-link>
            <div class="media-body mb-3">
                <router-link to="/profile?u_id=21" class="text-decoration-none text-muted-darker">
                    <h6 class="m-0">Name</h6>
                </router-link>
                <div id="summary" data-expand>
                    <p class="collapse my-1 text-muted" :id="'comment_' + comment_1.id">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc porttitor maximus laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                    </p>
                    <a class="collapsed text-decoration-none text-muted hidden" data-toggle="collapse" :href="'#comment_' + comment_1.id" aria-expanded="false" aria-controls="collapseSummary"></a>
                </div>
                <details class="mt-1" :class="'comment_reply_' + comment_1.id">
                    <summary class="list-unstyled text-muted-darker no_select">Reply</summary>
                    <div class="media mb-3">
                        <router-link to="/profile?u_id=21">
                            <img :src="'/img/Profile/default-avatar.png'" class="mr-3 rounded-circle" alt="picture" width="24" height="24">
                        </router-link>
                        <div class="media-body">
                            <form @submit.prevent="">
                                <div class="form-group">
                                    <textarea class="form-control bg-transparent border-top-0 border-left-0 border-right-0 rounded-0 no_resize overflow-hidden" rows="1" placeholder="Reply to the comment" data-autoresize></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mx-1 rounded-0 float-right" v-on:click="closeReply('.comment_reply_' + comment_1.id)">Send</button>
                                    <button type="reset" class="btn bg-light mx-1 rounded-0 float-right" v-on:click="closeReply('.comment_reply_' + comment_1.id)">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </details>
                <details class="mb-1" v-show="comment_1.comments.length !== 0">
                    <summary class="text-muted-darker no_select" v-on:click="test">Answers</summary>
                    <div class="media mt-3" v-for="comment_2 in comment_1.comments" :key="comment_1.id + '_' + comment_2.id">
                        <router-link to="/profile?u_id=21">
                            <img :src="'/img/Profile/default-avatar.png'" class="mr-3 rounded-circle" alt="picture" width="24" height="24">
                        </router-link>
                        <div class="media-body">
                            <router-link to="/profile?u_id=21" class="text-decoration-none text-muted-darker">
                                <h6 class="m-0">Name</h6>
                            </router-link>
                            <div id="summary" data-expand>
                                <p class="collapse my-1 text-muted" :id="'comment_' + comment_1.id + '_' + comment_2.id">
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui.
                                </p>
                                <a class="collapsed text-decoration-none text-muted hidden" data-toggle="collapse" :href="'#comment_' + comment_1.id + '_' + comment_2.id" aria-expanded="false" aria-controls="collapseSummary"></a>
                            </div>
                        </div>
                    </div>
                </details>
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
                            {
                                id: '1',
                            },
                        ],
                    },
                    {
                        id: '3',
                        comments: [
                            {id: '1'},
                            {id: '2'},
                        ],
                    },
                    {
                        id: '4',
                        comments: [
                        ],
                    },
                ],
            }
        },

        mounted() {
            this.addAutoResize();
            setTimeout(this.textExpand, 1000);

            window.addEventListener("resize", this.textExpand);
        },

        methods: {
            test() {
                setTimeout(this.textExpand, 250);
            },

            textExpand() {
                document.querySelectorAll('[data-expand]').forEach(function (element){
                    let height = element.children[0].clientHeight;
                    let event = element.children[1];

                    if (height > 63){
                        event.classList.remove('hidden')
                    } else {
                        event.classList.add('hidden')
                    }
                });
            },

            addAutoResize() {
                document.querySelectorAll('[data-autoresize]').forEach(function (element) {
                    element.style.boxSizing = 'border-box';
                    let offset = element.offsetHeight - element.clientHeight;
                    document.addEventListener('input', function (event) {
                        event.target.style.height = 'auto';
                        event.target.style.height = event.target.scrollHeight + offset + 'px';
                    });
                    element.removeAttribute('data-autoresize');
                });
            },

            openSend(a) {
                $(a).addClass('show');
            },

            closeSend(a) {
                $(a).removeClass('show');
            },

            closeReply(a) {
                Array.from($(a)).forEach(function (obj) {
                    obj.open = false;
                })
            },
        }
    }
</script>

<style scoped>

</style>
