<template>
<div>
  <div v-if="authenticated">
    <div>
      <notifications></notifications>
      <router-view :key="$route.fullPath"></router-view>
    </div>
  </div>
  <div v-if="$route.name=='iframe'">
    <router-view :key="$route.fullPath"></router-view>
  </div>
  <div v-if="$route.name=='iframe_channels'">
    <router-view :key="$route.fullPath"></router-view>
  </div>
  <div v-else>
    <Login></Login>
  </div>
</div>
</template>

<script>
import Login from "./pages/Login";
import apiUrls from './helpers/apiUrls';
  export default {
    name:'App',
    components:{Login},
    created(){
      if(localStorage.getItem('access_token')){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token');
            axios.post(apiUrls.checkAuth()).then((res)=>{ 

            })
          .catch(error=>{
            toastr.error('Your Session Expired Please Login Again');
            this.$store.commit('authenticatedValue',false);
            this.$store.commit('userUpdate',null);
            localStorage.removeItem('access_token')
            delete axios.defaults.headers.common["Authorization"];
            //  this.$router.push('/login')
          })
            this.$store.commit('authenticatedValue',true);
        }
        else{
            this.$store.commit('authenticatedValue',false);
            this.$store.commit('userUpdate',null);
            localStorage.removeItem('access_token')
            delete axios.defaults.headers.common["Authorization"];
            //  this.$router.push('/login')
          }
          
        if(localStorage.getItem('lang')=="ar"){
            this.$i18n.locale = 'ar';
            this.$rtl.enableRTL();
            localStorage.setItem('lang','ar')
        }
        else {
            this.$i18n.locale = 'en';
            this.$rtl.disableRTL();
            localStorage.setItem('lang','en')
        }
 },
    methods: {
      disableRTL() {
        if (!this.$rtl.isRTL) {
          this.$rtl.disableRTL();
        }
      },
      toggleNavOpen() {
        let root = document.getElementsByTagName('html')[0];
        root.classList.toggle('nav-open');
      }
    },

    mounted() {
      this.$watch('$route', this.disableRTL, { immediate: true });
      this.$watch('$sidebar.showSidebar', this.toggleNavOpen)
    },
    computed:{
      authenticated(){
        return this.$store.getters.authenticated;
      }
    }
  };
</script>
<style>
.custom-select{
  color: rgb(0, 0, 0) !important;
  font-size: 0.80rem !important;
  font-weight: 600 !important;
}
.sidebar .nav li > a, off-canvas-sidebar .nav li > a{
      font-size: 0.80rem !important;
      font-weight: 600 !important;
}
.card label {
    font-size: 0.80rem !important;
    font-weight: 600 !important;
}
.form-control {
    font-weight: 600 !important;
}
.card .card-header .card-category {
    color: #325ff4 !important;
    margin-bottom: 10px !important;
    font-weight: 700 !important;
}
.white-content .form-control:focus {
    border-color: #2a77f6 !important;
}
.main-panel { 
  border-top: 3px solid #306bf6 !important;
}
a{
    
    font-weight: 700 !important;
}
.white-content .navbar.navbar-transparent .navbar-brand {
    color: #287ff7 !important;
}
.card-user .author .block.block-one {
    background: linear-gradient(to right, rgb(47, 111, 246) 0%, rgba(225, 78, 202, 0) 100%) !important;
  }
  .card-user .author .block.block-two {
    background: linear-gradient(to right, rgb(47, 111, 246) 0%, rgba(225, 78, 202, 0) 100%) !important;
  }
  .card-user .author .block.block-three {
    background: linear-gradient(to right, rgb(47, 111, 246) 0%, rgba(225, 78, 202, 0) 100%) !important;
  }
  .card-user .author .block.block-four {
    background: linear-gradient(to right, rgb(47, 111, 246) 0%, rgba(225, 78, 202, 0) 100%) !important;
  }
  textarea.form-control {
    max-height: 500px !important;
    padding: 10px 10px 10px 10px !important;
    resize: auto !important;
    border-bottom: 1.2px solid !important; 
    line-height: 1.3 !important;
    /* background-color: #f5f6fa !important; */
}
/*.card{
  background-image:url('/default/default.png') !important;
}*/
</style>

