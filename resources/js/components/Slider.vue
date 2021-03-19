<template>
 
    <VueSlickCarousel  v-bind="settings">  
      
      
    
      
      <div  v-for="(tipe, index) in allTypes" :key="index">
        <h3>{{tipe.name}}</h3>
       <img class="img_slide" :src="tipe.img_path" alt="">        
         
      </div> 
    </VueSlickCarousel>
  
</template>

<script>
 import VueSlickCarousel from 'vue-slick-carousel'
  import 'vue-slick-carousel/dist/vue-slick-carousel.css'
  // optional style for arrows & dots
  import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
  
export default {
  name: 'Slide',
  components: { VueSlickCarousel },
  props: {    
    array: Array
  },
  data(){
    return{
      allTypes:[],      
      settings:{
  "dots": true,
  "focusOnSelect": true,
  "infinite": true,
  "speed": 500,
  "slidesToShow": 3,
  "slidesToScroll": 3,
  "touchThreshold": 5
}
    }
  },
  mounted() {
        
        axios.get(`http://127.0.0.1:8000/api/allTypes`)
                .then(response => {
                    this.allTypes = response.data;
                    console.log( this.allTypes );
                    
                })
    },
  
}
</script>

<style>
/*
.category_box{
  width: 150px;
  height: 100px;
}
.carousel{
  height: 200px;
  color: black;
}

.img_slide{
  width: 100%;
  height: 100%;
}*/
</style>