<template>
    <div class="card w-sm-400 login-card">
        <div class="card-header">
            <h3 class="m-0 text-center text-muted">Log in</h3>
        </div>
        <div class="card-body">
            <div class="alert alert-danger" v-if="has_error && errors.verify || errors.fail_verify">
                <p v-if="errors.verify" class="m-0">{{ errors.verify[0] }}</p>
                <p v-if="errors.fail_verify" class="m-0">{{ errors.fail_verify[0] }}</p>
            </div>
            <div class="alert alert-success" v-if="success.verified">
                <p class="m-0">{{ success.verified[0] }}</p>
            </div>
            <form @submit.prevent="login" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" v-model="email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" aria-describedby="error" placeholder="Password" v-model="password">
                    <span class="help-block text-danger" v-if="has_error && errors.login">{{ errors.login[0] }}</span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-primary" v-on:click="$router.push({name: 'recovery'})">Forgot my password</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                email: null,
                password: null,
                errors: {},
                success: {},
                has_error: false,
                has_success: false,
            }
        },    mounted() {
            this.verify()
        },    methods: {
            login() {
                // get the redirect object
                let redirect = this.$auth.redirect();
                let app = this;
                this.$auth.login({
                    params: {
                        email: app.email,
                        password: app.password
                    },
                    success: function () {
                        // handle redirection
                        const redirectTo = redirect ? redirect.from.name : this.$auth.user().role === 2 ? 'admin.dashboard' : 'dashboard';
                        this.$router.push({name: redirectTo})
                    },
                    error: function (res) {
                        app.has_error = true;
                        app.has_success = false;
                        app.errors = res.response.data.errors;
                    },
                    rememberMe: true,
                    fetchUser: true
                })
            },
            verify() {
                let app = this;
                let verification_code = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
                if (verification_code !== 'login') {
                    this.$http({
                        url: 'auth/verify/' + verification_code,
                        method: 'GET',
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
    }
</script>

<style scoped>
</style>
