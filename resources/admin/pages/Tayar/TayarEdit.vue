<template>
    <b-row>
      <b-col md="12" class="my-1"> 
        <card>
            <form>
                <base-input :label="$t('admin_name')"
                            :class="isRTL?'text-right':'text-left'"
                            v-model="admin.name"
                            name="admin_name"
                            v-validate="'required'"
                            :placeholder="$t('admin_name')">
                </base-input>
                <div :style="{'text-align':isRTL?'right':'left'}">
                  <span  v-show="errors.has('admin_name')" class="error">*{{ errors.first('admin_name') }}</span>  
                </div>
                <base-input :label="$t('admin_email')"
                            :class="isRTL?'text-right':'text-left'" 
                            v-model="admin.email"
                            name="email"
                            v-validate="'required|email'"
                            :placeholder="$t('admin_email')">
                </base-input>
                <div :style="{'text-align':isRTL?'right':'left'}">
                 <span  v-show="errors.has('email')" class="error">*{{ errors.first('email') }}</span>  
                </div>
                <base-input :label="$t('admin_password')"
                            :class="isRTL?'text-right':'text-left'"
                            type="password"
                            v-model="admin.password"
                            ref="password"
                            name="password"
                            v-validate="'required'"
                            :placeholder="$t('admin_password')">
                </base-input>
                <div :style="{'text-align':isRTL?'right':'left'}">
                  <span  v-show="errors.has('password')" class="error">*{{ errors.first('password') }}</span>  
                </div>
              <base-input :label="$t('confirm_password')"
                            :class="isRTL?'text-right':'text-left'"
                            type="password"
                            v-model="admin.password_confirmation"
                            name="confirm_password"
                            v-validate="'required|confirmed:password'"
                            :placeholder="$t('confirm_password')">
              </base-input>
              <div :style="{'text-align':isRTL?'right':'left'}">
                <span v-show="errors.has('confirm_password')" class="error">*{{ errors.first('confirm_password') }}</span>  
              </div>

                <b-button class="btn btn-primary" @click="updateAdmin">Save</b-button>

            </form>
        </card>
      </b-col>
    </b-row>
</template>
<script>
import apiUrls from '../../helpers/apiUrls';

export default{
    name:'Admins',
    beforeMount(){
      if(this.$route.params.admin){
        this.admin=this.$route.params.admin;
      }
      else if(localStorage.getItem('admin')){
        this.admin=JSON.parse(localStorage.getItem('admin'));   
      }
      else{
        this.$router.go(-1);
      }
    },
    mounted(){
      const dict = {
      custom: {
        admin_name: {
          required: this.$t('validation.admin_name')
        },
        email: {
          required: this.$t('validation.email')
        },
        password:{
         required: this.$t('validation.password')
        },
        confirm_password:{
         required: this.$t('validation.confirm_password'),
         confirmed:this.$t('validation.confirm_password')
        }
      }
     };
    this.$validator.localize('en', dict);
    },
    components:{Permissions},
    data(){
        return{
            admin:{},
        }
    },
    computed:{
        isRTL() {
           return this.$rtl.isRTL;
        },
    },
    methods:{
       updateAdmin(){
          this.$validator.validateAll().then((result) => {
            if(result){
              axios.put(apiUrls.updateAdmin(this.admin),{
                'id':this.admin.id,
                'name':this.admin.name,
                'email':this.admin.email,
                'password':this.admin.password,
                'password_confirmation':this.admin.password_confirmation,
                'permissions':this.admin.permissions
              })
              .then((res)=>{
                  toastr.success(res.data);
                  this.$router.go(-1)
              })
              .catch((error)=>{
                  toastr.error(this.$t('validation.error_user'))
              }); 
            }
            else{
              return;
            }
          });

 
       },
       updatePermission(data){
         this.admin.permissions=data
       }

    }
}
</script>
<style>
span.error{
    color:red
}
</style>