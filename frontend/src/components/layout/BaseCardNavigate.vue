<script setup>
const props = defineProps({
    title: String,
    type: String,
    src: String,
    alt: String,
    description: String,
});
</script>




<template>
    <div class="card w-full h-full bg-slate-900 shadow-xl rounded-xl border border-slate-700 cursor-pointer hover:scale-105 transition-all duration-200">
        <img :src="src" :alt="alt" class="w-full h-full object-cover rounded-t-xl" />
        <div class="px-4 py-3">
            <h3 class="text-lg font-semibold text-white mb-1 truncate">{{ title }}</h3>
            <p class="text-sm text-slate-200 line-clamp-3">{{ description }}</p>
            <button class="block text-center mt-auto w-full bg-pink-700 hover:bg-pink-600 text-white font-semibold rounded-xl py-2 transition-all">
                Megnézem
            </button>
        </div>
    </div>
</template>