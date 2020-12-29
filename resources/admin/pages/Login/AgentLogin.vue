<template>
    <Login></Login>
</template>
<script>
    import Login from "./Login";
    import apiUrls from '../../helpers/apiUrls';

    export default {
        name:'AgentLogin',
        components:{
            Login,
        },
        // mounted(){
        //   this.url();
        //   alert(this.url());
        //   console.log(this.url());
        // },
        methods:{
            LoginForm(){
              this.$validator.validateAll().then(result => {
                if (result) {
                    axios.post(apiUrls.AgentLogin(),{
                      email:this.email,
                      password:this.password,
                    })
                    .then((response)=>{
                        if(response.status){
                          this.$store.commit('userUpdate',response.data.data.user);
                          this.$store.commit('authenticatedValue',true);
                          localStorage.setItem('access_token',response.data.data.access_token);
                          if(localStorage.getItem('lang')==null){
                            localStorage.setItem('lang','en');
                            this.$i18n.locale = 'en';
                            this.$rtl.disableRTL();
                          }
                          else{
                            var lang=localStorage.getItem('lang');
                            if(lang=="ar"){
                              this.$i18n.locale = 'ar';
                              this.$rtl.enableRTL();
                            }
                            else{
                              this.$i18n.locale = 'en';
                              this.$rtl.disableRTL();
                            }
                          }
                          axios.defaults.headers.common['Authorization'] =  'Bearer ' + localStorage.getItem('access_token');                               
                          this.$router.push('/profile');
                        }
                    }).catch((error)=>{
                        if(error.response.status==401){
                          toastr.error('Unauthorized check your email or password')
                        }
                    });
                } else {
                  return;
                }
              });
            },
        }
    }
</script>
<style>

</style>