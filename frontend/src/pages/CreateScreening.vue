<template>
    <BaseLayout>

        <h1 class="text-3xl font-semibold text-center py-10">
            Vetítési nap összeállító
        </h1>
        <div class="bg-gray-200 p-3 my-4 rounded-lg">
            <div class="flex flex-row">
                <div class="px-3">
                    <label class="text-xl font-semibold" for="date">
                        Dátum kiválasztása:
                    </label>
                    <input name="date" type="date" class="text-lg font-semibold p-1 rounded-lg" />
                </div>

                <div class="px-3">
                    <label class="text-xl font-semibold" for="driveInCinema">
                        Mozi kiválasztása:
                    </label>
                    <select name="driveInCinema" id="driveInCinema"
                        class="text-lg border border-pink-600 font-semibold p-2 rounded-lg">
                        <option v-for="cinema in driveInCinemaStore.driveInCinemas" :key="cinema.id" :value="cinema.id">
                            {{ cinema.name }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-3">
                <div v-for="(movie, i) in selectedMovieObjects" :key="i" class="p-1  w-8/12 rounded">
                    <h2 class="text-lg font-semibold text-center mb-2">{{ i + 1 }}. Film</h2>

                    <select v-model="selectedMovies[i]" class="w-full p-2 border rounded">
                        <option disabled value="">Válassz filmet</option>
                        <option v-for="movie in movieStore.movies" :key="movie.id" :value="movie.id">
                            {{ movie.title }}
                        </option>
                    </select>

                    <div v-if="movie" class="card mt-3 p-2 border rounded bg-white">
                        <img v-if="movie.poster_url" :src="storage.url(movie.poster_url)" :alt="movie.title"
                            class="w-full h-64 object-cover" />
                        <div class="card-body mt-2">
                            <h2 class="card-title text-lg text-pink-500 font-semibold">{{ movie.title }}</h2>
                            <p class="text-sm text-gray-600">{{ movie.description }}</p>
                        </div>

                        <div class="mt-2 text-center text-gray-800 font-semibold">
                            {{ getSchedule(i, movie.duration_min) }}
                        </div>
                        <pre>{{ storage.url(movie.poster_url) }}</pre>
                    </div>

                </div>

            </div>
        </div>
    </BaseLayout>
</template>

<script setup>
import { computed, ref, onMounted } from "vue";
import { useMovieStore } from "@stores/MovieStore.mjs";
import { useDriveInCinemaStore } from "@stores/DriveInCinemaStore";
import { storage } from "@utils/http.mjs";
import BaseLayout from "@layouts/BaseLayout.vue";

const movieStore = useMovieStore();
const driveInCinemaStore = useDriveInCinemaStore();

const selectedMovies = ref(["", "", "", ""]);

const selectedMovieObjects = computed(() =>
selectedMovies.value.map((id) =>
movieStore.movies.find((m) => m.id === id) || null
)
);


const baseStart = { hour: 16, minute: 30 };
const getSchedule = (index, duration) => {

    let currentHour = baseStart.hour;
    let currentMinute = baseStart.minute;

    for (let j = 0; j < index; j++) {
        const prevMovie = selectedMovieObjects.value[j];
        if (prevMovie?.duration_min) {
            currentMinute += prevMovie.duration_min + 20;
            while (currentMinute >= 60) {
                currentMinute -= 60;
                currentHour++;
            }
        }
    }

    let endHour = currentHour;
    let endMinute = currentMinute + duration;
    while (endMinute >= 60) {
        endMinute -= 60;
        endHour++;
    }

    const pad = (n) => (n < 10 ? "0" + n : n);

    return `${pad(currentHour)}:${pad(currentMinute)} - ${pad(endHour)}:${pad(endMinute)}`;
};

onMounted(async () => {
    await movieStore.getMovies();
    await driveInCinemaStore.getDriveInCinemas();
});
</script>
