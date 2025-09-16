<script setup>
import BaseLayout from '@layouts/BaseLayout.vue'
import AgeLimitBadge from '@components/AgeLimitBadge.vue'
import PremierWeekTimer from './PremierWeekTimer.vue'
import BaseSpinner from '@components/layout/BaseSpinner.vue';
import { useScreeningStore } from '@stores/ScreeningStore.mjs';
import { computed, onMounted, ref } from 'vue';
import { storage } from '@utils/http.mjs';



const loading = ref(true);
const ScreeningStore = useScreeningStore();
onMounted(async () => {
    await ScreeningStore.getScreenings().data;
    loading.value = false;
});


const films = computed(() => {
    const raw = ScreeningStore.screenings;
    const arr = Array.isArray(raw?.data) ? raw.data : [];
    return arr.filter(r => r.movie && r.movie.is_premier === 1);
});
const premierScreeningTime = computed(() => {
    return films.value?.screening?.start_time || '2025-09-18 18:00:00'
})
</script>

<template>
    <BaseLayout>
        <div v-if="!loading" class="min-h-screen text-white flex flex-col items-center py-12 px-4 space-y-20">
            <div class="lg:min-h-screen flex items-center px-8 lg:-mt-12 align-middle w-full mx-auto">
                <PremierWeekTimer :premier-date-time="premierScreeningTime" />
            </div>
            <div v-for="film in films" :key="film.id"
                class="w-full max-w-6xl flex flex-col lg:flex-row gap-8 border-t-4 border-t-slate-600 pt-8"
                id="premier-filmek">
                <div class="lg:w-1/2 flex justify-center relative">
                    <img :src="storage.url(`${film.movie.poster_url}`)" :alt="film.movie.title"
                        class="rounded-lg object-cover w-full md:h-full shadow-xl border-2 border-slate-400 border-r-4 border-r-slate-500/90 shadow-slate-600/70" />
                    <div class="absolute bottom-2 left-2 opacity-90">
                        <AgeLimitBadge :age="film.movie.age_limit" klassz="w-8 h-8 md:w-10 md:h-10 lg:h-12 lg:w-12" />
                    </div>
                </div>
                <div class="lg:w-1/2 flex flex-col justify-center gap-4">
                    <h2 class="text-2xl md:text-3xl font-bold text-amber-400 tracking-wide text-center lg:text-left">{{ film.movie.title }}
                    </h2>
                    <div>
                        <p class="mb-2 text-pink-50 text-sm md:text-base font-semibold px-8 lg:px-0">{{ film.movie.description }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-y-4 border-y-2 border-y-slate-600/50 py-4 w-11/12 mx-auto">
                        <div
                            class="text-pink-400 font-medium uppercase text-sm md:text-base w-1/3 lg:w-2/3 text-left mx-auto tracking-wide">
                            Premier
                        </div>
                        <div class="text-pink-100 font-semibold text-sm md:text-base w-full mx-auto">
                            {{ film.movie.release_date }}
                        </div>

                        <div
                            class="text-pink-400 font-medium uppercase text-sm md:text-base w-1/3 lg:w-2/3 text-left mx-auto tracking-wide">
                            Típus
                        </div>
                        <div v-if="film.movie.type == 'action'"
                            class="text-pink-100 font-semibold text-sm md:text-base w-full mx-auto">
                            Akciófilm
                        </div>
                        <div v-if="film.movie.type == 'horror'"
                            class="text-pink-100 font-semibold text-sm md:text-base w-full mx-auto">
                            horrorfilm
                        </div>
                        <div v-if="film.movie.type == 'family'"
                            class="text-pink-100 font-semibold text-sm md:text-base w-full mx-auto">
                            Családi
                        </div>

                        <div
                            class="text-pink-400 font-medium uppercase text-sm md:text-base w-1/3 lg:w-2/3 text-left mx-auto tracking-wide">
                            Rendező
                        </div>
                        <div class="text-pink-100 font-semibold text-sm md:text-base w-full mx-auto">
                            {{ film.movie.director }}
                        </div>
                        <div
                            class="text-amber-300/90 font-medium uppercase text-sm md:text-base w-1/3 lg:w-2/3 text-left mx-auto tracking-wide">
                            Premier
                        </div>
                        <div class="text-pink-100 font-semibold text-sm md:text-base w-full mx-auto">
                            <span class="text-rose-400 tracking-wider">{{ film.drivein_cinema.name }}</span> mozi
                        </div>
                        <div
                            class="text-amber-300/90 font-medium uppercase text-sm md:text-base w-1/3 lg:w-2/3 text-left mx-auto tracking-wide">
                            Cím
                        </div>
                        <div class="text-pink-100 font-semibold text-sm md:text-base w-full mx-auto">
                            {{ film.drivein_cinema.location }}
                        </div>

                    </div>
                    <div class="px-8 lg:px-2 w-full">
                        <h3 class="text-white underline underline-offset-4 lg:no-underline font-medium uppercase mb-1 mt-2">Szereplők</h3>
                        <div class="flex flex-wrap gap-2 py-2">
                            <span v-for="actor in film.movie.actors" :key="actor"
                                class="bg-pink-600/85 text-white text-xs md:text-sm rounded-full px-3 py-1 font-medium shadow">
                                {{ actor }}
                            </span>
                        </div>
                    </div>
                    <div class="cta_reserv pt-10 w-full mx-auto flex justify-center">
                        <router-link :to="`/movies/${film.movie.id}`"
                            class="bg-amber-500 hover:bg-amber-500/90 text-pink-100 font-medium lg:text-lg tracking-wide lg:font-bold py-4 px-8 rounded-full transition duration-300 shadow-md  shadow-pink-400/85">
                            Premier mozijegy vásárlása
                        </router-link>
                    </div>
                </div>
            </div>

        </div>
        <div v-else class="w-full min-h-screen inline-flex items-center justify-center align-middle">
            <BaseSpinner />
            <p class="pl-4 text-white font-semibold">Betöltés folyamatban...</p>
        </div>
    </BaseLayout>
</template>

<style>
.cta_reserv {
    font-family: Onest, Arial, Helvetica, sans-serif;
}

@import url('https://fonts.googleapis.com/css2?family=Cookie&family=DynaPuff:wght@400..700&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Onest:wght@100..900&family=Permanent+Marker&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap');
</style>