<template>
    <div id="video_play">
        <video id="video_player" :poster="'img/video-background.jpg'" :controlslist="'nodownload'" preload="auto"></video>
        <div id="video_controls" style="transform: translateY(0)">
            <div id="video_controls_seek_bar" :title="'Time -5 sec (\u2190), +5 sec (\u2192)'">
                <span id="seek_bar_hover_time" style="left: 0px; visibility: hidden">00:00</span>
                <div id="seek_bar_hover" style="left: 0px; transform: scaleX(0)"></div>
                <div id="seek_bar_color" style="left: 0px; transform: scaleX(0)"></div>
                <div id="seek_bar_bal" style="transform: translateX(0)"></div>
            </div>
            <div id="video_controls_buttons">
                <button id="play_pause" class="button" title="Play (Space)"><i class="fas fa-play"></i></button>
                <button id="volume_button" class="button" title="Mute (M)"><i class="fas fa-volume-up"></i></button>
                    <div id="volume">
                        <input  type="range" id="volume_slider" min="0" max="100" value="100" step="1" :title="'Volume up (\u2191;), down (\u2193;)'">
                    </div>
                <span id="current_time" class="time">00:00</span><span class="time"> / </span><span id="duration_time" class="time">00:00</span>
                <button id="fullscreen" class="button" style="margin-left: auto;"><i class="fas fa-expand" title="Fullscreen (F)"></i></button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Video-Controls",
    }
</script>

<style scoped>

</style>
