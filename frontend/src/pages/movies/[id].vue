<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';

import { useMovieStore } from '@stores/MovieStore.mjs';
import { useScreeningStore } from '@stores/ScreeningStore.mjs';
import { onMounted, computed, ref } from 'vue';
import { useRoute } from 'vue-router';
import BaseSpinner from '@components/layout/BaseSpinner.vue';

const route = useRoute();
const movieStore = useMovieStore();
const loading = ref(true);

const movieId = computed(() => Number(route.params.id));
const movie = computed(() => movieStore.movies.find(m => Number(m.id) === movieId.value));

onMounted(async () => {
    loading.value = true;
    await movieStore.getMovies();
    loading.value = false;
});


</script>

<template>
    <BaseLayout>
        <div v-if="loading" class="w-full min-h-screen flex justify-center items-center">
            <BaseSpinner />
            <p class="ml-2 font-semibold">Betöltés...</p>
        </div>

        <div v-else-if="!movie">
            <p class="text-red-500 font-bold">Nincs ilyen film!</p>
            <RouterLink to="/">Vissza a Főoldalra</RouterLink>
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
                class="px-4 lg:px-0 w-full max-w-md flex flex-col gap-6 md:max-w-3xl md:flex-row md:gap-8 border-t-4 border-t-slate-600 pt-6">
                
                <div class="flex-shrink-0 flex justify-center md:w-1/2">
                    <img :src="`../assets/img${movie?.poster_url}`" :alt="movie?.title"
                        class="rounded-lg object-cover w-52 h-72 shadow-xl border-2 border-slate-400 border-r-4 border-r-slate-500/90 shadow-slate-600/70 md:w-full md:h-full"
                        draggable="false" />
                </div>
                
                <div class="mt-6 md:mt-0 md:flex-1 mx-auto flex justify-center items-center w-full">
                    <div class="grid grid-cols-2 gap-y-6 w-full h-full mx-auto">
                        <div
                            class="col-span-1 text-base md:text-lg lg:text-xl font-medium text-pink-500 uppercase tracking-wide flex items-center justify-center md:justify-start border-r-4 border-slate-600 w-full md:w-4/5">
                            Premier:
                        </div>
                        <div
                            class="col-span-1 text-xs md:text-base lg:text-lg text-left md:text-center font-semibold flex items-center pl-4 md:pl-0 justify-start w-full">
                            {{ movie?.release_date || 'Ismeretlen' }}
                        </div>

                        <div
                            class="col-span-1 text-base md:text-lg lg:text-xl font-medium text-pink-500 uppercase tracking-wide flex items-center justify-center md:justify-start border-r-4 border-slate-600 w-full md:w-4/5">
                            Kategória:
                        </div>
                        <div v-if="movie.type == 'family'"
                            class="col-span-1 text-xs md:text-base lg:text-lg text-left md:text-center font-semibold flex items-center pl-4 md:pl-0 justify-start w-full">
                            Animációs film
                        </div>
                        <div v-if="movie.type == 'action'"
                            class="col-span-1 text-xs md:text-base lg:text-lg text-left md:text-center font-semibold flex items-center pl-4 md:pl-0 justify-start w-full">
                            Akciófilm
                        </div>
                        <div v-if="movie.type == 'horror'"
                            class="col-span-1 text-xs md:text-base lg:text-lg text-left md:text-center font-semibold flex items-center pl-4 md:pl-0 justify-start w-full">
                            Horrorfilm
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
                            Film hossza:
                        </div>
                        <div
                            class="col-span-1 text-xs md:text-base lg:text-lg text-left md:text-center font-semibold flex items-center pl-4 md:pl-0 justify-start w-full">
                            {{ movie?.duration_min || 'Ismeretlen' }} perc
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full max-w-md md:max-w-3xl mt-4 px-4 lg:px-0 md:mt-10">
                <div v-if="movie.type != 'family'" class="grid grid-cols-1 gap-y-3 gap-x-8 items-center py-2">
                    <div
                        class="text-center md:text-left text-base md:text-lg lg:text-xl font-medium text-pink-300 uppercase tracking-wide col-span-1  underline underline-offset-4">
                        Szereplők
                    </div>
                    <div class="flex flex-wrap gap-2 py-2">
                        <span v-for="actor in movie.actors" :key="actor"
                            class="bg-pink-700/70 text-white text-xs md:text-sm rounded-full px-3 py-1 font-medium shadow">
                            {{ actor }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="w-full max-w-md md:max-w-3xl mt-2 md:mt-6 px-4 lg:px-0">
                <div
                    class="text-center md:text-left text-base md:text-lg lg:text-xl font-medium text-pink-300 uppercase tracking-wide mb-1 underline underline-offset-4">
                    A filmről
                </div>
                <div
                    class="px-2 md:px-0 mt-2 lg:mt-3 text-left w-full text-pink-50 text-xs md:text-base leading-5 lg:text-lg font-semibold">
                    {{ movie?.description || 'Ismeretlen' }}
                </div>
            </div>
        </div>
    </BaseLayout>
</template>