<template>
            <Login></Login>
</template>
<script>
import Login from "./Login";
export default {
    name:'AgentLogin',
    components:{
        Login,
    },
    data(){
        return {
            email:null,
            password:null
        }
    },
    mounted() {
        if(localStorage.getItem('access_token')){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token');
            axios.post(apiUrls.checkAuth()).then((res)=>{ 
                this.$router.push('/profile')
            })
        }
    },
    computed:{
        isRTL() {
            return this.$rtl.isRTL;
        }
    }
}
</script>
<style>

</style>