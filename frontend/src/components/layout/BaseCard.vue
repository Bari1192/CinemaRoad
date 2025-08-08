<script setup>
import { RouterLink } from 'vue-router';
import Family from '@assets/svg/Family.vue'
import SixteenPlus from '@assets/svg/SixteenPlus.vue'
import EighteenPlus from '@assets/svg/EighteenPlus.vue'

const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  type: {
    type: String,
  },
  src: {
    type: String,
    required: true,
  },
  alt: {
    type: String,
    required: true,
  },
  description: {
    type: String,
  },
  cinema: {
    type: Object,
    default: null
  }
})

</script>


<template>
  <div class="card w-full h-full bg-slate-900 shadow-xl overflow-hidden rounded-xl border border-slate-700 transition-all duration-200 hover:scale-105
        hover:cursor-pointer">
    <div class="relative">
      <div class="w-full h-full relative">
        <img :src="`${props.src}`" :alt="props.alt" class="object-cover w-full h-full" />
        <div v-if="props.type == 'action'" class="absolute top-0 left-0 opacity-85">
          <SixteenPlus class="w-10 h-10" />
        </div>
        <div v-if="props.type == 'family'" class="absolute top-0 left-0 opacity-85">
          <Family class="w-10 h-10" />
        </div>
        <div v-if="props.type == 'horror'" class="absolute top-0 left-0 opacity-85">
          <EighteenPlus class="w-10 h-10" />
        </div>
      </div>
      <span v-if="props.type && props.type == 'action'" class="text-sky-700 absolute right-0 top-0 text-sm md:text-base font-bold tracking-widest rounded-bl-xl rounded-tr-xl shadow-md shadow-gray-800 uppercase bg-gray-200 py-2.5 px-6
        md:px-6 md:py-2 lg:px-4 lg:py-1.5">
        Akció
      </span>
      <span v-if="props.type && props.type == 'family'" class="text-yellow-700 absolute right-0 top-0 text-sm md:text-base font-bold tracking-widest rounded-bl-xl rounded-tr-xl shadow-md shadow-gray-800 uppercase bg-gray-200 py-2.5 px-6
        md:px-6 md:py-2 lg:px-4 lg:py-1.5">
        Családi
      </span>
      <span v-if="props.type && props.type == 'horror'" class="text-red-700 absolute right-0 top-0 text-sm md:text-base font-bold tracking-widest rounded-bl-xl rounded-tr-xl shadow-md shadow-gray-800 uppercase bg-gray-200 py-2.5 px-6
        md:px-6 md:py-2 lg:px-4 lg:py-1.5">
        Horror
      </span>
      <span v-if="props.type && props.type == 'premier'" class="text-white absolute right-0 top-0 text-sm md:text-base font-bold tracking-widest rounded-bl-xl rounded-tr-xl shadow-md shadow-gray-800 uppercase bg-yellow-700/90 py-2.5 px-6
        md:px-6 md:py-2 lg:px-4 lg:py-1.5">
        új
      </span>
    </div>
    <div class="flex-1 flex flex-col justify-between px-4 py-3">
      <h3 class="text-lg font-semibold text-white mb-1 truncate">{{ props.title }}</h3>
      <p class="text-sm text-slate-200 mb-3 line-clamp-3">{{ props.description }}</p>
      <div v-if="props.type == 'premier'">
        <router-link :to="'/movies/SpecialWeek'"
          class="block text-center mt-auto w-full bg-pink-700 hover:bg-pink-600 text-white font-semibold rounded-xl py-2 transition-all">
          Megnézem
        </router-link>
      </div>
      <div v-else>
        <RouterLink :to="'/'"
          class="block text-center mt-auto w-full bg-pink-700 hover:bg-pink-600 text-white font-semibold rounded-xl py-2 transition-all">
          Megnézem
        </RouterLink>
      </div>
    </div>
  </div>
</template>
