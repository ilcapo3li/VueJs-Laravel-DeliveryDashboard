<template>
    <Login></Login>
</template>
<script>
    import Login from "./Login";
    import apiUrls from '../../helpers/apiUrls';

    export default {
        name:'AdminLogin',
        components:{
            Login,
        },
        methods:{
            login(){
                return apiUrls.AdminLogin();
            }
        },
    }
</script>
<style>

</style>