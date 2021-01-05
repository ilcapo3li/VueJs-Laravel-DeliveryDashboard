<template>
  <b-container>
    <b-col md="3" class="py-3"></b-col>
      <b-col md="3" class="py-3"></b-col>
        <div class="row">
            <div class=" col-md-5">
                <div class="card card-stats" @click="CompanyLogin()">
                    <div class="card-body">          
                        <!-- <div class="col-12">
                          <vue-flip  active-click="true" width="200px" height="200px">
                            <template v-slot:front class="front">
                              <image-shadow :width="400" :src="src2" ></image-shadow>
                            </template>
                            <template v-slot:back class="back">                             
                              <image-shadow :width="400" :src="src1" ></image-shadow>                            
                            </template>
                          </vue-flip>
                        </div> -->
                        <div class="col-12">
                          <vue-flip active-hover width="400px" height="200px">
                              <template v-slot:front class="front">
                                <image-shadow :width="400" :src="src1"></image-shadow>
                              </template>
                              <template v-slot:back class="back">
                                  <image-shadow :width="400" :src="src2"></image-shadow>
                              </template>
                            </vue-flip> 
                        </div>
                    </div>
                <div class="card-footer text-left"><hr><div class="stats"><div><i class="tim-icons icon-sound-wave"></i>Company Login</div></div></div></div>
            </div>
            <div class=" col-md-2">
            </div>
             <div class=" col-md-5">
                <div class="card card-stats" @click="AgentLogin()">
                  <div class="card-body">
                        <div class="col-12">
                          <vue-flip active-hover width="400px" height="200px">
                              <template v-slot:front class="front">
                                <image-shadow :width="400" :src="src2"></image-shadow>
                              </template>
                              <template v-slot:back class="back">
                                  <image-shadow :width="400" :src="src3"></image-shadow>
                              </template>
                            </vue-flip> 
                        </div>
                    </div>
                  <div class="card-footer text-left"><hr><div class="stats"><div><i class="tim-icons icon-sound-wave"></i>Agent Login</div></div></div></div>
            </div>
        </div>
       
        <br>
        <br>
        <!-- <div class="row">
           <div class=" col-md-5">
                <div class="card card-stats" @click="TayarLogin()">
                  <div class="card-body">
                        <div class="col-12">
                              <image-shadow :width="400" :shadow-radius="20" :src="this.src3" shadow-hover></image-shadow>
                        </div>
                    </div>
                    <div class="card-footer text-left"><hr><div class="stats"><div><i class="tim-icons icon-sound-wave"></i>Tayar Login</div></div></div></div>
            </div>
            <div class=" col-md-2">
            </div>
             <div class=" col-md-5">
                <div class="card card-stats" @click="LeadLogin()">
                  <div class="card-body">
                        <div class="col-12">
                              <image-shadow :width="400" :shadow-radius="20" :src="this.src1" shadow-hover></image-shadow>
                        </div>
                    </div>
                  <div class="card-footer text-left"><hr><div class="stats"><div><i class="tim-icons icon-sound-wave"></i>Lead Login</div></div></div></div>
            </div>
        </div> -->
  </b-container>
</template>
<script>
import ImageShadow from 'vue-image-shadow'
import VueFlip from 'vue-flip';
import Flipbook from 'flipbook-vue';
export default {
    name:'HomeLogin',
    components: {
     VueFlip,
     Flipbook,
     ImageShadow
    },
    data(){
      return {
          src1: 'https://github.com/image-component/gallery/blob/main/girl/4.jpg?raw=true',
          src2: 'https://github.com/image-component/gallery/blob/main/girl/6.jpg?raw=true',
          src3: 'https://github.com/image-component/gallery/blob/main/girl/8.png?raw=true',
      }
    },
    methods:{
        CompanyLogin(){
          // this.$router.push('/company/login');
        },
        TayarLogin(){
          this.$router.push('/tayar/login');
        },
        AgentLogin(){
          // this.$router.push('/agent/login');
        },
        LeadLogin(){
          this.$router.push('/lead/login');
        },
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