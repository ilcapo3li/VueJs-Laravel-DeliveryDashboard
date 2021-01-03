<template>
  <!-- <vue-flip active-click="" width="200px" height="50px">
          <template v-slot:front class="front">
            front
          </template>
          <template v-slot:back class="back">
            back
          </template>
        </vue-flip> -->
      <div class="demo">
    <image-shadow :width="280" :src="this.src1" shadow-hover></image-shadow>
    <image-shadow :width="280" :src="this.src2" shadow-hover></image-shadow>
    <image-shadow :width="280" :shadow-radius="20" :src="this.src3" shadow-hover></image-shadow>
  </div>

<!-- <vue-flip active-click></vue-flip>
<vue-flip active-hover></vue-flip>
<vue-flip v-model="flipped"></vue-flip> -->

  <!-- <flipbook class="flipbook" :pages="['array', 'of', 'image', 'URLs']"></flipbook> -->

</template>
<script>
import VueFlip from 'vue-flip';
import Flipbook from 'flipbook-vue'
import ImageShadow from 'vue-image-shadow'


export default {
  components: {
     VueFlip,
     Flipbook,
     ImageShadow
  },
  data() {
    return {
      src1: 'https://github.com/image-component/gallery/blob/main/girl/4.jpg?raw=true',
      src2: 'https://github.com/image-component/gallery/blob/main/girl/6.jpg?raw=true',
      src3: 'https://github.com/image-component/gallery/blob/main/girl/8.png?raw=true'
    }
  }
}
</script>
<style>
.flipbook .viewport {
  width: 90vw;
  height: 90vh;
}
</style>