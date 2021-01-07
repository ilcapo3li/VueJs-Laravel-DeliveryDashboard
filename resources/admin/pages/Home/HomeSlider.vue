<template>
  <div>
      <b-carousel
      id="carousel-1"
      v-model="slide"
      :interval="2000"
      controls
      fade
      indicators
      background="#ababab"
      img-width="1024"
      img-height="480"
      style="text-shadow: 1px 1px 2px #333;"
      @sliding-start="onSlideStart"
      @sliding-end="onSlideEnd"
    >
     
      <!-- Slides with image only -->
      <b-carousel-slide img-src="/img/Cover.jpg" style="filter: grayscale(100%);"></b-carousel-slide>

    </b-carousel>
  </div>
</template>

<script>
export default {
    name:'HomeSlider',
    data(){
      return {
        
           slide: 0,
           sliding: null
      }
    },
    methods:{
      onSlideStart(slide) {
        this.sliding = true
      },
      onSlideEnd(slide) {
        this.sliding = false
      }
    },
    computed:{
      isRTL() {
        return this.$rtl.isRTL;
      }
    }
}
</script>
<style>


</style>