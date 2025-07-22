<template>
    <BaseLayout>
        <Stepper :currentStep="1" />

        <!-- Csekk, hogy elmentette-e a helyet! -->
        <h1 v-if="!ticketStore.location">Hely: <span class="text-4xl text-red-500">NINCS KIVÁLASZTVA</span></h1>

        <h1 v-else>Hely: <span class="text-4xl text-green-500">KI VAN VÁLASZTVA</span></h1>

        <h1 v-if="ticketStore.locationName">Hely neve:
            <span class="text-4xl text-green-500">{{ ticketStore.locationName }}</span>
        </h1>




        <div v-if="ticketStore.location" class="max-w-10xl mx-auto p-5">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                <img src="/starfield_autosmozi.jpg" alt="Helyszín képe"
                    class="rounded-xl shadow-md max-h-80 object-cover md:w-1/2" />

                <div class="flex flex-col space-y-4 md:w-1/2 md:mt-10">
                    <h1 class="text-3xl font-bold text-pink-600">
                        {{ ticketStore.location.name }}
                    </h1>
                    <p class="text-base text-pink-700 text-justify md:mt-5">
                        {{ ticketStore.location.description }}
                    </p>
                </div>
            </div>

            <h2 class="text-3xl font-semibold pt-14">Aktuális filmkínálatunk a {{ ticketStore.locationName }}
                helyszínen:</h2>

            <div class="flex gap-3">
                <button class="p-2 rounded-lg"
                    :class="selectedGenre === 'Mind' ? 'bg-pink-600 text-white' : 'bg-white text-600'"
                    @click="selectedGenre = 'Mind'">Mind</button>

                <button class="p-2 rounded-lg"
                    :class="selectedGenre === 'Adventure' ? 'bg-pink-600 text-white' : 'bg-white text-600'"
                    @click="selectedGenre = 'Adventure'">Kaland</button>

                <button class="p-2 rounded-lg"
                    :class="selectedGenre === 'Comedy' ? 'bg-pink-600 text-white' : 'bg-white text-600'"
                    @click="selectedGenre = 'Comedy'">Vígjáték</button>
            </div>

            <div v-if="filteredMoviesByType.length > 0" class="grid grid-cols-1 md:grid-cols-5 gap-6 mt-10">
                <BaseCard
                v-for="screening in filteredMoviesByType" @click="selectMovie(screening.movie)"
                :key="screening.id"
                :title="screening.movie?.title"
                :type="screening.movie?.type"
                :src="`https://d32qys9a6wm9no.cloudfront.net/images/movies/poster/d6/20249e4b290423cd14d4fbb932faa88a_500x735.jpg?t=1725823421`"
                :alt="screening.movie?.title"
                :description="screening.description"
                />
            </div>
        </div>

        <div v-else>
            <BaseSpinner class="mx-auto mt-10" />
        </div>
    </BaseLayout>
</template>

<script setup>
import { useTicketStore } from '@stores/TicketStore.js';
import { ref, computed, onMounted } from 'vue';
import { useMovieStore } from '@stores/MovieStore.mjs';
import { useScreeningStore } from '@stores/ScreeningStore.mjs';
import { useRouter } from 'vue-router';

import BaseLayout from '@layouts/BaseLayout.vue';
import Stepper from '@components/layout/Stepper.vue';
import BaseSpinner from '@components/layout/BaseSpinner.vue';
import BaseCard from '@components/layout/BaseCard.vue';


const router = useRouter();
const movieStore = useMovieStore();
const screeningStore = useScreeningStore();
const ticketStore = useTicketStore();

function selectMovie(movie) {
    ticketStore.setMovie(movie);
    router.push('/TimeSelector');
}

const selectedGenre = ref('Mind');
const currentLocationId = computed(() => ticketStore.location?.id);

const screenings = ref([]);
const movies = ref([]);



const enrichedScreenings = computed(() => {
    if (!screenings.value.length || !movies.value.length || !currentLocationId.value) return [];
    return screenings.value
      .filter(s => Number(s.drive_in_cinema_id) === Number(currentLocationId.value))
      .map(screening => {
        const movie = movies.value.find(m => Number(m.id) === Number(screening.movie_id));
        return { ...screening, movie: movie || null };
      });
});

const filteredMoviesByType = computed(() => {
    if (selectedGenre.value === 'Mind') return enrichedScreenings.value;
    return enrichedScreenings.value.filter(screening => screening.movie?.type === selectedGenre.value);
});



// console.log-ok
console.log("currentLocationId.value:", currentLocationId.value, typeof(currentLocationId.value));
console.log("screenings:", screeningStore.screenings);




onMounted(async () => {
    await screeningStore.getScreenings();
    await movieStore.getMovies();

    screenings.value = screeningStore.screenings.data;
    movies.value = movieStore.movies;

    console.log("🎥 Vetítések:", screenings.value);
    console.log("🎬 Filmek:", movies.value);
});


</script>