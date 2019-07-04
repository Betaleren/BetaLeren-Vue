<template>
    <div>
        <div class="row m-0">
            <div class="m-auto col-sm-12 col-md-6 col-lg-6 col-xl-4 login-card">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" v-model="email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" aria-describedby="error" placeholder="Password" v-model="password">
                                <small id="error" class="form-text text-danger" v-if="error">Uw email of wachtwoord is onjuist</small>
                            </div>
                            <button type="submit" class="btn btn-primary" @click="loggedin">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
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
        methods: {
            loggedin(e){
                if(this.password.length > 0){
                    let email = this.email;
                    let password = this.password;
                    axios.post('api/login', {email, password}).then(response => {
                        let user = response.data.user;
                        let user_ID = user.id;
                        localStorage.setItem('beta.user', JSON.stringify(user));
                        localStorage.setItem('beta.jwt', response.data.token);
                        localStorage.setItem('beta.user_id', user_ID);
                        this.$root.$emit('myEvent', true);
                        this.$router.push('/')
                    });
                }
            }
        }
    }
</script>

<style scoped>
</style>