<template>
    <card>
        <form>
            <base-input :label="$t('stadium')"
                        v-model="stadium"
                       :class="isRTL?'text-right':'text-left'"
                        v-validate="'required'"
                        name="stadium"
                        type="text"
                        :placeholder="$t('stadium')">
            </base-input>
            <div :style="{'text-align':isRTL?'right':'left'}">
             <span v-show="errors.has('stadium')" class="error">*{{ errors.first('stadium') }}</span>  
            </div> 
          <b-button class="btn btn-primary" @click="saveStadium()">Save</b-button>

        </form>
    </card>
</template>
<script>
import apiUrls from '../../helpers/apiUrls';

export default{
    name:'CommentatorAdd',
    mounted(){
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
            stadium:null
        }
    },
    methods:{
        saveStadium(){
            this.$validator.validateAll().then((result) => {
            if(result){
                axios.post(apiUrls.saveStadium(),{name:this.stadium})
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
            })
        }
    },
    computed:{
        isRTL() {
           return this.$rtl.isRTL;
        },
    }
}
</script>     
<style>
span.error{
    color:red
}
</style>