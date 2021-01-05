export const LoginMixin =  
{
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
                axios.post(login(),{
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
        login(){
          return apiUrls.adminLogin();
        } 

    },
    computed:{
      isRTL() {
        return this.$rtl.isRTL;
      }
    }
}