<template>
    <Login></Login>
</template>
<script>
    import Login from "./Login";
    import {LoginMixin} from "./LoginMixin";
    import apiUrls from '../../helpers/apiUrls';

    export default {
        mixins: [LoginMixin],
        name:'TestLogin',
        components:{
            Login,
        },
        computed:{
            login(){
                return apiUrls.agentLogin();
            }
        },
    }
</script>
<style>

</style>