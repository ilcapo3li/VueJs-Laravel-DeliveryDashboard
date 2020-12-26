<template>
  <b-container>
    <b-col md="3" class="py-3"></b-col>
      <b-col md="3" class="py-3"></b-col>
        <div class="row">
            <div class=" col-md-5">
                <div class="card card-stats" @click="CompanyLogin()">
                    <div class="card-body">
                      <div class="row"><div class="col-5">
                        <div class="info-icon text-center icon-primary">
                          <i class="tim-icons icon-shape-star"></i>
                        </div>
                      </div>
                      <div class="col-7">
                        <div class="numbers"><p class="card-category">Followers</p><h3 class="card-title">+45K</h3></div>
                      </div>
                </div></div>
                <div class="card-footer text-left"><hr><div class="stats"><div><i class="tim-icons icon-sound-wave"></i>Company Login</div></div></div></div>
            </div>
            <div class=" col-md-2">
            </div>
             <div class=" col-md-5">
                <div class="card card-stats" @click="AgentLogin()"><!----><!----><div class="card-body"><div class="row"><div class="col-5"><div class="info-icon text-center icon-primary"><i class="tim-icons icon-shape-star"></i></div></div><div class="col-7"><div class="numbers"><p class="card-category">Followers</p><h3 class="card-title">+45K</h3></div></div></div></div><!----><div class="card-footer text-left"><hr><div class="stats"><div><i class="tim-icons icon-sound-wave"></i>Agent Login</div></div></div></div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="row">
           <div class=" col-md-5">
                <div class="card card-stats" @click="TayarLogin()"><!----><!----><div class="card-body"><div class="row"><div class="col-5"><div class="info-icon text-center icon-primary"><i class="tim-icons icon-shape-star"></i></div></div><div class="col-7"><div class="numbers"><p class="card-category">Followers</p><h3 class="card-title">+45K</h3></div></div></div></div><!----><div class="card-footer text-left"><hr><div class="stats"><div><i class="tim-icons icon-sound-wave"></i>Tayar Login</div></div></div></div>
            </div>
            <div class=" col-md-2">
            </div>
             <div class=" col-md-5">
                <div class="card card-stats" @click="LeadLogin()"><!----><!----><div class="card-body"><div class="row"><div class="col-5"><div class="info-icon text-center icon-primary"><i class="tim-icons icon-shape-star"></i></div></div><div class="col-7"><div class="numbers"><p class="card-category">Followers</p><h3 class="card-title">+45K</h3></div></div></div></div><!----><div class="card-footer text-left"><hr><div class="stats"><div><i class="tim-icons icon-sound-wave"></i>Lead Login</div></div></div></div>
            </div>
        </div>
  </b-container>
</template>
<script>
import apiUrls from '../../helpers/apiUrls';
    export default {
        name:'HomeLogin',
        data(){
          return {
            
          }
        },
        methods:{
            CompanyLogin(){
              alert("company");
              // this.$router.push('/profile');
            },
            TayarLogin(){
              alert("tayar");
              // this.$router.push('/profile');
            },
            AgentLogin(){
              alert("agent");
              // this.$router.push('/profile');
            },
            LeadLogin(){
              alert("lead");
              // this.$router.push('/profile');
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