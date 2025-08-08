<script setup>

import { ref, onMounted, onUnmounted, computed } from 'vue';

import dustzoneImg from '@/assets/img/Main_Slider_img/Dustzone_last_run.webp'
import nightfireImg from '@/assets/img/Main_Slider_img/Nightfire_redemption.webp'
import realmshatterImg from '@/assets/img/Main_Slider_img/Realmshatter.webp'
const movies = ref([
  { imageUrl: dustzoneImg, title: 'Dustzone: Last Run' },
  { imageUrl: nightfireImg, title: 'Nightfire: Redemption' },
  { imageUrl: realmshatterImg, title: 'Realmshatter' },
])

const activeIndex = ref(0);
let autoplayInterval = null;
const autoplayDelay = 6000;
let direction = 1;

const isPrevDisabled = computed(() => activeIndex.value === 0);
const isNextDisabled = computed(() => activeIndex.value === movies.value.length - 1);

const nextSlide = () => {
  if (activeIndex.value == 3) {
    return;
  }
  activeIndex.value += direction;
  if (activeIndex.value >= movies.value.length - 1) {
    activeIndex.value = movies.value.length - 1;
    direction = -1;
  } else if (activeIndex.value <= 0) {
    activeIndex.value = 0;
    direction = 1;
  }
};

const prevSlide = () => {
  direction = -1;
  nextSlide();
};

const goToSlide = (index) => {
  activeIndex.value = index;
  if (activeIndex.value === movies.value.length - 1) direction = -1;
  else if (activeIndex.value === 0) direction = 1;
  stopAutoplay();

  setTimeout(() => {
    startAutoplay()
  }, 8000);
};

const startAutoplay = () => {
  stopAutoplay();
  autoplayInterval = setInterval(nextSlide, autoplayDelay);
};

const stopAutoplay = () => {
  if (autoplayInterval) {
    clearInterval(autoplayInterval);
    autoplayInterval = null;
  }
};

const getSlideTransform = (index) => {
  const offset = (index - activeIndex.value) * 100;
  return `transform: translateX(${offset}%); opacity: ${index === activeIndex.value ? 1 : 0.5}; z-index: ${index === activeIndex.value ? 5 : 1};`;
};
onMounted(() => {
  startAutoplay();
});
onUnmounted(() => {
  stopAutoplay();
});
</script>

<template>
  <div class="container mx-auto w-full h-full px-0 mt-5 mb-10 xl:my-10 relative overflow-hidden">
    
    <router-link :to="'/movies/SpecialWeek'">
      <div class="carousel-container h-full w-full min-h-[40dvh] max-h-[70dvh] xl:h-[90vh]" @mouseenter="stopAutoplay"
        @mouseleave="startAutoplay">
        <div v-for="(movie, index) in movies" :key="index" :class="[
          'carousel-item absolute w-full h-full transition-transform duration-1000 ease-in-out overflow-hidden border-y-4 border-slate-600 lg:rounded-2xl',
          { 'active-slide': index === activeIndex }
        ]" :style="getSlideTransform(index)">
          <img :src="movie.imageUrl" :alt="movie.title"
            class="w-full h-full object-cover lg:rounded-lg shadow-xl overflow-hidden">
          <div class="absolute right-0 top-0 bg-gradient-to-b from-black via-black/70 to-transparent text-white lg:rounded-r-lg overflow-hidden
        pl-6 pt-2 pr-4 pb-8
        md:pl-8 md:pt-3 md:pb-12
        lg:pl-12 lg:pt-8 lg:pb-16
        xl:pl-12 xl:pt-8 xl:pb-16
        ">
            <h3 class="text-base md:text-xl lg:text-2xl xl:text-4xl font-bold mt-1 text-right">{{ movie.title }}</h3>
            <p class="before_premier text-sm md:text-lg lg:text-xl xl:text-2xl text-right italic lg:mt-1.5 text-pink-500"
              :class="movie.title === 'Dustzone: Last Run' ? 'text-pink-200 font-semibold' : ''">Premier előtti vetítés
            </p>
          </div>
        </div>
      </div>
    </router-link>

    <button @click="!isPrevDisabled && prevSlide()" class="carousel-control-btn absolute left-4 top-1/2 -translate-y-1/2 rounded-full hover:bg-opacity-75 transition-all duration-300 z-10 
      bg-gray-800 border-2 border-gray-900 shadow-md shadow-gray-900/55 text-white
      p-1.5 bg-opacity-90 
      md:p-1.5 md:bg-opacity-80 
      lg:p-2.5
      xl:p-3
      hidden lg:block" :class="{ 'opacity-40 pointer-events-none cursor-not-allowed': isPrevDisabled }">

      <svg class="w-6 h-6 md:w-8 md:h-8 lg:w-10 lg:h-10 xl:w-12 xl:h-12" fill="none" stroke="currentColor"
        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
      </svg>
    </button>

    <button @click="!isNextDisabled && nextSlide()" class="carousel-control-btn absolute right-4 top-1/2 -translate-y-1/2
     bg-gray-800 text-white rounded-full hover:bg-opacity-75 transition-all duration-300 z-10 
      border-2 border-gray-900 shadow-md shadow-gray-900/55 
      p-1.5 bg-opacity-90 
      md:p-1.5 md:bg-opacity-80 
      lg:p-2.5
      xl:p-3
      hidden lg:block" :class="{ 'opacity-40 pointer-events-none cursor-not-allowed': isNextDisabled }">
      <svg class="w-6 h-6 md:w-8 md:h-8 lg:w-10 lg:h-10 xl:w-12 xl:h-12" fill="none" stroke="currentColor"
        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
      </svg>
    </button>

    <div
      class="lg:hidden mb-2 carousel-indicators absolute bottom-2 left-1/2 -translate-x-1/2 flex space-x-2 z-10 bg-gray-400/70 rounded-lg p-1">
      <button v-for="(movie, index) in movies" :key="'indicator-' + index" @click="goToSlide(index)" :class="['md:w-6 md:h-6 w-4 h-4 rounded-full bg-gray-400 border border-white/25 shadow-sm shadow-black/50 hover:bg-pink-100 transition-colors duration-300'
        , { 'bg-pink-500': index === activeIndex }]"></button>
    </div>

  </div>
</template>

<style scoped>
.carousel-container {
  overflow: hidden;
  position: relative;
}

.carousel-item.active-slide {
  transform: translateX(0%);
  opacity: 1;
  z-index: 5;
}

.before_premier {
  font-family: 'Noto Sans', 'Times New Roman', Times, serif;
  font-style: unset;
  text-shadow: 0 0 25px rgb(158, 119, 144);
}

@import url('https://fonts.googleapis.com/css2?family=Cookie&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Onest:wght@100..900&display=swap');
</style>