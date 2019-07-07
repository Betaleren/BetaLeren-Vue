<template>
    <div class="d-flex">
        <div id="video_box">
            <div id="video_play">
                <video id="video_player" autoplay :src="'video/Lost_Control.mp4'"></video>
                <div id="video_controls" style="transform: translateY(0)">
                    <div id="video_controls_seek_bar" title="Time +5 sec (&#8594), -5 sec (&#8592)">
                        <span id="seek_bar_hover_time" style="left: 0px; visibility: hidden">00:00</span>
                        <div id="seek_bar_hover" style="left: 0px; transform: scaleX(0)"></div>
                        <div id="seek_bar_color" style="left: 0px; transform: scaleX(0)"></div>
                        <div id="seek_bar_bal" style="transform: translateX(0)"></div>
                    </div>
                    <div id="video_controls_buttons">
                        <button id="play_pause" class="button" title="Play (Space)"><i class="fas fa-play"></i></button>
                        <button id="volume_button" class="button" title="Mute (M)"><i class="fas fa-volume-up"></i></button>
                        <div id="volume">
                            <input id="volume_slider" type="range" min="0" max="100" value="100" step="1" title="Volume up (&#8593;), down (&#8595;)">
                        </div>
                        <span id="current_time" class="time">00:00</span><span class="time"> / </span><span id="duration_time" class="time">00:00</span>
                        <button id="fullscreen" class="button" style="margin-left: auto;"><i class="fas fa-expand" title="Fullscreen (F)"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Video",
        mounted() {
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
            // let share_link = document.querySelector('#video_share_link');
            // let share_button = document.querySelector('#video_share_button');
            // let share_time = document.querySelector('#video_share_time');
            // let share_time_button = document.querySelector('#video_share_time_button');
            // let textarea = document.querySelector('textarea');

            if (video.paused){
                play.innerHTML = "<i class='fas fa-play'></i>";
            } else {
                play.innerHTML = "<i class='fas fa-pause'></i>";
                controls.style.transform = '';
            }

            function getCookie() {
                let value = "; " + document.cookie;
                let parts = value.split("; volume=");
                if (parts.length === 2) return parts.pop().split(";").shift();
            }

            if (getCookie()){
                video.volume = getCookie();
                volume_slider.value = video.volume * 100;
            }

            let taking_quiz = false;
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
            });

            setInterval(function () {
                seek_bar.style.transform = "scaleX("+ video.currentTime / video.duration +")";
                seek_bal.style.transform = "translateX("+ video_bar.offsetWidth / video.duration * video.currentTime +"px)";

                if (!video.muted) {
                    if (video.volume > 0.66) {
                        volume_button.innerHTML = "<i class='fas fa-volume-up'></i>";
                    }
                    if (video.volume <= 0.66) {
                        volume_button.innerHTML = "<i class='fas fa-volume-down'></i>";
                    }
                    if (video.volume <= 0.33) {
                        volume_button.innerHTML = "<i class='fas fa-volume-off'></i>";
                    }
                    if (video.volume < 0.001) {
                        volume_button.innerHTML = "<i class='fas fa-volume-mute'></i>";
                    }
                }

                let cookie_timer = 10 * 365 * 24 * 60 * 60 * 1000;
                document.cookie = 'volume' + "=" + video.volume.toFixed(2) + ";path=/;expires=" + cookie_timer;
            });

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

            video.addEventListener('mousemove', (e) => mousedown && position(e));

            video.addEventListener('mouseup', function() {
                no_select.classList.remove('no_select');
                mousedown = false;
            });

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

            window.addEventListener('keydown', function(e) {
                if(e.keyCode === 32 && e.target === document.body || e.keyCode === 38 && e.target === document.body || e.keyCode === 40 && e.target === document.body ) {
                    e.preventDefault();
                }
            });

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
                } else {
                    video.muted = false;
                }
            }

            volume_button.onclick = function(){
                mute()
            };

            volume_slider.addEventListener("change", function() {
                video.volume = volume_slider.value / 100;
            });

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
                if (1280 >= video.offsetWidth){
                    openFullscreen();
                } else {
                    closeFullscreen();
                }
            };

            function dbl_fullscreen() {
                if (!taking_quiz) {
                    if (1280 >= video.offsetWidth) {
                        openFullscreen();
                    } else {
                        closeFullscreen();
                    }
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
                timer = setTimeout( controls_display,2000);
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
                if (!taking_quiz) {
                    if (!textarea_typing) {
                        switch (event.keyCode) {
                            case 32:
                                togglePlayPause();
                                break;
                            case 70:
                                if (1280 >= video.offsetWidth) {
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
                                break;
                            default:
                                break;
                        }
                    }
                }
            });
        }
    }
</script>

<style scoped>

</style>
