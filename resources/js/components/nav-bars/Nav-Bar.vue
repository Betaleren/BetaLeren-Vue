<template>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top align-items-start justify-content-between">
        <div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <router-link to="/" class="nav-link">Home<span class="sr-only">(current)</span></router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link to="/course" class="nav-link">Course</router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link to="/" class="nav-link">Examination</router-link>
                    </li>
                </ul>
            </div>
        </div>
        <div v-if="$auth.check()">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <div class="nav-link dropdown-toggle active p-0" id="navbarDropdownMenuLink1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ $auth.user().first_name }} {{ $auth.user().last_name }}
                        <img :src="'/img/Profile/default-avatar.png'" class="ml-2 rounded-circle" alt="Picture" width="40px" height="40px">
                    </div>
                    <div class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdownMenuLink1">
                        <Sub-Nav></Sub-Nav>
                    </div>
                </li>
            </ul>
        </div>
        <div v-if="!$auth.check()">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <div class="nav-link dropdown-toggle active p-0" id="navbarDropdownMenuLink2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Login or Register
                        <img :src="'/img/Profile/default-avatar.png'" class="ml-2 rounded-circle" alt="Picture" width="40px" height="40px">
                    </div>
                    <div class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdownMenuLink2">
                        <Sub-Nav></Sub-Nav>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    import SubNav from './Sub-Nav';

    export default {
        name: "Nav-Bar",
        components: {
            SubNav,
        },
    }
</script>

<style scoped>

</style>
