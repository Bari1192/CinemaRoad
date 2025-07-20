<template>
    <div v-if="cinema" class="max-w-10xl mx-auto p-5">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
            <img
                src="/starfield_autosmozi.jpg"
                alt="Helyszín képe"
                class="rounded-xl shadow-md max-h-80 object-cover md:w-1/2"
            />

            <div class="flex flex-col space-y-4 md:w-1/2 md:mt-10">
                <h1 class="text-3xl font-bold text-pink-600">
                    {{ cinema.name }}
                </h1>
                <p class="text-base text-pink-700 text-justify md:mt-5">
                    {{ cinema.description }}
                </p>
            </div>
        </div>

        <h2 class="text-3xl font-semibold pt-14">Aktuális filmkínálatunk a {{ cinema.name }} helyszínen:</h2>

        <div class="flex gap-3">
            <button
                class="p-2 rounded-lg"
                :class="selectedGenre === 'Mind' ? 'bg-pink-600 text-white' : 'bg-white text-600'"
                @click="selectedGenre='Mind'">Mind</button>

            <button
                class="p-2 rounded-lg"
                :class="selectedGenre === 'Adventure' ? 'bg-pink-600 text-white' : 'bg-white text-600'"
                @click="selectedGenre='Adventure'">Kaland</button>

            <button
                class="p-2 rounded-lg"
                :class="selectedGenre === 'Comedy' ? 'bg-pink-600 text-white' : 'bg-white text-600'"
                @click="selectedGenre='Comedy'">Vígjáték</button>
        </div>
        <div v-if="screenings.length > 0" class="grid grid-cols-1 md:grid-cols-5 gap-6 mt-10">
            <BaseCard
                v-for="screening in filteredMoviesByType"
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
</template>


<script setup>
import { useDriveInCinemaStore } from '@stores/DriveInCinemaStore.js';
import BaseSpinner from '@components/layout/BaseSpinner.vue';
import BaseCard from '@components/BaseCard.vue';

import { onMounted, ref, computed } from 'vue';
import { useRoute } from 'vue-router';
import { http } from '@utils/http.mjs';

const cinema = ref(null);
const route = useRoute();
const screenings = ref([]);
const movies = ref([]);
const selectedGenre = ref('Mind');

function slugify(text) {
    return text
    .toLowerCase()
    .replace(/á/g, 'a')
    .replace(/é/g, 'e')
    .replace(/í/g, 'i')
    .replace(/ó|ö|ő/g, 'o')
    .replace(/ú|ü|ű/g, 'u')
    .replace(/\s+/g, '-')
    .replace(/[^\w\-]+/g, '')
    .replace(/\-\-+/g, '-')
    .replace(/^-+/, '') 
    .replace(/-+$/, '');
}

onMounted( async() => {
    const driveInCinemaStore = useDriveInCinemaStore();
    await driveInCinemaStore.getDriveInCinemas();
    
    cinema.value = driveInCinemaStore.driveInCinemas.find(c =>
        slugify(c.name) === route.params.locationName.toLowerCase()
    );

    if(cinema.value) {
        console.log("cinema ID: ", cinema.value.id)

        const response = await http.get("/screenings");
        screenings.value = response.data.data.filter(
            screening => screening.drive_in_cinema_id === cinema.value.id
        );

        const moviesResponse = await http.get('/movies');
        movies.value = moviesResponse.data.data;
    }
});

const enrichedScreenings = computed(() => {
  return screenings.value.map(screening => {
    const movie = movies.value.find(m => m.id === screening.movie_id);
    return {
      ...screening,
      movie: movie || null
    };
  });
});

const filteredMoviesByType = computed(() => {
    if(selectedGenre.value === 'Mind') {
        return enrichedScreenings.value;
    }

    return enrichedScreenings.value.filter(screening =>
        screening.movie?.type === selectedGenre.value
    )
})

</script>
