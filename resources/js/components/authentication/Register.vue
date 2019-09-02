<template>
    <div class="card w-sm-400 login-card">
        <div class="card-header">
            <h3 class="m-0 text-center text-muted">Register</h3>
        </div>
        <div class="card-body">
            <div class="alert alert-danger" v-if="has_error && !success">
                <p class="m-0" v-if="error === 'registration_validation_error'">Validation error (s), please consult the message (s) below.</p>
                <p class="m-0" v-else>Error, can not register at the moment. If the problem persists, please contact an administrator.</p>
            </div>
            <form @submit.prevent="register" v-if="!success" method="post">
                <div class="form-group">
                    <label for="first_name">First name</label>
                    <input type="text" id="first_name" class="form-control" v-model="first_name">
                </div>
                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input type="text" id="last_name" class="form-control" v-model="last_name">
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email">
                    <span class="help-block text-danger" v-if="has_error && errors.email">{{ errors.email[0] }}</span>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" v-model="password">
                    <span class="help-block text-danger" v-if="has_error && errors.password">{{ errors.password[0] }}</span>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                    <label for="password_confirmation">Password confirmation</label>
                    <input type="password" id="password_confirmation" class="form-control" v-model="password_confirmation">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "register",
        data() {
            return {
                first_name: '',
                last_name: '',
                email: '',
                password: '',
                password_confirmation: '',
                has_error: false,
                error: '',
                errors: {},
                success: false
            }
        },    methods: {
            register() {
                let app = this;
                this.$auth.register({
                    data: {
                        first_name: app.first_name,
                        last_name: app.last_name,
                        email: app.email,
                        password: app.password,
                        password_confirmation: app.password_confirmation
                    },
                    success: function () {
                        app.success = true;
                        this.$router.push({name: 'login', params: {successRegistrationRedirect: true}});
                    },
                    error: function (res) {
                        app.has_error = true;
                        app.error = res.response.data.error;
                        app.errors = res.response.data.errors || {}
                    }
                })
            }
        },
    }
</script>

<style scoped>

</style>
