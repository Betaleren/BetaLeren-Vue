<template>
    <div class="card w-sm-400 login-card">
        <div class="card-header">
            <h3 class="m-0 text-center text-muted">Register</h3>
        </div>
        <div class="card-body">
            <form @submit.prevent="register" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" v-model="email">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Firstname</label>
                    <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Enter firstname" v-model="firstname">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Lastname</label>
                    <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Enter lastname" v-model="lastname">
                </div>
                <div class="form-group">
                    <label >Password</label>
                    <input type="password" class="form-control"  placeholder="Enter password" v-model="password">
                </div>
                <div class="form-group">
                    <label >Confirm password</label>
                    <input type="password" class="form-control"  placeholder="Enter confirm password" v-model="cpassword">
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "register",
        data(){
            return{
                email: "",
                firstname: "",
                lastname: "",
                password: "",
                cpassword: "",
            }
        },
        methods: {
            register(e){
                e.preventDefault()
                if(this.password !== this.cpassword || this.password.length <= 0){
                    this.password = ""
                    this.cpassword = ""
                    return alert('password do not match')
                }
                let firstname = this.firstname,
                    lastname = this.lastnamel,
                    email = this.email,
                    password = this.password,
                    c_password = this.cpassword;
                axios.post('api/register', {firstname, lastname,  email, password, c_password}).then(response =>{
                    this.$router.push('/login')
                })
            }
        },
        }
</script>

<style scoped>

</style>
