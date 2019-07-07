<template>
    <div class="card w-sm-400 login-card">
        <div class="card-header">
            <h3 class="m-0 text-center text-muted">Login</h3>
        </div>
        <div class="card-body">
            <form @submit.prevent="loggedin" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" v-model="email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" aria-describedby="error" placeholder="Password" v-model="password">
                    <small id="error" class="form-text text-danger" v-if="error">Uw email of wachtwoord is onjuist</small>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "Login",
        data(){
            return{
                email: '',
                password: '',
                error: false
            }
        },
        mounted(){
            let isLoggedIn = localStorage.getItem('beta.jwt') != null;
            if(isLoggedIn){
                this.$router.push('/')
            }
        },
        methods: {
            loggedin(e){
                if(this.password.length > 0){
                    let email = this.email;
                    let password = this.password;
                    axios.post('api/login', {email, password}).then(response => {
                        let user = response.data.user;
                        let user_firstname = user.firstname;
                        let user_lastname = user.lastname;
                        if(user.is_admin === 1){
                            localStorage.setItem('beta.admin', true);
                            this.$root.$emit('admindelete', true)
                        }else{
                            localStorage.setItem('beta.admin', false)
                        }
                        localStorage.setItem('beta.user', JSON.stringify(user));
                        localStorage.setItem('beta.jwt', response.data.token);
                        localStorage.setItem('beta.firstname', user_firstname);
                        localStorage.setItem('beta.lastname', user_lastname);
                        this.$root.$emit('myEvent', true);
                        this.$router.push('/')
                    });
                }else{
                    this.error = true
                }
            }
        }
    }
</script>

<style scoped>
</style>
