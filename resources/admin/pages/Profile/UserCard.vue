<template>
  <card type="user">
    <p class="card-text">
    </p>
    <div class="author">
      <div class="block block-one"></div>
      <div class="block block-two"></div>
      <div class="block block-three"></div>
      <div class="block block-four"></div>
      <a href="#">
        <b-img class="avatar" :src="user.photo ? user.photo : '/default/default.png'"/>
        <h5 class="title">{{user.name}}</h5>
      </a>
      <p class="description">
        {{user.email}}
      </p>
    </div>
    <div slot="footer" class="button-container">
      <base-button icon round class="btn-facebook">
        <i class="fab fa-facebook"></i>
      </base-button>
      <base-button icon round class="btn-twitter">
        <i class="fab fa-twitter"></i>
      </base-button>
      <base-button icon round class="btn-google">
        <i class="fab fa-google-plus"></i>
      </base-button>
    </div>
  </card>
</template>
<script>
  export default {
   computed:{
     user(){
       return this.$store.getters.user;
     }
   }
  }
</script>

