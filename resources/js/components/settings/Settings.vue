<template>
    <div>
        <div class="btn-group row mb-3 w-100" role="group" aria-label="Basic example">
            <button type="button" class="btn rounded-0 flex-grow-0" value="ProfilePicture" :class="{activeLine: this.settings.ProfilePicture}" v-on:click="SettingsOpen($event)">Profile Picture</button>
            <button type="button" class="btn rounded-0 flex-grow-0" value="ChangePassword" :class="{activeLine: this.settings.ChangePassword}" v-on:click="SettingsOpen($event)">Change Password</button>
            <button type="button" class="btn rounded-0 flex-grow-0" value="Private" :class="{activeLine: this.settings.Private}" v-on:click="SettingsOpen($event)">Private</button>
        </div>
        <div>
            <div v-if="settings.ProfilePicture">
                <ProfilePicture></ProfilePicture>
            </div>
            <div v-if="settings.ChangePassword">
                <ChangePassword></ChangePassword>
            </div>
        </div>
    </div>
</template>

<script>
    import ChangePassword from "./sub-settings/Change-Password";
    import ProfilePicture from "./sub-settings/Profile-Picture";
    export default {
        name: "Settings",
        components: {ProfilePicture, ChangePassword},
        data() {
            return {
                settings: {
                    ProfilePicture: true,
                    ChangePassword: false,
                    Private: false,
                },
                previous: 'ProfilePicture',
            }
        },
        methods: {
            SettingsOpen(e) {
                let value = e.target.value;
                let previousValue = this.previous;
                if (previousValue !== value){
                    this.settings[previousValue] = false;
                    this.settings[value] = true;
                    this.previous = value;
                }
            }
        }
    }
</script>

<style scoped>

</style>
