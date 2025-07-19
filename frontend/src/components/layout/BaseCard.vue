<script setup>

const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  type: {
    type: String,
    // nem (required) szükséges, mert ha lokációként használjuk a kártyát, akkor furán nézne ki.
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
    required: true,
  },
})
</script>


<template>
  <div class="card w-full h-full bg-slate-900 shadow-xl overflow-hidden rounded-xl border border-slate-700 transition-all duration-200 hover:scale-105
        hover:cursor-pointer">
    <div class="relative">
      <img :src="props.src" :alt="props.alt" class="w-full h-full object-cover" />
      <span v-if="props.type && props.type=='action'"
        class="text-sky-700 absolute right-0 top-0 text-sm md:text-base font-bold tracking-widest rounded-bl-xl rounded-tr-xl shadow-md shadow-gray-800 uppercase bg-gray-200 py-2.5 px-6
        md:px-6 md:py-2 lg:px-4 lg:py-1.5">
        Akció
      </span>
      <span v-if="props.type && props.type=='family'"
        class="text-yellow-700 absolute right-0 top-0 text-sm md:text-base font-bold tracking-widest rounded-bl-xl rounded-tr-xl shadow-md shadow-gray-800 uppercase bg-gray-200 py-2.5 px-6
        md:px-6 md:py-2 lg:px-4 lg:py-1.5">
        Családi
      </span>
      <span v-if="props.type && props.type=='horror'"
        class="text-red-700 absolute right-0 top-0 text-sm md:text-base font-bold tracking-widest rounded-bl-xl rounded-tr-xl shadow-md shadow-gray-800 uppercase bg-gray-200 py-2.5 px-6
        md:px-6 md:py-2 lg:px-4 lg:py-1.5">
        Horror
      </span>
      <span v-if="props.type && props.type=='comedy'"
        class="text-purple-600 absolute right-0 top-0 text-sm md:text-base font-bold tracking-widest rounded-bl-xl rounded-tr-xl shadow-md shadow-gray-800 uppercase bg-gray-200 py-2.5 px-6
        md:px-6 md:py-2 lg:px-4 lg:py-1.5">
        Vígjáték
      </span>
    </div>
    <div class="flex-1 flex flex-col justify-between px-4 py-3">
      <h3 class="text-lg font-semibold text-white mb-1 truncate">{{ props.title }}</h3>
      <p class="text-sm text-slate-200 mb-3 line-clamp-3">{{ props.description }}</p>
      <button
        class="mt-auto w-full bg-pink-700 hover:bg-pink-600 text-white font-semibold rounded-xl py-2 transition-all">
        Megnézem
      </button>
    </div>
  </div>
</template>