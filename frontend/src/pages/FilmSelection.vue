<template>
    <BaseLayout>
        <div v-if="!isLoading" class="max-w-10xl mx-auto p-5 w-full">
            <h1 class="text-4xl text-center font-bold py-12">Aktuális filmkínálatunk</h1>
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
            <div v-if="filteredMoviesByType.length > 0" class="grid grid-cols-1 md:grid-cols-5 gap-6 mt-5">
                <BaseCard v-for="screening in filteredMoviesByType" @click="selectMovie(screening.movie)"
                    :key="screening.id"
                    :title="screening.movie?.title"
                    :type="screening.movie?.type"
                    :src="`../assets/img${screening.movie.poster_url}`"
                    :alt="screening.movie?.title"
                    :description="screening.movie?.description" 
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
import BaseSpinner from '@components/layout/BaseSpinner.vue';
import BaseCard from '@components/BaseCard.vue';

const screeningStore = useScreeningStore();
const movieStore = useMovieStore();
const ticketStore = useTicketStore();

const router = useRouter();
const selectedGenre = ref('Mind');
const currentLocationId = computed(() => ticketStore.location?.id);
const screenings = ref([]);
const movies = ref([]);
const isLoading = ref(false);

function selectMovie(movie) {
    //ticketStore.setMovie(movie);
    router.push(`/movies/${movie.id}`);
}

const enrichedScreenings = computed(() => {
    if (!screenings.value.length|| !movies.value.length || !currentLocationId.value) return [];
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
    isLoading.value = true;

    await screeningStore.getScreenings();
    await movieStore.getMovies();
    screenings.value = screeningStore.screenings.data;
    movies.value = movieStore.movies;

    isLoading.value = false;
});
</script>