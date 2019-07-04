<template>
    <div class="row justify-content-center">
        <div class="p-1" style="min-width: 210px; max-width: 210px;" v-for="test in tests" :key="test.id">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <div class="">
                            <img src="" alt="">
                        </div>
                        <div class="">
                            lol
                        </div>
                        <div class="">
                            lol
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown-divider border-dark" style="width: calc(100% + .5rem)"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Dashboard",
        data(){
            return {
                tests: [
                    {id: '1'},
                    {id: '2'},
                    {id: '3'},
                    {id: '4'},
                    {id: '5'},
                    {id: '6'},
                    {id: '7'},
                    {id: '8'},
                    {id: '9'},
                    {id: '10'},
                    {id: '11'},
                ],
            }
        }
    }
</script>

<style scoped>

</style>
