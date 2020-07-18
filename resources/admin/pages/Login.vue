<template>
      <b-container>

      <b-col md="3" class="py-3"></b-col>
      <b-col md="3" class="py-3"></b-col>
      

          <b-card
            
          >
          <b-form>
              <b-form-group
                id="input-group-1"
                :label="$t('email')"
                :class="isRTL?'text-right':'text-left'"
                label-for="input-1"
              >
                <b-form-input
                  id="input-1"
                  v-model="email"
                  type="email"
                  required
                  :placeholder="$t('email')"
                  :class="isRTL?'text-right':'text-left'"
                ></b-form-input>
              </b-form-group>

              <b-form-group id="input-group-2" :class="isRTL?'text-right':'text-left'" :label="$t('password')" label-for="input-2">
                <b-form-input
                  id="input-2"
                  v-model="password"
                  type="password"
                  required
                  :placeholder="$t('password')"
                  :class="isRTL?'text-right':'text-left'"
                ></b-form-input>
           </b-form-group>

           <b-button type="button" variant="primary" @click="LoginForm()">Submit</b-button>
         </b-form>
      </b-card>

  </b-container>
</template>
<script>
import apiUrls from '../helpers/apiUrls';
    export default {
        name:'Login',
        data(){
          return {
             email:null,
             password:null
          }
        },
        created() {
         if(localStorage.getItem('access_token')){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token');
            axios.post(apiUrls.checkAuth()).then((res)=>{ 
               this.$router.push('/profile')
            })
        }
        },
        methods:{
            LoginForm(){
              axios.post(apiUrls.login(),{
                email:this.email,
                password:this.password,
                token:'pc'
              })
              .then((response)=>{
                if(response.data){
                  this.$store.commit('userUpdate',response.data.user.data);
                  this.$store.commit('authenticatedValue',true);
                  localStorage.setItem('access_token',response.data.access_token);
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
div.card{
  margin-top: 50px !important;
}
</style>