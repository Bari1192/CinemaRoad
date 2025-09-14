<script setup>
import ZeroPlus from '@assets/svg/ZeroPlus.vue';
import FourPlus from '@assets/svg/FourPlus.vue';
import SixPlus from '@assets/svg/SixPlus.vue';
import TwelvePlus from '@assets/svg/TwelvePlus.vue';
import SixteenPlus from '@assets/svg/SixteenPlus.vue';
import EighteenPlus from '@assets/svg/EighteenPlus.vue';
import { computed } from 'vue';
const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  type: {
    type: String,
    required: true,
  },
  type_visible: {
    type: Boolean,
    required: false,
    default: true,
  },
  src: {
    type: String,
    required: true,
  },
  alt: {
    type: String,
    required: false,
  },
  description: {
    type: String,
    required: true,
  },
  cta: {
    type: Boolean,
    required: false,
    default: true,
  },
  button_text: {
    type: String,
    required: false,
    default: 'Megnézem',
  },
  link: {
    type: String,
    required: false,
  },
  age_limit: {
    type: Number,
    required: false,
  },
  age_limit_visible: {
    type: Boolean,
    default: true,
    required: false,
  },
  img_size_class: {
    type: String,
    required: false,
    default: 'h-[160px] sm:h-[220px] md:h-[400px] w-full object-cover overflow-hidden'
  },
  displayLocationName: {
    type: Boolean,
    required: false
  },
  locationName: {
    type: String,
    required: false
  },
  isPremier: {
    type: Boolean,
    required: false,
    default: false
  }
})

const cityName = computed(() => {
  if (!props.locationName) return ""
  return props.locationName.split(",")[0]
})
</script>

<template>
  <div class="card w-full h-full bg-slate-900 rounded-2xl shadow-xl overflow-hidden border border-slate-700 min-h-[12rem] transition-all duration-200 hover:scale-105
        hover:cursor-pointer">
    <div class="relative">
      <div v-if="age_limit_visible" class="w-full h-full relative">
        <div v-if="props.age_limit === 0" class="absolute top-0 left-0 opacity-85">
          <ZeroPlus class="w-10 h-10" />
        </div>
        <div v-if="props.age_limit === 4" class="absolute top-0 left-0 opacity-85">
          <FourPlus class="w-10 h-10" />
        </div>
        <div v-if="props.age_limit === 6" class="absolute top-0 left-0 opacity-85">
          <SixPlus class="w-10 h-10" />
        </div>
        <div v-if="props.age_limit === 12" class="absolute top-0 left-0 opacity-85">
          <TwelvePlus class="w-10 h-10" />
        </div>
        <div v-if="props.age_limit === 16" class="absolute top-0 left-0 opacity-85">
          <SixteenPlus class="w-10 h-10" />
        </div>
        <div v-if="props.age_limit === 18" class="absolute top-0 left-0 opacity-85">
          <EighteenPlus class="w-10 h-10" />
        </div>
      </div>
      <img :src="props.src" :alt="props.alt" :class="props.img_size_class" />
      <span v-if="type_visible"
        class="absolute right-0 top-0 text-xs 'font-bold'  md:text-base tracking-widest py-1 md:py-2 px-4 md:px-6 rounded-bl-xl rounded-tr-2xl shadow-md shadow-gray-800 uppercase bg-gray-200"
        :class="props.type === 'PREMIER' ? 'bg-amber-500 text-white md:font-medium':'md:font-medium' ">
        {{ props.type }}
      </span>

    </div>
    <div class="flex-1 flex flex-col justify-between px-4 py-3">
      <h3 class="text-lg font-semibold text-white mb-1 flex justify-between items-center">
        <span class="truncate">{{ props.title }}</span>
        <span v-if="displayLocationName" class="ml-auto">{{ cityName }}</span>
      </h3>
      <p class="text-sm text-slate-200 mb-3 line-clamp-3">{{ props.description }}</p>
      <span v-if="cta">
        <router-link :to="`${props.link}`">
          <button
            class="mt-auto w-full bg-pink-700 hover:bg-pink-600 text-white font-semibold rounded-xl py-2 transition-all">
            {{ props.button_text }}
          </button>
        </router-link>
      </span>
    </div>
  </div>
</template>