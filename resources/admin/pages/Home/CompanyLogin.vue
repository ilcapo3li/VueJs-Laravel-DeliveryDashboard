<template>
      <b-container>

      <b-col md="3" class="py-3"></b-col>
      <b-col md="3" class="py-3"></b-col>
      

      <b-card>
          <b-form>
            <b-row>
              <b-col md="12" class="my-1">
                <b-form-group
                  id="input-group-1"
                  :label="$t('email')"
                  :class="isRTL?'text-right':'text-left'"
                  label-for="email"
                >
                <b-form-input
                    id="email"
                    name="email"
                    v-model="email"                                                                 
                    type="email"
                    v-validate="'required|email'"
                    :placeholder="$t('email')">
                  </b-form-input>
                </b-form-group>
                <div>
                    <span v-show="errors.has('email')" class="error">*{{ errors.first('email') }}</span>
                </div>
              </b-col>
            </b-row>
              <br>
            <b-row>
             <b-col md="12" class="my-1">
                <b-form-group id="input-group-2" :class="isRTL?'text-right':'text-left'" :label="$t('password')" label-for="password">
                  <b-form-input
                    id="password"
                    name="password"
                    autocomplete="current-password"
                    v-model="password"
                    type="password"
                    v-validate="'required'"
                    :placeholder="$t('password')"
                    :class="isRTL?'text-right':'text-left'"
                  ></b-form-input>
                </b-form-group>
                <div>
                    <span v-show="errors.has('password')" class="error">*{{ errors.first('password') }}</span>
                </div>
              </b-col>
            </b-row>
              <br>
              <div class="text-center">
                  <b-button  type="button" variant="success" @click="LoginForm()">Submit</b-button>
              </div>
         </b-form>
      </b-card>

  </b-container>
</template>
<script>
  import apiUrls from '../../helpers/apiUrls';
  export default {
      name:'AgentLogin',
      data(){
        return {
            email:null,
            password:null
        }
      },
      created() {
        if(localStorage.getItem('access_token')){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token');
            axios.post(apiUrls.checkAuth()).then((res)=>{ this.$router.push('/profile')})
        }
      },
      mounted(){
        const dict = {
          custom: {
            email: {
              required: this.$t("validation.email")
            },
            password: {
              required: this.$t("validation.password")
            },
          }
        };
        this.$validator.localize("en", dict);
      },
      methods:{
          LoginForm(){
            this.$validator.validateAll().then(result => {
              if (result) {
                  axios.post(apiUrls.companyLogin(),{
                    email:this.email,
                    password:this.password,
                  })
                  .then((response)=>{
                      if(response.status){
                        this.$store.commit('userUpdate',response.data.data.user);
                        this.$store.commit('userTypeUpdate',response.data.data.user_type);
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