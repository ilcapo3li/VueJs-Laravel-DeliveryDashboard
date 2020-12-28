<template>
  <div>
    <div v-if="authenticated">
      <div>
        <notifications></notifications>
        <router-view :key="$route.fullPath"></router-view>
      </div>
    </div>
    <div v-else-if="$route.name === 'home-login'">
              <HomeLogin></HomeLogin>
    </div>
    <div v-else-if="$route.name === 'company-login'">
              <CompanyLogin></CompanyLogin>
    </div>
    <div v-else-if="$route.name === 'agent-login'">
              <AgentLogin></AgentLogin>
    </div>
    <div v-else-if="$route.name === 'tayar-login'">
              <TayarLogin></TayarLogin>
    </div>
    <div v-else-if="$route.name === 'lead-login'">
              <LeadLogin></LeadLogin>
    </div>
    <div v-else-if="$route.name === 'super-login'">
              <Login></Login>
    </div>
    <div v-else>
        <NotFoundPage></NotFoundPage>
    </div>
  </div>
</template>

<script>
import Login from "./pages/Login/Login";
import HomeLogin from "./pages/Login/HomeLogin";
import CompanyLogin from "./pages/Login/CompanyLogin";
import AgentLogin from "./pages/Login/AgentLogin";
import LeadLogin from "./pages/Login/LeadLogin";
import TayarLogin from "./pages/Login/TayarLogin";
import NotFoundPage from "./pages/NotFoundPage";
import apiUrls from './helpers/apiUrls';
  export default {
    name:'App',
    components:{
                Login,
                HomeLogin,
                CompanyLogin,
                AgentLogin,
                TayarLogin,
                LeadLogin,
                NotFoundPage,
    },
    created(){
      if(localStorage.getItem('access_token')){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token');
            axios.post(apiUrls.checkAuth()).then((res)=>{ 

            })
          .catch(error=>{
            toastr.error('Your Session Expired Please Login Again');
            this.resetAuth();
          })
            this.$store.commit('authenticatedValue',true);
      }
      else{
          this.resetAuth();
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
      },
      resetAuth(){
          this.$store.commit('authenticatedValue',false);
          this.$store.commit('userUpdate',null);
          localStorage.removeItem('access_token')
          delete axios.defaults.headers.common["Authorization"];
          this.$router.push('/home/login');
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
    color: rgb(255, 255, 255) !important;
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
      color: #00c3da !important;
      margin-bottom: 10px !important;
      font-weight: 700 !important;
  }
  .white-content .form-control:focus {
      border-color: #00c3da !important;
  }
  .main-panel { 
    border-top: 3px solid #306bf6 !important;
  }
  a{
      
      font-weight: 700 !important;
  }
  .white-content .navbar.navbar-transparent .navbar-brand {
        color: #00c3da !important;
  }
  .card-user .author .block.block-one {
        background: linear-gradient(to right, rgb(0, 238, 197) 0%, rgba(225, 78, 202, 0) 100%) !important;
  }
  .card-user .author .block.block-two {
        background: linear-gradient(to right, rgb(0, 238, 197) 0%, rgba(225, 78, 202, 0) 100%) !important;
  }
  .card-user .author .block.block-three {
        background: linear-gradient(to right, rgb(0, 238, 197) 0%, rgba(225, 78, 202, 0) 100%) !important;
  }
  .card-user .author .block.block-four {
        background: linear-gradient(to right, rgb(0, 238, 197) 0%, rgba(225, 78, 202, 0) 100%) !important;
  }
  textarea.form-control {
      max-height: 500px !important;
      padding: 10px 10px 10px 10px !important;
      resize: auto !important;
      border-bottom: 1.2px solid !important; 
      line-height: 1.3 !important;
  }
  .page-item.active .page-link {
  
      background-color: #25cbdf    !important;
      border-color: #25cbdf    !important;
  }
  .table .thead-light th {
      background-color: #25cbdf !important;
      border-color: #25cbdf !important;
  }
  a {
      color: #13c7dd !important;
  }
  hr {
      border-top: 2.2px solid rgb(245, 246, 250) !important;
      margin-top: 1rem !important;
      margin-bottom: 1rem !important;
      font-weight: bold !important;
  }
  .main-panel[data=green] {
      border-top: 2px solid #00f2c3 !important;
  }
  .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link
  {
      color: #13c7dd !important;
      background-color: #c1c1c1 !important;
      border-color: #e3e3e3 #e3e3e3 #1e1e2f !important;

  }
  /* .card{
    background-image:url('/img/img.jpg')  !important;
    background-position: fixed !important;

  } */
</style>

