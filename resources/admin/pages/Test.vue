<template>
  <vue-flip :active-hover="true" width="200px" height="50px">
  <template v-slot:front>
    front
  </template>
  <template v-slot:back>
    back
  </template>
</vue-flip>

<!-- <vue-flip active-click></vue-flip>
<vue-flip active-hover></vue-flip>
<vue-flip v-model="flipped"></vue-flip> -->

  <!-- <flipbook class="flipbook" :pages="['array', 'of', 'image', 'URLs']"></flipbook> -->

</template>
<script>
import VueFlip from 'vue-flip';
import Flipbook from 'flipbook-vue'

export default {
  components: {
     VueFlip,
     Flipbook
  }
}
</script>
<style>
.flipbook .viewport {
  width: 90vw;
  height: 90vh;
}
</style>