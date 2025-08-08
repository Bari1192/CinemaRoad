<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';

import { useMovieStore } from '@stores/MovieStore.mjs';
import { useScreeningStore } from '@stores/ScreeningStore.mjs';
import { onMounted, computed, ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import BaseSpinner from '@components/layout/BaseSpinner.vue';

const route = useRoute();
const movieStore = useMovieStore();
const screeningStore = useScreeningStore();
const loading = ref(false);

const movie = computed(() => movieStore.movieDetails);

onMounted(async () => {
    
    loading.value = true;

    
    if(!movieStore.movieDetails) {
        const storedMovie = localStorage.getItem('movieDetails');

        if(storedMovie) {
            movieStore.movieDetails = JSON.parse(storedMovie)
        }
    }

    await screeningStore.getScreenings();
    await movieStore.getMovies();

    loading.value = false;
})




</script>

<template>
    <BaseLayout>
        <div v-if="!movie">
            <BaseSpinner />
        </div>
        <div v-else class="min-h-screen text-white flex flex-col items-center align-middle w-full py-8">
            <h1
                class="text-pink-500 text-2xl md:text-4xl lg:text-5xl lg:font-extrabold font-bold mb-4 text-center tracking-wide w-full md:w-2/5 lg:w-3/5">
                A Cinema Road Bemutatja
            </h1>
            <h2 class="w-5/6 md:w-2/5 lg:w-3/5 text-2xl md:text-4xl mb-12 text-center tracking-wide font-extrabold">
                {{ movie.title }}
            </h2>
            <div
                class="w-full max-w-md flex flex-col gap-6 md:max-w-3xl md:flex-row md:gap-8 border-t-4 border-t-slate-600 pt-6">
                <div class="flex-shrink-0 flex justify-center md:w-1/2">
                    <img :src="`../assets/img${movie?.poster_url}`" :alt="movie?.title"
                        class="rounded-lg object-cover w-52 h-72 shadow-xl border-2 border-slate-400 border-r-4 border-r-slate-500/90 shadow-slate-600/70 md:w-full md:h-full"
                        draggable="false" />
                </div>
                <div class="mt-6 md:mt-0 md:flex-1 mx-auto flex justify-center items-center w-full">
                    <div class="grid grid-cols-2 gap-y-6 w-full h-full mx-auto">
                        <div
                            class="col-span-1 text-base md:text-lg lg:text-xl font-medium text-pink-500 uppercase tracking-wide flex items-center justify-center md:justify-start border-r-4 border-slate-600 w-full md:w-4/5">
                            Készült:
                        </div>
                        <div
                            class="col-span-1 text-xs md:text-base lg:text-lg text-left md:text-center font-semibold flex items-center pl-4 md:pl-0 justify-start w-full">
                            {{ movie?.release_date || 'Ismeretlen' }}
                        </div>

                        <div
                            class="col-span-1 text-base md:text-lg lg:text-xl font-medium text-pink-500 uppercase tracking-wide flex items-center justify-center md:justify-start border-r-4 border-slate-600 w-full md:w-4/5">
                            Típus:
                        </div>
                        <div
                            class="col-span-1 text-xs md:text-base lg:text-lg text-left md:text-center font-semibold flex items-center pl-4 md:pl-0 justify-start w-full">
                            {{ movie?.type || 'Ismeretlen' }}
                        </div>

                        <div
                            class="col-span-1 text-base md:text-lg lg:text-xl font-medium text-pink-500 uppercase tracking-wide flex items-center justify-center md:justify-start border-r-4 border-slate-600 w-full md:w-4/5">
                            Rendező:
                        </div>
                        <div
                            class="col-span-1 text-xs md:text-base lg:text-lg text-left md:text-center font-semibold flex items-center pl-4 md:pl-0 justify-start w-full">
                            {{ movie?.director || 'Ismeretlen' }}
                        </div>

                        <div
                            class="col-span-1 text-base md:text-lg lg:text-xl font-medium text-pink-500 uppercase tracking-wide flex items-center justify-center md:justify-start border-r-4 border-slate-600 w-full md:w-4/5">
                            Játékidő:
                        </div>
                        <div
                            class="col-span-1 text-xs md:text-base lg:text-lg text-left md:text-center font-semibold flex items-center pl-4 md:pl-0 justify-start w-full">
                            {{ movie?.duration_min || 'Ismeretlen' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full max-w-md md:max-w-3xl mt-4 px-4 md:mt-10">
                <div class="grid grid-cols-1 gap-y-3 gap-x-8 items-center py-2">
                    <div
                        class="text-center md:text-left text-base md:text-lg lg:text-xl font-medium text-pink-300 uppercase tracking-wide col-span-1  underline underline-offset-4">
                        Szereplők
                    </div>
                    <div
                        class="text-center md:text-left col-span-1 text-pink-50 text-xs md:text-base lg:text-lg font-semibold italic w-full whitespace-normal break-words">
                        {{ movie?.actors || 'Ismeretlen' }}
                    </div>
                </div>
            </div>

            <div class="w-full max-w-md md:max-w-3xl mt-6 px-4">
                <div
                    class="text-center md:text-left text-base md:text-lg lg:text-xl font-medium text-pink-300 uppercase tracking-wide mb-1 underline underline-offset-4">
                    Rövid leírás
                </div>
                <div
                    class="px-2 md:px-0 text-left w-full text-pink-50 text-xs md:text-base leading-5 lg:text-lg font-semibold">
                    {{ movie?.description || 'Ismeretlen' }}
                </div>
            </div>
        </div>
    </BaseLayout>
</template>