<template>
    <div class="card w-sm-400 mx-auto">
        <div class="card-header">
            <h3 class="m-0 text-center text-muted">Change Password</h3>
        </div>
        <div class="card-body">
            <form @submit.prevent="submit" method="post">
                <div class="form-group">
                    <label for="exampleInputPassword1">Old Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Old Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2">New Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="New Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword3">Confirm Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword3" placeholder="Confirm Password">
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Change-Password"
    }
</script>

<style scoped>

</style>
