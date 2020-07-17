<template>
  <nav class="navbar navbar-expand-lg navbar-absolute"
       :class="{'bg-white': showMenu, 'navbar-transparent': !showMenu}">
    <div class="container-fluid">
      <div class="navbar-wrapper">
        <div class="navbar-toggle d-inline" :class="{toggled: $sidebar.showSidebar}">
          <button type="button"
                  class="navbar-toggler"
                  aria-label="Navbar toggle button"
                  @click="toggleSidebar">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
          </button>
        </div>
        <a class="navbar-brand" href="#">{{routeName}}</a>
      </div>
      <button class="navbar-toggler" type="button"
              @click="toggleMenu"
              data-toggle="collapse"
              data-target="#navigation"
              aria-controls="navigation-index"
              aria-label="Toggle navigation">
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
      </button>

      <collapse-transition>
        <div class="collapse navbar-collapse show" v-show="showMenu">
          <ul class="navbar-nav" :class="$rtl.isRTL ? 'mr-auto' : 'ml-auto'">
            <base-dropdown tag="li"
                           :menu-on-right="!$rtl.isRTL"
                           title-tag="a"
                           class="nav-item"
                           menu-classes="dropdown-navbar">
              <a slot="title" href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="true">
                <div class="photo">
                  <img src="/img/anime3.png">
                </div>
                <b class="caret d-none d-lg-block d-xl-block"></b>
                <p class="d-lg-none">
                  Log out
                </p>
              </a>
              <li class="nav-link">
                <router-link class="nav-item dropdown-item" to="/profile">Profile</router-link>
              </li>
              <li class="nav-link">
                <a href="#" class="nav-item dropdown-item" @click="changeLocale">{{language}}</a>
              </li>
              <div class="dropdown-divider"></div>
              <li class="nav-link">
                <a href="#" class="nav-item dropdown-item" @click="logout">Log out</a>
              </li>
            </base-dropdown>
          </ul>
        </div>
      </collapse-transition>
    </div>
  </nav>
</template>
<script>
  import { CollapseTransition } from 'vue2-transitions';
  import Modal from '@/components/Modal';
import apiUrls from '../../helpers/apiUrls';

  export default {
    components: {
      CollapseTransition,
      Modal
    },
    computed: {
      routeName() {
      return this.$t(this.$route.name);
      },
      isRTL() {
        return this.$rtl.isRTL;
      }
    },
    mounted(){
      if(localStorage.getItem('lang')=="ar"){
         this.language="English"
        }
      else {
        this.language="اللغه العربية"
 
      }
    },
    data() {
      return {
        activeNotifications: false,
        showMenu: false,
        language:null //language to  convert
      };
    },
    methods: {
      capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
      },
      toggleNotificationDropDown() {
        this.activeNotifications = !this.activeNotifications;
      },
      closeDropDown() {
        this.activeNotifications = false;
      },
      toggleSidebar() {
        this.$sidebar.displaySidebar(!this.$sidebar.showSidebar);
      },
      hideSidebar() {
        this.$sidebar.displaySidebar(false);
      },
      toggleMenu() {
        this.showMenu = !this.showMenu;
      },
      logout(){
        axios.post(apiUrls.logout()).then(()=>{
           toastr.success('Logged out successfully');
            this.$store.commit('authenticatedValue',false);
            this.$store.commit('userUpdate',null);
            localStorage.removeItem('access_token')
            delete axios.defaults.headers.common["Authorization"];
           this.$router.push('/login')
        });
      },
      changeLocale(){
        if(this.isRTL){
          this.language="اللغة العربيه";
          this.$i18n.locale = 'en';
          this.$rtl.disableRTL();
          localStorage.setItem('lang','en');
          window.location.href=this.$router.currentRoute.fullPath
          
        }
        else{
          this.language="English"
          this.$i18n.locale = 'ar';
          this.$rtl.enableRTL();
          localStorage.setItem('lang','ar')
          window.location.href=this.$router.currentRoute.fullPath

        }
      }
    }
  };
</script>
<style>
</style>
