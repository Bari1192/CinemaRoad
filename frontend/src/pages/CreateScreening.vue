<template>
    <BaseLayout>

        <div
            class="mb-28 mx-12 bg-indigo-700/45 border border-purple-700 shadow-md shadow-pink-500 p-3 my-4 rounded-lg text-white">

            <h1 class="text-3xl lg:text-4xl font-semibold text-center my-8 underline underline-offset-8">
                Moziműsor szerkesztő felület
            </h1>
            <div class="grid grid-cols-2 w-fit mx-auto lg:gap-12 lg:mt-2">

                <div class="col-span-1 w-fit  flex flex-col mx-auto justify-normal gap-4 p-4 md:min-h-[220px]">
                    <label class="text-xl font-semibold" for="driveInCinema">
                        Válassza ki a mozi helyszínét a vetítési nap összeállításához:
                    </label>

                    <div class="relative">
                        <button type="button" @click="toggleDropdown"
                            class="w-full text-lg border border-pink-600 text-pink-950 font-semibold p-2 rounded-lg bg-white flex
                             items-center justify-between lg:px-3 align-top cursor-pointer hover:bg-indigo-50 transition-colors"
                            :class="{ 'ring-2 ring-pink-300': isOpen }">

                            <div class="flex items-center gap-3 py-1">
                                <img v-if="selectedCinema" :src="storage.url(`img/${selectedCinema.name}.jpg`)"
                                    :alt="selectedCinema.name"
                                    class="w-8 h-8 rounded-full object-cover border border-gray-300" />
                                <div v-else
                                    class="w-8 h-8 rounded-full bg-gray-200 border border-slate-500 flex items-center justify-center">
                                    <span class="text-base">📍</span>
                                </div>

                                <span class="md:text-base lg:text-lg lg:text-center">{{ selectedCinema ?
                                    selectedCinema.name : 'Mozihelyszín kiválasztása...' }}</span>
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

                    <div v-if="selectedValue"
                        class="bg-white/10 rounded-lg w-fit ml-auto flex-col items-end justify-end p-3 backdrop-blur-sm">
                        <div class="text-right text-sm text-white font-semibold">Kiválasztott helyszín</div>
                        <div class="text-right text-lg font-bold text-amber-400">{{
                            driveInCinemaStore.driveInCinemas[selectedValue - 1].name }}</div>
                    </div>
                </div>
                <div :class="{ 'opacity-50 pointer-events-none': !selectedCinema }"
                    class="col-span-1 w-full mx-auto flex flex-col justify-normal gap-4 p-4 md:min-h-[220px]">
                    <label class="text-xl font-semibold text-white" for="date">
                        Válassza ki, mely nap moziműsorát szeretné tervezi:
                    </label>
                    <div class="relative">

                        <input name="date" :min="minDate" id="date" type="date" v-model="selectedDate"
                            @change="validateDate" class="w-full bg-white text-lg font-semibold p-3 rounded-lg border-2 border-pink-600  text-pink-950 focus:ring-2 focus:ring-pink-300
                             focus:border-pink-700 transition-all duration-200 hover:bg-sky-50" />

                        <!-- <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                        </div> -->
                    </div>
                    <div v-if="selectedDate" class="bg-white/10 rounded-lg p-3 w-fit backdrop-blur-sm">
                        <div class="text-sm text-white font-semibold">Kiválasztott dátum</div>
                        <div class="text-lg font-bold text-amber-400">{{ selectedDate }}</div>
                    </div>
                </div>
            </div>

            <div
                :class="selectedDate == '' ? 'hidden' : 'w-11/12 rounded-full h-[4px] bg-gradient-to-r from-transparent via-sky-300 to-transparent my-6 mx-auto'">
            </div>

            <div :class="selectedDate ? 'grid grid-cols-4 mt-4 gap-8 mb-8 ' : 'hidden'">
                <!-- térközzel itt a gap-pel játsz, ne a width-del! -->
                <div v-for="(movie, i) in selectedMovieObjects" :key="i" class="p-1 mx-auto rounded">
                    <h2
                        class="text-lg font-semibold w-full text-center mb-2 text-pink-100 py-2 px-3 bg-gradient-to-r from-pink-600/55 via-rose-500/75 to-pink-600/55 shadow-md shadow-sky-200/90 slate-400 rounded-md mx-auto cursor-default">
                        {{ i + 1 }}. Vetítés létrehozása</h2>

                    <select v-model="selectedMovies[i]"
                        class="w-full p-2 border mt-2 text-pink-950 font-semibold rounded">
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

            <div
                :class="selectedMovieObjects.filter(Boolean).length < 1 ? 'hidden' : 'w-11/12 rounded-full h-[4px] bg-gradient-to-r from-transparent via-sky-300 to-transparent mt-14 mx-auto'">
            </div>

            <div :class="'flex w-full h-fit mt-8 mb-12'">
                <button @click="handleCreateScreeningDay"
                    :class="selectedMovieObjects.filter(Boolean).length < 3 ? 'hidden' : 'order-2 bg-emerald-500 shadow-lg shadow-sky-100/50 hover:bg-emerald-500/90 transition-colors duration-200 ease-in-out p-2 px-4 rounded-lg text-white font-semibold block mx-auto border-2 border-sky-300 text-xl'">Vetítési
                    nap
                    mentése
                    <div class="inline-block mx-auto px-2 py-3">
                        <i class="fa-solid fa-download"></i>
                    </div>
                </button>
                <button @click="handleDeleteScreeningDay"
                    :class="selectedMovieObjects.filter(Boolean).length > 0 ? 'order-1 bg-yellow-600 shadow-lg shadow-yellow-100/50 hover:bg-yellow-600/90 transition-colors duration-200 ease-in-out p-2 px-4 rounded-lg text-white font-semibold block mx-auto border-2 border-white/30 text-xl' : 'hidden'">
                    Összeállítás újrakezdése
                    <div class="inline-block mx-auto px-2 py-3">
                        <i class="fa-solid fa-repeat"></i>
                    </div>
                </button>
            </div>
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
const handleDeleteScreeningDay = async () => {
    const confirmed = await ToastService.showConfirm('Módosítások visszavonása', 'Biztosan újra szeretné kezdeni? Eszközölt módosításai törlésre kerülnek.');
    if (confirmed) {
        selectedMovies.value = [null, null, null, null]; // null-t simán sajni nem engedi mert computed-es.
        selectedValue.value = "";
        selectedDate.value = '';
        ToastService.showSuccess('A módosítások visszavonásra kerültek.');
    }
};

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