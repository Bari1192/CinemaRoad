<template>
    <BaseLayout>

        <h1 class="text-3xl font-semibold text-center py-10">
            Vetítési nap összeállító
        </h1>
        <div
            class="mx-12 bg-indigo-700/45 border border-purple-700 shadow-md shadow-pink-500 p-3 my-4 rounded-lg text-white">
            <div class="grid grid-cols-2 lg:w-fit mx-auto lg:gap-12 lg:mt-2">
                <div class="col-span-1 w-fit flex flex-col justify-around m-2 gap-4">
                    <label class="text-xl font-semibold" for="driveInCinema">
                        Válassza ki a mozi helyszínét a vetítési nap összeállításához:
                    </label>

                    <div class="relative">
                        <button type="button" @click="toggleDropdown"
                            class="w-full text-lg border border-pink-600 text-pink-950 font-semibold p-2 rounded-lg bg-white flex items-center justify-between cursor-pointer hover:bg-indigo-50 transition-colors"
                            :class="{ 'ring-2 ring-pink-300': isOpen }">

                            <div class="flex items-center gap-3">
                                <img v-if="selectedCinema" :src="storage.url(`img/${selectedCinema.name}.jpg`)"
                                    :alt="selectedCinema.name"
                                    class="w-8 h-8 rounded-full object-cover border border-gray-300" />
                                <div v-else
                                    class="w-8 h-8 rounded-full bg-gray-200 border border-slate-500 flex items-center justify-center">
                                    <span class="text-base">📍</span>
                                </div>

                                <span>{{ selectedCinema ? selectedCinema.name : 'Mozihelyszín kiválasztása...' }}</span>
                            </div>

                            <svg class="w-5 h-5 transition-transform duration-300" :class="{ 'rotate-180': isOpen }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div v-show="isOpen"
                            class="absolute top-full left-0 right-0 mt-1 bg-white border border-pink-600 rounded-lg shadow-lg z-50 max-h-60 overflow-y-auto">

                            <button v-for="cinema in driveInCinemaStore.driveInCinemas" :key="cinema.id" type="button"
                                @click="selectCinema(cinema)"
                                class="w-full flex items-center gap-3 p-3 hover:bg-indigo-100 transition-colors text-left border-b border-pink-100 last:border-b-0">

                                <img :src="storage.url(`img/${cinema.name}.jpg`)" :alt="cinema.name"
                                    class="w-12 h-12 rounded-full object-cover border border-gray-300 flex-shrink-0"
                                    @error="handleImageError" />

                                <div class="flex-1">
                                    <div class="text-lg font-semibold text-purple-500">
                                        {{ cinema.name }}
                                    </div>
                                    <div class="text-sm italic text-gray-600">
                                        Kiválasztáshoz kattintson ide!
                                    </div>
                                </div>

                                <div v-if="selectedCinema && selectedCinema.id === cinema.id"
                                    class="w-6 h-6 bg-pink-600 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </div>

                    <select name="driveInCinema" id="driveInCinema" v-model="selectedValue" class="sr-only">
                        <option value="">Válasszon...</option>
                        <option v-for="cinema in driveInCinemaStore.driveInCinemas" :key="cinema.id" :value="cinema.id">
                            {{ cinema.name }}
                        </option>
                    </select>
                </div>
                <div :class="{ 'opacity-50 pointer-events-none': !selectedCinema }"
                    class="col-span-1 w-full mx-auto flex flex-col justify-around gap-4 p-4">
                    <label class="text-xl font-semibold text-white" for="date">
                        Válassza ki, mely nap moziműsorát szeretné tervezi:
                    </label>
                    <div class="relative">

                        <input name="date" :min="minDate" id="date" type="date" v-model="selectedDate"
                            @change="validateDate" class="w-full bg-white text-lg font-semibold p-3 rounded-lg border-2 border-pink-600  text-pink-950 focus:ring-2 focus:ring-pink-300
                             focus:border-pink-700 transition-all duration-200 hover:bg-sky-50" />

                        <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                        </div>
                    </div>
                    <div v-if="selectedDate" class="bg-white/10 rounded-lg p-3 backdrop-blur-sm">
                        <div class="text-sm text-white/80">Kiválasztott dátum:</div>
                        <div class="text-lg font-bold text-white">{{ formatSelectedDate }}</div>
                    </div>
                </div>
            </div>

            <div class="w-full h-[5px] bg-gradient-to-r from-transparent via-sky-300 to-transparent my-8">
            </div>

            <div class="grid grid-cols-4 mt-4 gap-8 mb-8"> <!-- térközzel itt a gap-pel játsz, ne a width-del! -->
                <div v-for="(movie, i) in selectedMovieObjects" :key="i" class="p-1 mx-auto rounded">
                    <h2
                        class="text-lg font-semibold text-center mb-2 text-pink-700 py-2 px-3 bg-sky-50 rounded-md w-fit mx-auto cursor-default">
                        {{ i + 1 }}. Vetítés létrehozása</h2>

                    <select v-model="selectedMovies[i]" class="w-full p-2 border mt-2 text-pink-950 rounded">
                        <option disabled value="">Válassza ki a filmet!</option>
                        <option v-for="movie in movieStore.movies" :key="movie.id" :value="movie.id">
                            {{ movie.title }}
                        </option>
                    </select>

                    <div v-if="movie" class="bg-rose-50 border-2 border-indigo-500 rounded-lg min-h-[650px]
                     shadow-md shadow-sky-300 mt-3 p-2 flex flex-col justify-between">
                        <img v-if="movie.poster_url" :src="storage.url(movie.poster_url)" :alt="movie.title"
                            class="w-full h-64 object-cover rounded-md" />
                        <div class="card-body mt-2">
                            <div
                                class="grid grid-cols-2 mt-2 text-center text-gray-800 font-semibold border-b border-black/10 pl-1 pb-2">
                                <div
                                    class="bg-amber-300 my-auto px-2 py-2 border-r-2 border-black/10 text-black rounded-md">
                                    Film címe:
                                </div>
                                <h2 class="card-title text-base px-2 py-2 text-black font-semibold">
                                    {{ movie.title }}</h2>
                            </div>
                        </div>
                        <div
                            class="grid grid-rows-4 mt-2 text-center text-gray-800 font-semibold border-b border-black/10 pl-1">
                            <div
                                class="row-span-1 bg-amber-300 border-y-2 border-black/10 px-2 py-2 text-black rounded-md">
                                Film leírása:
                            </div>
                            <div class="row-span-3 text-sm font-normal text-start px-2 text-black pt-2 pb-0">{{
                                movie.description }}</div>
                        </div>

                        <div class="grid grid-cols-2 mt-2 text-center text-gray-800 font-semibold">
                            <div class="bg-amber-300 px-2 py-2 border-r-2 border-black/10 text-black rounded-md">
                                Vetítés:
                            </div>
                            <div class="px-2 py-2 text-black">
                                {{ getSchedule(i, movie.duration_min) }}
                            </div>
                        </div>
                        <div class="grid grid-cols-2 mt-2 text-center text-gray-800 font-semibold">
                            <div class="bg-amber-300 px-2 py-2 text-black rounded-md border-r-2 border-black/10">
                                Kategória:
                            </div>
                            <div class="px-2 py-2 text-black capitalize">
                                {{ movie.type }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button @click="handleCreateScreeningDay"
                class="bg-white p-2 px-4 rounded-lg text-pink-600 font-semibold block mx-auto text-xl">Vetítési nap
                mentése</button>
        </div>
    </BaseLayout>
</template>

<script setup>
import { computed, ref, onMounted, onUnmounted } from "vue";
import { storage } from "@utils/http.mjs";
import { ToastService } from "@stores/ToastService";
import BaseLayout from "@layouts/BaseLayout.vue";
import { useRouter } from 'vue-router';
import { useMovieStore } from "@stores/MovieStore.mjs";
import { useDriveInCinemaStore } from "@stores/DriveInCinemaStore";
import { useUserStore } from "@stores/UserStore";
import { useScreeningStore } from "@stores/ScreeningStore.mjs";

const movieStore = useMovieStore();
const driveInCinemaStore = useDriveInCinemaStore();
const screeningStore = useScreeningStore();
const userStore = useUserStore();

const selectedMovies = ref(["", "", "", ""]);
const isOpen = ref(false);
const selectedValue = ref("");
const router = useRouter();
const selectedDate = ref('');
const screeningsArray = ref([]);
const baseStart = { hour: 16, minute: 30 };
const maxScreeningsPerDay = 4;
const startTimes = ref([]);




const selectedMovieObjects = computed(() =>
    selectedMovies.value.map((id) =>
        movieStore.movies.find((m) => m.id === id) || null
    )
);

const selectedCinema = computed(() => {
    if (!selectedValue.value) return null
    return driveInCinemaStore.driveInCinemas.find(cinema => cinema.id === selectedValue.value)
});

const minDate = computed(() => {
    if (!selectedCinema.value) return '';

    let date = new Date();

    while (screeningsArray.value.some(
        s => s.drive_in_cinema_id === selectedCinema.value.id &&
            s.start_time.startsWith(date.toISOString().split("T")[0])
    )) {
        date.setDate(date.getDate() + 1);
    }

    return date.toISOString().split("T")[0];
});


const toggleDropdown = () => {
    isOpen.value = !isOpen.value
};

const selectCinema = (cinema) => {
    selectedValue.value = cinema.id
    isOpen.value = false
};

const handleImageError = (event) => {
    event.target.src = storage.url('img/default-cinema.jpg')
    console.warn('Mozi kép nem található:', event.target.alt)
};

const closeDropdown = (event) => {
    if (!event.target.closest('.relative')) {
        isOpen.value = false
    }
};

const getSchedule = (index, duration) => {

    let currentHour = baseStart.hour;
    let currentMinute = baseStart.minute;

    for (let j = 0; j < index; j++) {
        const movie = selectedMovieObjects.value[j];
        if (movie?.duration_min) {
            currentMinute += movie.duration_min + 20;
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

const getStartTimes = () => {
    let currentHour = baseStart.hour;
    let currentMinute = baseStart.minute;

    startTimes.value = selectedMovieObjects.value.map(movie => {
        if (!movie) return null;

        const pad = n => (n < 10 ? "0" + n : n);
        const startTimeStr = `${pad(currentHour)}:${pad(currentMinute)}`;

        let totalMinutes = currentMinute + movie.duration_min + 20;
        while (totalMinutes >= 60) {
            totalMinutes -= 60;
            currentHour++;
        }
        currentMinute = totalMinutes;

        return startTimeStr;
    });
};


const computeAvailableDate = (date) => {
    const dateStr = date.toISOString().split("T")[0];

    const count = screeningsArray.value.filter(s =>
        s.drive_in_cinema_id === selectedCinema.value.id &&
        s.start_time.split(" ")[0] === dateStr
    ).length;

    if (count >= maxScreeningsPerDay) {
        const nextDate = new Date(date);
        nextDate.setDate(date.getDate() + 1);
        return computeAvailableDate(nextDate);
    }

    return dateStr;
};

const handleCreateScreeningDay = async () => {
    getStartTimes();

    const datePrefix = selectedDate.value;
    await Promise.all(selectedMovies.value.map((movieId, i) => {
        if (!movieId) return;
        return screeningStore.createScreening({
            movie_id: movieId,
            drive_in_cinema_id: selectedCinema.value.id,
            start_time: `${datePrefix} ${startTimes.value[i]}:00`
        });
    }));

    ToastService.showSuccess(`Vetítések sikeresen létrehozva a ${datePrefix} napra!`)
}

onMounted(async () => {
    await userStore.getUser();
    if (!userStore.isAdmin) {
        router.replace("/");
    };

    await movieStore.getMovies();
    await driveInCinemaStore.getDriveInCinemas();

    const screeningsResponse = await screeningStore.getScreenings();
    screeningsArray.value = screeningsResponse.data;
});

onUnmounted(() => {
    document.removeEventListener('click', closeDropdown);
});
</script>





<style scoped>
.max-h-60::-webkit-scrollbar {
    width: 6px;
}

.max-h-60::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.max-h-60::-webkit-scrollbar-thumb {
    background: #db2777;
    border-radius: 3px;
}

.max-h-60::-webkit-scrollbar-thumb:hover {
    background: #be185d;
}

.sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}
</style>