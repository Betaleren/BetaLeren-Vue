<template>
    <div>
        <div class="row m-0">
            <div class="m-auto col-sm-12 col-md-6 col-lg-6 col-xl-4 login-card">
                <div class="card">
                    <div class="card-header">
                        <h3 class="m-0 text-center">Register</h3>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="" method="post">
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
                                <input type="password" class="form-control"  placeholder="Eneter password" v-model="password">
                            </div>
                            <div class="form-group">
                                <label >Conformation password</label>
                                <input type="password" class="form-control"  placeholder="Enter conformation password" v-model="cpassword">
                            </div>
                            <button type="submit" class="btn btn-primary" @click="register">Submit</button>
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
                let firstname = this.firstname
                let lastname = this.lastname
                let email = this.email
                let password = this.password
                let c_password = this.cpassword
                axios.post('api/register', {firstname, lastname,  email, password, c_password}).then(response =>{
                    this.$router.push('/login')
                })
            }
        },
        }
</script>

<style scoped>

</style>
