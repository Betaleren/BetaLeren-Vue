<template>
    <div id="video_play">
        <video id="video_player" :src="'video/Lost_Control.mp4'"></video>
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
</template>

<script>
    export default {
        name: "Video-Controls"
    }
</script>

<style scoped>

</style>
