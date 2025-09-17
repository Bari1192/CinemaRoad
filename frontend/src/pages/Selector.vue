<template>
    <BaseLayout>
        <Stepper :currentStep="1" />
        <div v-if="ticketStore.location" class="max-w-10xl mx-auto p-5 w-full">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                
                <img :src="storage.url(`/img/${ticketStore.locationName}.jpg`)" alt="Helyszín képe"
                    class="rounded-xl shadow-md max-h-80 object-cover md:w-1/2" />
                <div class="flex flex-col space-y-4 md:w-1/2 md:mt-10">
                    <h1 class="text-3xl font-bold text-pink-600">{{ ticketStore.location.name }}</h1>
                    <h2 class="text-xl font-bold text-pink-600 text-justify md:mt-5">{{ ticketStore.location.location }}
                    </h2>
                    <p class="text-xl font-semibold text-pink-600 text-justify md:mt-5">{{
                        ticketStore.location.description }}</p>
                </div>
            </div>
            <h2 class="text-3xl font-semibold pt-14">Aktuális filmkínálatunk a {{ ticketStore.locationName }}
                helyszínen:</h2>
            <div class="flex gap-3">
                <button class="p-2 rounded-lg"
                    :class="selectedGenre === 'Mind' ? 'bg-pink-600 text-white' : 'bg-white text-600'"
                    @click="selectedGenre = 'Mind'">Mind</button>
                <button class="p-2 rounded-lg"
                    :class="selectedGenre === 'action' ? 'bg-pink-600 text-white' : 'bg-white text-600'"
                    @click="selectedGenre = 'action'">Akció</button>
                <button class="p-2 rounded-lg"
                    :class="selectedGenre === 'family' ? 'bg-pink-600 text-white' : 'bg-white text-600'"
                    @click="selectedGenre = 'family'">Családi</button>
                <button class="p-2 rounded-lg"
                    :class="selectedGenre === 'horror' ? 'bg-pink-600 text-white' : 'bg-white text-600'"
                    @click="selectedGenre = 'horror'">Horror</button>
            </div>
            <div v-if="filteredMoviesByType.length > 0" class="grid grid-cols-1 w-full md:grid-cols-2 gap-4 mt-10">
                <ScreenTimePicker v-for="screening in filteredMoviesByType"
                :moviePosterUrl="screening.movie.poster_url"
                :movieTitle="screening.movie.title"
                :movieAgeLimit="screening.movie.age_limit"
                :movieType="screening.movie.type"
                :movieId="screening.movie.id"
                :isPremier="screening.movie.is_premier"/>
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
//import BaseCard from '@components/BaseCard.vue';
import ScreenTimePicker from '@components/ScreenTimePicker.vue';
import { storage } from '@utils/http.mjs';

const EasierLabelsGenerate = { action: 'Akció', family: 'Családi', horror: 'Horror' }



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
const typeLabel = computed(() => EasierLabelsGenerate[screening.movie?.type] ?? 'Egyéb kategória')
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
    const seenMovieIds = new Set();
    const filtered = [];

    for (const screening of enrichedScreenings.value) {
        if (!screening.movie) continue;

        if (selectedGenre.value === 'Mind' || screening.movie.type === selectedGenre.value) {
            if (!seenMovieIds.has(screening.movie.id)) {
                seenMovieIds.add(screening.movie.id);
                filtered.push(screening);
            }
        }
    }

    return filtered;
});

onMounted(async () => {
    await screeningStore.getScreenings();
    await movieStore.getMovies();
    screenings.value = screeningStore.screenings.data;
    movies.value = movieStore.movies;
});
</script>