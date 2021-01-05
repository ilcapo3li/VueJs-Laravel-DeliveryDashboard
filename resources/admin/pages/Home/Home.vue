<template>
<div>
  <HomeSlider></HomeSlider>
  <HomeLinks></HomeLinks>
</div>
</template>
<script>
import HomeLinks from './HomeLinks';
import HomeSlider from './HomeSlider';
export default {
    name:'Home',
    components: {
     HomeLinks,
     HomeSlider
    },
    data(){
      return {

      }
    },
    methods:{
      
      
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