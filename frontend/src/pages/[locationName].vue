<template>
    <BaseLayout>
        <div v-if="cinema" class="max-w-10xl mx-auto p-5">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
            <img :src="storage.url(`/img/${cinema.name}.jpg`)" alt="Helyszín képe"
                class="rounded-xl shadow-md max-h-80 object-cover md:w-1/2" />

            <div class="flex flex-col space-y-4 md:w-1/2 md:mt-10">
                <h1 class="text-3xl font-bold text-pink-600">
                    {{ cinema.name }}
                </h1>
                <h2 class="text-xl text-pink-600 font-bold">{{ cinema.location }}</h2>
                <p class="text-xl font-semibold text-pink-600 text-justify md:mt-5">
                    {{ cinema.description }}
                </p>
            </div>
        </div>

        <h2 class="text-3xl font-semibold pt-14">{{ cinema.name }} filmajánló:</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 pt-10">
            <BaseCard v-for="screening in distinctScreenings" :key="screening.id"
                :title="screening.movie.title"
                :src="storage.url(`${screening.movie.poster_url}`)"
                :description="screening.movie.description"
                :type="screening.movie.is_premier ? 'PREMIER' : screening.movie.type" :class="{
                        'text-gray-900': screening.movie?.type === 'action',
                        'text-yellow-700': screening.movie?.type === 'family',
                        'text-red-900': screening.movie?.type === 'horror'
                    }"
                :duration_min="screening.movie.duration_min"
                :poster_url="screening.movie.poster_url"
                :actors="screening.movie.actors"
                :director="screening.movie.director"
                :release_date="screening.movie.release_date"
                :isPremier="screening.movie.is_premier"
                :link="`/movies/${screening.movie.id}`"
                />
        </div>
    </div>

    <div v-else>
        <BaseSpinner class="mx-auto mt-10" />
    </div>
    </BaseLayout>
</template>

<script setup>
import BaseSpinner from '@components/layout/BaseSpinner.vue';
import BaseCard from '@components/BaseCard.vue';
import BaseLayout from '@layouts/BaseLayout.vue';

import { useDriveInCinemaStore } from '@stores/DriveInCinemaStore.js';
import { useMovieStore } from '@stores/MovieStore.mjs';
import { onMounted, ref, computed } from 'vue';
import { useRoute } from 'vue-router';
import { http } from '@utils/http.mjs';
import { storage } from '@utils/http.mjs';

const cinema = ref(null);
const route = useRoute();
const screenings = ref([]);
const movies = ref([]);

const movieStore = useMovieStore();

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
};

onMounted(async () => {
    const driveInCinemaStore = useDriveInCinemaStore();
    await driveInCinemaStore.getDriveInCinemas();

    movieStore.storedMovie == null;
    movieStore.movieDetails == null;
    localStorage.removeItem('movieDetails')

    cinema.value = driveInCinemaStore.driveInCinemas.find(c =>
        slugify(c.name) === route.params.locationName.toLowerCase()
    );

    if (cinema.value) {
        const response = await http.get("/screenings");
        screenings.value = response.data.data.filter(
            screening => screening.drive_in_cinema_id === cinema.value.id
        );

        const moviesResponse = await http.get('/movies');
        movies.value = moviesResponse.data.data;
    }
});


const distinctScreenings = computed(() => {
    const seenMovieIds = new Set();
    const filtered = [];

    for (const screening of screenings.value) {
        if (!screening.movie) continue;

        if (!seenMovieIds.has(screening.movie.id)) {
            seenMovieIds.add(screening.movie.id);
            filtered.push(screening);
        }
    }
    return filtered.slice(0, 4);
})
</script>
