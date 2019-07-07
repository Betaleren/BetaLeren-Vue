<template>
    <div class="card w-sm-400 mx-auto">
        <div class="card-header">
            <h3 class="m-0 text-center text-muted">Change Picture</h3>
        </div>
        <div class="card-body">
            <form @submit.prevent="submit" method="post">
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="customFile" accept="image/*">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Profile-Picture"
    }
</script>

<style scoped>

</style>
