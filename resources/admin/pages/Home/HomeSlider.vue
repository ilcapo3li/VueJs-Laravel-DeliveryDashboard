<template>
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
      <b-carousel-slide img-src="/img/Cover.jpg"></b-carousel-slide>
      <b-carousel-slide img-src="/img/representative.jfif"></b-carousel-slide>

      <!-- Slides with img slot -->
      <!-- Note the classes .d-block and .img-fluid to prevent browser default image alignment -->
      <!-- <b-carousel-slide>
        <template #img>
          <img
            class="d-block img-fluid w-100"
            width="1024"
            height="480"
            src="/img/representative.jfif"
            alt="image slot"
          >
        </template>
      </b-carousel-slide>  -->
    </b-carousel>
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