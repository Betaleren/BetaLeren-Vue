<template>
    <div id="video">
        <div class="row d-xl-block">
            <div class="col-xl-9 float-xl-left order-1 p-0">
                <VideoControls></VideoControls>
            </div>
            <div class="col-xl-3 float-xl-right order-3 order-xl-2 p-0 pl-xl-3" id="course_list" style="height: 738.4px">
                <VideoListCourse></VideoListCourse>
            </div>
            <div class="col-xl-9 float-xl-left order-2 order-xl-3 p-0">
                <VideoInfo></VideoInfo>
            </div>
            <div class="col-xl-3 float-xl-right order-4 order-xl-5 p-0 pl-xl-3">
                <VideoList></VideoList>
            </div>
            <div class="col-xl-9 float-xl-left order-5 order-xl-4 p-0">
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

        mounted() {

            //Default values
            let volume;
            let timer = 0;
            let source = null;
            let mousedown = false;
            let mouseover = false;
            let volume_change = false;
            let textarea_typing = false;
            let value = "; " + document.cookie;
            let cookie_timer = 10 * 365 * 24 * 60 * 60 * 1000;

            //The selected elements by id
            let no_select = document.querySelector('#video');
            let play = document.querySelector('#play_pause');
            let screen = document.querySelector('#video_play');
            let video = document.querySelector('#video_player');
            let seek_bal = document.querySelector('#seek_bar_bal');
            let fullscreen = document.querySelector('#fullscreen');
            let controls = document.querySelector('#video_controls');
            let course_list = document.querySelector('#course_list');
            let seek_bar = document.querySelector('#seek_bar_color');
            let seek_hover = document.querySelector('#seek_bar_hover');
            let current_time = document.querySelector('#current_time');
            let share_link = document.querySelector('#video_share_link');
            let volume_button = document.querySelector('#volume_button');
            let volume_slider = document.querySelector('#volume_slider');
            let duration_time = document.querySelector('#duration_time');
            let share_button = document.querySelector('#video_share_button');
            let video_bar = document.querySelector('#video_controls_seek_bar');
            let seek_hover_time = document.querySelector('#seek_bar_hover_time');
            let share_time_button = document.querySelector('#video_share_time_button');
            let share_copy_button = document.querySelector('#video_share_copy_button');

            //The selected elements by tag name
            document.querySelectorAll('textarea').forEach(typingTextarea);

            //The script to be executed during loading
            window.onload = function () {
                video.setAttribute('src', 'video/Mandy.webm');
            };

            video.oncanplaythrough = function() {
                videoInformation();

                //The addEventListeners
                play.addEventListener('click', togglePlayPause);

                fullscreen.addEventListener('click', clickFullscreen);

                screen.addEventListener('mousemove', moveScreen);

                screen.addEventListener('dblclick', doubleClickFullscreen);

                volume_button.addEventListener('click', mute);

                volume_slider.addEventListener("change", volumeSliderChange);

                share_button.addEventListener('click', clickShareButton);

                share_time_button.addEventListener('click', clickShareTime);

                share_copy_button.addEventListener('click', clickShareCopyButton);

                video.addEventListener('timeupdate', videoTime);

                video.addEventListener('click', togglePlayPause);

                video_bar.addEventListener('mouseout', hoverOutBar);

                video_bar.addEventListener('mouseover', hoverOverBar);

                video_bar.addEventListener('click', clickPositionBar);

                video_bar.addEventListener('mousedown', clickDownBar);

                video_bar.addEventListener('mousemove', (e) => mouseover && hoverPositionBar(e));

                window.addEventListener('keydown', noScroll);

                window.addEventListener('mouseup', clickUpBar);

                window.addEventListener("resize", resizeChange);

                window.addEventListener('keydown', keyShortcuts);

                window.addEventListener('mousemove', (e) => mousedown && clickPositionBar(e));
            };

            //The functions
            function videoInformation() {
                volumeIcon();

                videoTotalTime();

                shareVideoTime();

                videoPlay();

                resizeChange();

                if (getCookieVolume()) {
                    video.volume = getCookieVolume();
                    volume_slider.value = video.volume * 100;
                }

                if (getCookieMute()) {
                    video.muted = getCookieMute();
                    volume_slider.value = 0;
                    volume_button.innerHTML = "<i class='fas fa-volume-mute'></i>";
                }
            }

            function getAllUrlParams(url) {
                let queryString = url ? url.split('?')[1] : window.location.search.slice(1);
                let obj = {};

                if (queryString) {
                    queryString = queryString.split('#')[0];
                    let arr = queryString.split('&');

                    for (let i = 0; i < arr.length; i++) {
                        let a = arr[i].split('=');
                        let paramName = a[0];
                        let paramValue = typeof (a[1]) === 'undefined' ? true : a[1];

                        paramName = paramName.toLowerCase();
                        if (typeof paramValue === 'string') paramValue = paramValue.toLowerCase();

                        if (paramName.match(/\[(\d+)?\]$/)) {
                            let key = paramName.replace(/\[(\d+)?\]/, '');
                            if (!obj[key]) obj[key] = [];

                            if (paramName.match(/\[\d+\]$/)) {
                                let index = /\[(\d+)\]/.exec(paramName)[1];
                                obj[key][index] = paramValue;
                            } else {
                                obj[key].push(paramValue);
                            }
                        } else {
                            if (!obj[paramName]) {
                                obj[paramName] = paramValue;
                            } else if (obj[paramName] && typeof obj[paramName] === 'string') {
                                obj[paramName] = [obj[paramName]];
                                obj[paramName].push(paramValue);
                            } else {
                                obj[paramName].push(paramValue);
                            }
                        }
                    }
                }
                return obj;
            }

            function shareVideoTime() {
                if (getAllUrlParams().time) {
                    video.currentTime = getAllUrlParams().time;
                }
            }

            function getCookieVolume() {
                let parts = value.split("; volume=");
                if (parts.length === 2) {
                    volume = parts.pop().split(";").shift();
                }
                return volume;
            }

            function getCookieMute() {
                let parts = value.split("; mute=");
                if (parts.length === 2) return parts.pop().split(";").shift();
            }

            function videoTotalTime() {
                setTimeout(function () {
                    let durhours = Math.floor(video.duration / 3600);
                    let durmins = Math.floor(video.duration / 60 - (durhours * 60));
                    let dursecs = Math.floor(video.duration - (durmins * 60) - (durhours * 3600));

                    if (dursecs < 10) {
                        dursecs = "0" + dursecs;
                    }
                    if (durmins < 10) {
                        durmins = "0" + durmins;
                    }

                    if (durhours > 0) {
                        duration_time.innerHTML = durhours + ":" + durmins + ":" + dursecs;
                    } else {
                        duration_time.innerHTML = durmins + ":" + dursecs;
                    }
                }, 250)
            }

            function sliderBar() {
                seek_bar.style.transform = "scaleX(" + video.currentTime / video.duration + ")";
                seek_bal.style.transform = "translateX(" + video_bar.offsetWidth / video.duration * video.currentTime + "px)";
            }

            function videoTime() {
                let curhours = Math.floor(video.currentTime / 3600);
                let curmins = Math.floor(video.currentTime / 60 - (curhours * 60));
                let cursecs = Math.floor(video.currentTime - (curmins * 60) - (curhours * 3600));

                if (video.ended) {
                    play.innerHTML = "<i class='fas fa-play'></i>";
                    closeFullscreen();
                }
                if (cursecs < 10) {
                    cursecs = "0" + cursecs;
                }
                if (curmins < 10) {
                    curmins = "0" + curmins;
                }

                if (curhours > 0) {
                    current_time.innerHTML = curhours + ":" + curmins + ":" + cursecs;
                } else {
                    current_time.innerHTML = curmins + ":" + cursecs;
                }

                sliderBar();
            }

            function resizeChange() {
                if (1200 <= window.innerWidth) {
                    course_list.style.height = video.offsetHeight + 'px';
                } else {
                    course_list.style.height = '310px';
                }
            }

            function clickPositionBar(e) {
                video.currentTime = Math.floor((e.offsetX / video_bar.offsetWidth) * video.duration);
                console.log(Math.floor((e.offsetX / video_bar.offsetWidth) * video.duration));
                //sliderBar();
            }

            function hoverPositionBar(e) {
                seek_hover.style.transform = "scaleX(" + e.offsetX / video_bar.offsetWidth + ")";
                seek_hover_time.style.left = e.offsetX - 22 + "px";
                seek_hover_time.style.visibility = "visible";
                let hover_time_hours = Math.floor(e.offsetX / video_bar.offsetWidth * video.duration / 3600);
                let hover_time_mins = Math.floor(e.offsetX / video_bar.offsetWidth * video.duration / 60 - (hover_time_hours * 60));
                let hover_time_secs = Math.floor(e.offsetX / video_bar.offsetWidth * video.duration - (hover_time_mins * 60) - (hover_time_hours * 3600));

                if (hover_time_secs < 10) {
                    hover_time_secs = "0" + hover_time_secs;
                }
                if (hover_time_mins < 10) {
                    hover_time_mins = "0" + hover_time_mins;
                }

                if (hover_time_hours > 0) {
                    seek_hover_time.innerHTML = hover_time_hours + ":" + hover_time_mins + ":" + hover_time_secs;
                } else {
                    seek_hover_time.innerHTML = hover_time_mins + ":" + hover_time_secs;
                }
            }

            function clickDownBar() {
                no_select.classList.add('no_select');
                mousedown = true;
            }

            function clickUpBar() {
                no_select.classList.remove('no_select');
                mousedown = false;
            }

            function hoverOverBar() {
                mouseover = true
            }

            function hoverOutBar() {
                seek_hover.style.transform = "scaleX(0)";
                seek_hover_time.style.left = 0 + "px";
                seek_hover_time.style.visibility = "hidden";
                mouseover = false;
            }

            function noScroll(e) {
                if (!textarea_typing) {
                    if (e.keyCode === 32 || e.keyCode === 38 || e.keyCode === 40) {
                        e.preventDefault();
                    }
                }
            }

            function videoPlay() {
                video.play();
                play.innerHTML = "<i class='fas fa-pause'></i>";
                controls.style.transform = '';
            }

            function togglePlayPause() {
                if (video.paused) {
                    videoPlay();
                } else {
                    video.pause();
                    play.innerHTML = "<i class='fas fa-play'></i>";
                    controls.style.transform = 'translateY(0)';
                }
                moveScreen()
            }

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
                        volume_slider.value = 5;
                    }
                    document.cookie = "mute=;path=/;expires=0";
                    volumeIcon();
                }
            }

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
                    if (volume_change) {
                        if (video.muted) {
                            mute()
                        }
                        volume_change = false;
                    }
                }
            }

            function volumeSliderChange() {
                volume_change = true;
                volume = volume_slider.value / 100;
                volumeIcon();
            }

            function openFullscreen() {
                if (screen.requestFullscreen) {
                    screen.requestFullscreen();
                } else if (screen.mozRequestFullScreen) {
                    screen.mozRequestFullScreen();
                } else if (screen.webkitRequestFullscreen) {
                    screen.webkitRequestFullscreen();
                }
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

            function clickFullscreen() {
                if (1296 >= video.offsetWidth) {
                    openFullscreen();
                } else {
                    closeFullscreen();
                }
            }

            function doubleClickFullscreen() {
                if (1296 >= video.offsetWidth) {
                    openFullscreen();
                } else {
                    closeFullscreen();
                }
            }

            function controls_display() {
                controls.style.display = 'none';
                document.body.style.cursor = 'none';
            }


            function moveScreen() {
                if (document.fullscreen && !video.paused) {
                    controls.style.display = '';
                    document.body.style.cursor = '';
                    clearTimeout(timer);
                    timer = setTimeout(controls_display, 2000);
                } else {
                    timer = 0;
                    controls.style.display = '';
                    document.body.style.cursor = '';
                }
            }

            function clickShareButton() {
                $('#share').modal('show');
                share_link.value = window.location.href.match(/^.+video=\d+/)[0];
                clickShareTime();
            }

            function clickShareTime() {
                setTimeout(function () {
                    if (share_time_button.children[0].checked === true) {
                        let video_time = video.currentTime.toFixed(0);
                        share_link.value = window.location.href.match(/^.+video=\d+/)[0] + '&time=' + video_time;
                    } else {
                        share_link.value = window.location.href.match(/^.+video=\d+/)[0];
                    }
                }, 250);
            }

            function clickShareCopyButton() {
                share_link.select();
                document.execCommand('copy');
            }

            function typingTextarea(element) {
                element.addEventListener('focusin', function () {
                    textarea_typing = true
                });

                element.addEventListener('focusout', function () {
                    textarea_typing = false
                });
            }

            function keyShortcuts(event) {
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
                            sliderBar();
                            break;
                        case 38:
                            if (video.volume >= 0.95) {
                                video.volume = 1;
                            } else {
                                video.volume = video.volume + 0.05;
                            }
                            volume_slider.value = video.volume * 100;
                            volume_change = true;
                            volumeIcon();
                            break;
                        case 39:
                            video.currentTime = video.currentTime + 5;
                            sliderBar();
                            break;
                        case 40:
                            if (video.volume <= 0.05) {
                                video.volume = 0;
                            } else {
                                video.volume = video.volume - 0.05;
                            }
                            volume_slider.value = video.volume * 100;
                            volume_change = true;
                            volumeIcon();
                            break;
                        default:
                            break;
                    }
                }
            }
        },
    }
</script>

<style scoped>

</style>
