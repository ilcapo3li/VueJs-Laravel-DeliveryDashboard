<template>
    <card>
        <form>
            <base-input :label="$t('stadium')"
                        :class="isRTL?'text-right':'text-left'"
                        :placeholder="$t('stadium')"
                        v-model="stadium.en_name"
                        v-validate="'required'"
                        name="stadium"
                        type="text"
            >
            </base-input>
            <div :style="{'text-align':isRTL?'right':'left'}">
              <span v-show="errors.has('stadium')" class="error">*{{ errors.first('stadium') }}</span>
            </div>
            <b-button class="btn btn-primary" @click="updateStadium()">Save</b-button>

        </form>
    </card>
</template>
<script>
import apiUrls from '../../helpers/apiUrls';

export default{
    name:'StadiumEdit',
    mounted(){
        if(this.$route.params.stadium){
         this.stadium=this.$route.params.stadium;
        }
        else if(localStorage.getItem('stadia')){
         this.stadium=JSON.parse(localStorage.getItem('stadia'));   
        }
        const dict = {
            custom: {
                stadium: {
                required: this.$t('validation.stadium')
                }

            }
        };
        this.$validator.localize('en', dict);
    },
    data(){
        return{
            stadium:{}
        }
    },
    computed:{
        isRTL() {
           return this.$rtl.isRTL;
        },
    },
    methods:{
        updateStadium(){
            this.$validator.validateAll().then((result) => {
            if(result){
                axios.put(apiUrls.updateStadium(this.stadium.id),{name:this.stadium.en_name})
                .then((response)=>{
                    this.$router.push('/stadia'); 
                })
                .catch(error=>{
                 $.each(error.response.data.error, function(key, value) {
               toastr.error(value);
             });     
                });
            }
            else{
                return;
            }
            });

        

        }
    }
}
</script>     
<style>
span.error{
    color:red
}
</style>