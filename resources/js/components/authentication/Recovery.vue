<template>
    <div class="container">
        <div class="card w-sm-400 login-card">
            <div class="card-header">
                <h3 class="m-0 text-center text-muted">Password reset</h3>
            </div>
            <div v-if="!recovery_code" class="card-body">
                <div class="alert alert-danger" v-if="has_error && errors.email">
                    <p class="m-0">{{ errors.email[0] }}</p>
                </div>
                <div class="alert alert-success" v-if="has_success && success.send">
                    <p class="m-0">{{ success.send[0] }}</p>
                </div>
                <form @submit.prevent="send" method="post">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>

            <div v-if="recovery_code" class="card-body">
                <div class="alert alert-danger" v-if="has_error && errors.recovery_code">
                    <p class="m-0">{{ errors.recovery_code[0] }}</p>
                </div>
                <div class="alert alert-success" v-if="has_success && success.changed">
                    <p class="m-0">{{ success.changed[0] }}</p>
                </div>
                <form @submit.prevent="change" method="post">
                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                        <label for="password">New password</label>
                        <input type="password" id="password" class="form-control" v-model="password">
                        <span class="help-block text-danger" v-if="has_error && errors.password">{{ errors.password[0] }}</span>
                    </div>
                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                        <label for="password_confirmation">Password confirmation</label>
                        <input type="password" id="password_confirmation" class="form-control" v-model="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary">Change</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Recovery",
        data() {
            return {
                email: null,
                password: null,
                password_confirmation: null,
                errors: {},
                success: {},
                has_error: false,
                has_success: false,
                recovery_code: false,
            }
        },    mounted() {
            let recovery_code = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
            if (recovery_code !== 'recovery') {
                this.recovery_code = true
            }
        },    methods: {
            send() {
                let app = this;
                this.$http({
                    url: 'auth/recovery',
                    method: 'POST',
                    data: {
                        email: app.email
                    }
                }).then((res) => {
                    app.has_error = false;
                    app.has_success = true;
                    app.success = res.data.message || {};
                }, (res) => {
                    app.has_error = true;
                    app.has_success = false;
                    app.errors = res.response.data.errors || {};
                })
            },
            change() {
                let app = this;
                let recovery_code = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
                this.$http({
                    url: 'auth/change',
                    method: 'POST',
                    data: {
                        password: app.password,
                        recovery_code: recovery_code,
                        password_confirmation: app.password_confirmation,
                    }
                }).then((res) => {
                    app.has_error = false;
                    app.has_success = true;
                    app.success = res.data.message || {};
                }, (res) => {
                    app.has_error = true;
                    app.has_success = false;
                    app.errors = res.response.data.errors || {};
                })
            }
        },
    }
</script>

<style scoped>

</style>
