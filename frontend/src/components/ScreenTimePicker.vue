<template>
    <div v-if="screening" class="bg-slate-800 w-11/12 lg:w-9/12 mx-auto rounded-lg py-5 my-5">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- 1. col -->
            <div class="flex flex-row items-start mx-3 space-x-3 sm:flex-row lg:flex-row">
                <!-- Film posztere -->
                <img :src="storage.url(`${screening.movie.poster_url}`)" :alt="screening.movie.title"
                    class="h-[150px] w-[110px] md:w-[200px] md:h-auto lg:w-[250px] lg:h-auto md:ml-3 rounded-lg shadow-lg" />

                <!-- Film adatai -->
                <div class="flex flex-col justify-start">
                    <!-- Cím -->
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold">{{ screening.movie.title }}</h1>

                    <!-- Korhatár, típus, hossz -->
                    <div class="flex flex-row flex-wrap gap-2 mt-1 items-center">
                        <ZeroPlus class="w-[35px] md:w-[40px] lg:w-[40px]" />
                        <span class="px-2 py-1 md:text-lg bg-white font-semibold rounded-lg">{{ screening.movie.type }}</span>
                        <span class="px-2 py-1 md:text-lg bg-white font-semibold rounded-lg">{{ screening.movie.duration_min }}
                            perc</span>
                    </div>
                </div>

                <!-- Pink sáv -->
                <div class="mx-auto hidden sm:block">
                    <div class="bg-pink-600 rounded-lg w-[5px] h-full"></div>
                </div>
            </div>



            <!-- Vetítések, 2. col -->
            <div class="flex md:p-3 lg:gap-1 lg:p-1 lg:flex-row items-center justify-center">
                <button class="h-[90px] w-[100px] mx-2 md:h-[110px] md:w-[100px] md:mx-4 lg:h-[200px] lg:w-[100px] lg:px-1 rounded-lg bg-white" v-for="i in 4" :key="i">
                    <h1 class="text-lg md:text-xl lg:text-2xl my-auto font-semibold justify-center">08.23</h1>
                    <span class="h-[5px] bg-pink-600 block my-2 mx-1 px-1 lg:my-5 rounded-lg"></span>
                    <span class="text-lg md:text-xl lg:text-2xl font-semibold justify-center">16:30</span>
                </button>
            </div>

        </div>
    </div>
</template>



<script setup>
import { useScreeningStore } from '@stores/ScreeningStore.mjs';
import ZeroPlus from '@assets/svg/ZeroPlus.vue';
import { onMounted, ref } from 'vue';
import { storage } from '@utils/http.mjs';

const screeningStore = useScreeningStore();
const screening = ref(null);

onMounted(async () => {
    screening.value = await screeningStore.getScreening(1);
})
</script>