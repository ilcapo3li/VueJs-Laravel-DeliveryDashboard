<template> 
<div class="homeLinkImage">
  <b-container>
  <div class="row">
              <div class=" col-md-5">
                  <div class="card card-stats">
                      <div class="card-body">          
                          <div class="col-12">
                            <vue-flip active-hover width="100%" height="150px" transition="1s">
                                <template v-slot:front class="front">
                                  <image-shadow width="100%" :src="company1"></image-shadow>
                                </template>
                                <template v-slot:back class="back">
                                    <image-shadow width="100%" :src="company2"></image-shadow>
                                </template>
                            </vue-flip> 
                          </div>
                      </div>
                  <div class="card-footer text-left"><hr></div><b-button class="tim-icons icon-delivery-fast" type="button" variant="success" @click="CompanyLogin()"> {{$t('companyLogin')}}</b-button></div>
              </div>
              <div class=" col-md-2">
              </div>
              <div class=" col-md-5">
                  <div class="card card-stats">
                    <div class="card-body">
                          <div class="col-12">
                            <vue-flip active-hover width="100%" height="150px" transition="1.5s">
                                <template v-slot:front class="front">
                                  <image-shadow  width="100%" :src="seller1"></image-shadow>
                                </template>
                                <template v-slot:back class="back">
                                    <image-shadow width="100%" :src="seller2"></image-shadow>
                                </template>
                              </vue-flip> 
                          </div>
                      </div>
                    <div class="card-footer text-left"><hr></div><b-button class="tim-icons icon-cart" type="button" variant="primary" @click="AgentLogin()"> {{$t('agentLogin')}}</b-button></div>
              </div>
          </div>
        
          <br>
          <br>
          <div class="row">
            <div class=" col-md-5">
                  <div class="card card-stats">
                    <div class="card-body">
                          <div class="col-12">
                            <vue-flip active-hover width="100%" height="150px" transition="1.5s">
                                <template v-slot:front class="front">
                                  <image-shadow width="100%" :src="tayar1"></image-shadow>
                                </template>
                                <template v-slot:back class="back">
                                    <image-shadow width="100%" :src="tayar2"></image-shadow>
                                </template>
                              </vue-flip> 
                          </div>
                      </div>
                      <div class="card-footer text-left"><hr></div><b-button class="tim-icons icon-spaceship"  type="button" variant="warning" @click="TayarLogin()"> {{$t('tayarLogin')}}</b-button></div>
              </div>
              <div class=" col-md-2">
              </div>
              <div class=" col-md-5">
                  <div class="card card-stats" >
                    <div class="card-body">
                        <div class="col-12">
                          <vue-flip active-hover width="100%" height="150px" transition="1.5s">
                              <template v-slot:front class="front">
                                <image-shadow width="100%"  :src="customer1"></image-shadow>
                              </template>
                              <template v-slot:back class="back">
                                  <image-shadow width="100%" :src="customer2"></image-shadow>
                              </template>
                          </vue-flip> 
                        </div>
                    </div>
                    <div class="card-footer text-left"><hr></div><b-button class="tim-icons icon-satisfied"  type="button" variant="default" @click="LeadLogin()"> {{$t('customerLogin')}}</b-button></div>
              </div>
          </div>
    </b-container>
  </div>
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
          seller1: '/img/onlineSellers.jpg',
          seller2: '/img/stores.jfif',
          company1: '/img/logoShip.png',
          company2: '/img/truck.jfif',
          customer1: '/img/NewCustomers.jpg',
          customer2: '/img/keep-customers.jpg',
          tayar1: '/img/bicycles1.jfif',
          tayar2: '/img/motorcy.jfif',
                  
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

.homeLinkImage{
  /* background-image: url("/img/representative.jfif") ; */
  background-repeat: no-repeat ;
  background-position: center;
  background-size: cover;
  position: relative;
}
</style>