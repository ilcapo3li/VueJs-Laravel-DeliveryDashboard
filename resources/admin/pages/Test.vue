<template> 
  <b-container>
    
      <!-- <flipbook class="flipbook" :pages="this.pages" :singlePage="true"></flipbook> -->
    <!-- <b-col md="3" class="py-3"></b-col>
      <b-col md="3" class="py-3"></b-col> -->
      <b-row>
      <b-col cols="11" md="6">
        <b-card no-body img-top>
          <b-img-lazy  :src="src1" alt="Admin image"/>
          <b-card-body>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas viverra nunc sapien,
            non rhoncus elit tincidunt vitae.
          </b-card-body>
        </b-card>
      </b-col>
      <!-- <b-col cols="12" md="6">
        <b-card no-body img-bottom>
          <b-card-body>
            Vestibulum maximus, ligula eu feugiat molestie, massa diam imperdiet odio, vitae viverra
            ligula est id nisi. Aliquam ut molestie est.
          </b-card-body>
            <b-img-lazy  :src="src2" alt="Admin image"/>
        </b-card>
      </b-col> -->
  </b-row>
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
                          <vue-flip active-hover width="400px" height="200px" transition="1.5s">
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
                          <vue-flip active-hover width="400px" height="200px" transition="1.5s">
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
        <div class="row">
           <div class=" col-md-5">
                <div class="card card-stats" @click="TayarLogin()">
                  <div class="card-body">
                         <div class="col-12">
                          <vue-flip active-hover width="400px" height="200px" transition="1.5s">
                              <template v-slot:front class="front">
                                <image-shadow :width="400" :src="src1"></image-shadow>
                              </template>
                              <template v-slot:back class="back">
                                  <image-shadow :width="400" :src="src2"></image-shadow>
                              </template>
                            </vue-flip> 
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
                        <vue-flip active-hover width="400px" height="200px" transition="1.5s">
                            <template v-slot:front class="front">
                              <image-shadow :width="400" :src="src1"></image-shadow>
                            </template>
                            <template v-slot:back class="back">
                                <image-shadow :width="400" :src="src2"></image-shadow>
                            </template>
                        </vue-flip> 
                      </div>
                  </div>
                  <div class="card-footer text-left"><hr><div class="stats"><div><i class="tim-icons icon-sound-wave"></i>Lead Login</div></div></div></div>
            </div>
        </div>
  </b-container>
</template>
<script>
import ImageShadow from 'vue-image-shadow'
import VueFlip from 'vue-flip';
import Flipbook from 'flipbook-vue';
export default {
    name:'HomeLinks',
    components: {
     VueFlip,
     Flipbook,
     ImageShadow,
    },
    data(){
      return {
          src1: 'https://github.com/image-component/gallery/blob/main/girl/4.jpg?raw=true',
          src2: 'https://github.com/image-component/gallery/blob/main/girl/6.jpg?raw=true',
          src3: 'https://github.com/image-component/gallery/blob/main/girl/8.png?raw=true',
          // pages:[
          //       'https://github.com/image-component/gallery/blob/main/girl/4.jpg?raw=true',
          //       'https://github.com/image-component/gallery/blob/main/girl/6.jpg?raw=true',
          //       'https://github.com/image-component/gallery/blob/main/girl/8.png?raw=true',
          //       'https://github.com/image-component/gallery/blob/main/girl/4.jpg?raw=true',
          //       'https://github.com/image-component/gallery/blob/main/girl/6.jpg?raw=true',
          //       'https://github.com/image-component/gallery/blob/main/girl/8.png?raw=true',
          //       'https://github.com/image-component/gallery/blob/main/girl/4.jpg?raw=true',
          //       'https://github.com/image-component/gallery/blob/main/girl/6.jpg?raw=true',
          //       'https://github.com/image-component/gallery/blob/main/girl/8.png?raw=true',
          // ],
           
      }
    },
    methods:{
        CompanyLogin(){
          this.$router.push('/company/login');
        },
        TayarLogin(){
          this.$router.push('/tayar/login');
        },
        AgentLogin(){
          this.$router.push('/agent/login');
        },
        LeadLogin(){
          this.$router.push('/lead/login');
        },
      
    },
    
}
</script>
<style>

.flipbook {
  width: 90vw;
  height: 90vh;
  
}
</style>