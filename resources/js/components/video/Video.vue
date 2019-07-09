<template>
    <div id="video">
        <div class="row">
            <div class="col-xl p-0">
                <div>
                    <VideoControls></VideoControls>
                </div>
                <div>
                    <VideoInfo></VideoInfo>
                </div>
                <div v-show="!showComments">
                    <VideoComments></VideoComments>
                </div>
            </div>
            <div class="w-xl-400 p-0 w--lg-100 pl-xl-3">
                <div id="course_list"  style="height: 747px">
                    <VideoListCourse></VideoListCourse>
                </div>
                <div>
                    <VideoList></VideoList>
                </div>
            </div>
            <div v-show="showComments">
                <VideoComments></VideoComments>
            </div>
        </div>
    </div>
</template>

<script>
    import VideoListCourse from "./video-components/Video-List-Course";
    import VideoComments from "./video-components/Video-Comments";
    import VideoList from "./video-components/Video-List";
    import VideoControls from "./video-components/Video-Controls";
    import VideoInfo from "./video-components/Video-Info";
    export default {
        name: "Video",

        components: {VideoInfo, VideoControls, VideoList, VideoComments, VideoListCourse},

        data() {
          return {
              showComments: false,
          }
        },

        mounted() {
            let th1s = this;
            let cookie_timer = 10 * 365 * 24 * 60 * 60 * 1000;
            let value = "; " + document.cookie;
            let volume;

            let no_select = document.querySelector('#video');
            let screen = document.querySelector('#video_play');
            let video = document.querySelector('#video_player');
            let video_bar = document.querySelector('#video_controls_seek_bar');
            let seek_bar = document.querySelector('#seek_bar_color');
            let seek_bal = document.querySelector('#seek_bar_bal');
            let seek_hover = document.querySelector('#seek_bar_hover');
            let seek_hover_time = document.querySelector('#seek_bar_hover_time');
            let controls = document.querySelector('#video_controls');
            let play = document.querySelector('#play_pause');
            let volume_button = document.querySelector('#volume_button');
            let volume_slider = document.querySelector('#volume_slider');
            let current_time = document.querySelector('#current_time');
            let duration_time = document.querySelector('#duration_time');
            let fullscreen = document.querySelector('#fullscreen');
            let course_list = document.querySelector('#course_list');
            // let share_link = document.querySelector('#video_share_link');
            // let share_button = document.querySelector('#video_share_button');
            // let share_time = document.querySelector('#video_share_time');
            // let share_time_button = document.querySelector('#video_share_time_button');
            // let textarea = document.querySelector('textarea');


            function getCookieVolume() {
                let parts = value.split("; volume=");
                if (parts.length === 2) {
                    volume = parts.pop().split(";").shift();
                }

                return volume;
            }

            if (getCookieVolume()){
                video.volume = getCookieVolume();
                volume_slider.value = video.volume * 100;
            }

            function getCookieMute() {
                let parts = value.split("; mute=");
                if (parts.length === 2) return parts.pop().split(";").shift();
            }

            if (getCookieMute()) {
                video.muted = getCookieMute();
                volume_slider.value = 0;
                volume_button.innerHTML = "<i class='fas fa-volume-mute'></i>";
            }

            video.addEventListener('timeupdate', function () {
                let curmins = Math.floor(video.currentTime / 60);
                let durmins = Math.floor(video.duration / 60);
                let cursecs = Math.floor(video.currentTime - curmins * 60);
                let dursecs = Math.floor(video.duration - durmins * 60);

                if (video.ended) {
                    play.innerHTML = "<i class='fas fa-play'></i>";
                    closeFullscreen();
                }
                if (cursecs < 10) {
                    cursecs = "0" + cursecs;
                }
                if (dursecs < 10) {
                    dursecs = "0" + dursecs;
                }
                if (curmins < 10) {
                    curmins = "0" + curmins;
                }
                if (durmins < 10) {
                    durmins = "0" + durmins;
                }
                current_time.innerHTML = curmins + ":" + cursecs;
                duration_time.innerHTML = durmins + ":" + dursecs;

                seek_bar.style.transform = "scaleX("+ video.currentTime / video.duration +")";
                seek_bal.style.transform = "translateX("+ video_bar.offsetWidth / video.duration * video.currentTime +"px)";
            });

            function resizeChange(){
                if (1200 <= window.innerWidth){
                    course_list.style.height = video.offsetHeight + 'px';
                    th1s.showComments =false;
                } else {
                    course_list.style.height = '310px';
                    th1s.showComments = true;
                }
            }

            setTimeout(resizeChange, 500);

            window.addEventListener("resize", resizeChange);

            function position(e) {
                video.currentTime = (e.offsetX / video_bar.offsetWidth) * video.duration;
            }

            function hover_position(d){
                seek_hover.style.transform = "scaleX("+ d.offsetX / video_bar.offsetWidth +")";
                seek_hover_time.style.left = d.offsetX - 22 + "px";
                seek_hover_time.style.visibility = "visible";
                let hover_time_mins = Math.floor(d.offsetX / video_bar.offsetWidth * video.duration / 60);
                let hover_time_secs = Math.floor(d.offsetX / video_bar.offsetWidth * video.duration - hover_time_mins * 60);

                if (hover_time_secs < 10) {
                    hover_time_secs = "0" + hover_time_secs;
                }
                if (hover_time_mins < 10) {
                    hover_time_mins = "0" + hover_time_mins;
                }
                seek_hover_time.innerHTML = hover_time_mins + ":" + hover_time_secs;
            }

            let mousedown = false;
            video_bar.addEventListener('click', position);

            video_bar.addEventListener('mousemove', (e) => mousedown && position(e));

            video_bar.addEventListener('mousedown', function() {
                no_select.classList.add('no_select');
                mousedown = true;
            });

            video_bar.addEventListener('mouseup', function() {
                no_select.classList.remove('no_select');
                mousedown = false;
            });

            video_bar.addEventListener('mouseover', function () {
                video_bar.addEventListener('mousemove', hover_position);
            });

            video_bar.addEventListener('mouseout', function () {
                seek_hover.style.transform = "scaleX(0)";
                seek_hover_time.style.left = 0 + "px";
                seek_hover_time.style.visibility = "hidden";
            });

            window.addEventListener('mousemove', (e) => mousedown && position(e));

            window.addEventListener('mouseup', function() {
                no_select.classList.remove('no_select');
                mousedown = false;
            });

            function noScroll(e){
                if(e.keyCode === 32 || e.keyCode === 38 || e.keyCode === 40 ) {
                    e.preventDefault();
                }
            }

            window.addEventListener('keydown', noScroll);

            function togglePlayPause() {
                if (video.paused) {
                    video.play();
                    play.innerHTML = "<i class='fas fa-pause'></i>";
                    controls.style.transform = '';
                } else {
                    video.pause();
                    play.innerHTML = "<i class='fas fa-play'></i>";
                    controls.style.transform = 'translateY(0)';
                }
            }

            togglePlayPause();

            play.onclick = function () {
                togglePlayPause();
            };

            video.onclick = function () {
                togglePlayPause()
            };

            function mute() {
                if (!video.muted) {
                    video.muted = true;
                    volume_button.innerHTML = "<i class='fas fa-volume-mute'></i>";
                    volume_slider.value = 0;
                    document.cookie = "mute=" + true + ";path=/;expires=" + cookie_timer;
                } else {
                    video.muted = false;
                    if (volume * 100 > 0) {
                        volume_slider.value = volume * 100;
                    } else {
                        volume_slider.value = 10;
                    }
                    document.cookie = "mute=;path=/;expires=0";
                    volumeIcon();
                }
            }

            volume_button.onclick = function(){
                mute()
            };

            function volumeIcon() {
                if (!video.muted) {
                    if (volume_slider.value > 66) {
                        volume_button.innerHTML = "<i class='fas fa-volume-up'></i>";
                    }
                    if (volume_slider.value <= 66) {
                        volume_button.innerHTML = "<i class='fas fa-volume-down'></i>";
                    }
                    if (volume_slider.value <= 33) {
                        volume_button.innerHTML = "<i class='fas fa-volume-off'></i>";
                    }
                    if (volume_slider.value <= 0) {
                        volume_button.innerHTML = "<i class='fas fa-volume-mute'></i>";
                        mute()
                    }

                    video.volume = volume_slider.value / 100;
                    volume = volume_slider.value / 100;
                    document.cookie = "volume=" + video.volume.toFixed(2) + ";path=/;expires=" + cookie_timer;
                } else {

                }
            }

            volumeIcon();


            volume_slider.addEventListener("change", volumeIcon);

            function openFullscreen() {
                if (screen.requestFullscreen) {
                    screen.requestFullscreen();
                } else if (screen.mozRequestFullScreen) {
                    screen.mozRequestFullScreen();
                } else if (screen.webkitRequestFullscreen) {
                    screen.webkitRequestFullscreen();
                }
                video.style.maxWidth = video.videoWidth + 'px';
            }

            function closeFullscreen() {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (screen.mozCancelFullScreen) {
                    screen.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                }
            }

            fullscreen.onclick = function () {
                if (1328 >= video.offsetWidth){
                    openFullscreen();
                } else {
                    closeFullscreen();
                }
            };

            function dbl_fullscreen() {
                if (1328 >= video.offsetWidth) {
                    openFullscreen();
                } else {
                    closeFullscreen();
                }
            }

            screen.addEventListener('dblclick', dbl_fullscreen);

            function controls_display() {
                controls.style.display = 'none';
                document.body.style.cursor = 'none';
            }

            let timer = 0;
            function mouse_move() {
                controls.style.display = '';
                document.body.style.cursor = '';
                clearTimeout(timer);
                timer = setTimeout( controls_display, 2000);
            }

            screen.addEventListener('mousemove', function () {
                if (video.offsetWidth >= video.videoWidth){
                    screen.addEventListener('mousemove', mouse_move);
                    controls_display();
                    controls.style.display = 'none';
                    document.body.style.cursor = 'none';
                } else {
                    screen.removeEventListener('mousemove', mouse_move);
                    controls.style.display = '';
                    document.body.style.cursor = '';
                }
            });

            let share = false;
            // share_button.addEventListener('click', function () {
            //     share_link.value = window.location.href.match(/^.+video=\d+/)[0];
            //     if (!share) {
            //         share_link.style.display = 'block';
            //         share_time.style.display = 'block';
            //         share_link.select();
            //         document.execCommand('copy');
            //         share = true;
            //         share_time_button.addEventListener('click', function () {
            //             if (share_time_button.checked === true){
            //                 let video_time = video.currentTime.toFixed(0);
            //                 share_link.value = window.location.href.match(/^.+video=\d+/)[0] + '&time=' + video_time;
            //                 share_link.select();
            //                 document.execCommand('copy');
            //             } else {
            //                 share_link.value = window.location.href.match(/^.+video=\d+/)[0];
            //                 share_link.select();
            //                 document.execCommand('copy');
            //             }
            //         });
            //     } else {
            //         share_link.style.display = 'none';
            //         share_time.style.display = 'none';
            //         share = false;
            //     }
            // });

            let textarea_typing = false;
            // textarea.addEventListener('focusin', function () {
            //     textarea_typing = true
            // });
            //
            // textarea.addEventListener('focusout', function () {
            //     textarea_typing = false
            // });

            window.addEventListener('keyup', function (event) {
                if (!textarea_typing) {
                    switch (event.keyCode) {
                        case 32:
                            togglePlayPause();
                            break;
                        case 70:
                            if (1328 >= video.offsetWidth) {
                                openFullscreen()
                            } else {
                                closeFullscreen()
                            }
                            break;
                        case 77:
                            mute();
                            break;
                        case 37:
                            video.currentTime = video.currentTime - 5;
                            break;
                        case 38:
                            if (video.volume >= 0.9) {
                                video.volume = 1;
                            } else {
                                video.volume = video.volume + 0.1;
                            }
                            volume_slider.value = video.volume * 100;
                            volumeIcon();
                            break;
                        case 39:
                            video.currentTime = video.currentTime + 5;
                            break;
                        case 40:
                            if (video.volume <= 0.1) {
                                video.volume = 0;
                            } else {
                                video.volume = video.volume - 0.1;
                            }
                            volume_slider.value = video.volume * 100;
                            volumeIcon();
                            break;
                        default:
                            break;
                    }
                }
            });
        },
    }
</script>

<style scoped>

</style>
