<template>
    <div v-if="!loading" class="mb-28 mx-12 bg-gradient-to-r from-indigo-500 via-purple-700 to-indigo-600 p-4 sm:p-6 rounded-lg shadow-md
 border border-purple-700 shadow-pink-500 my-4 text-white">

        <h1 class="text-3xl lg:text-4xl font-semibold text-center my-8 underline underline-offset-8">
            Moziműsor szerkesztő felület
        </h1>
        <div class="grid grid-cols-2 w-fit mx-auto lg:gap-12 lg:mt-2">

            <div class="col-span-1 w-fit  flex flex-col mx-auto justify-normal gap-4 p-4 md:min-h-[220px]">
                <label class="text-sm md:text-base lg:text-xl font-semibold text-white" for="driveInCinema">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
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
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    class="bg-stone-400/70 border-r-2 border-gray-300/70 rounded-lg w-fit ml-auto flex-col items-end justify-end p-3">
                    <div class="text-right text-sm text-white font-semibold">Kiválasztott helyszín</div>
                    <div class="text-right text-lg font-semibold text-amber-400 tracking-wide">{{
                        driveInCinemaStore.driveInCinemas[selectedValue - 1].name }}</div>
                </div>
            </div>
            <div :class="{ 'opacity-50 pointer-events-none': !selectedCinema }"
                class="col-span-1 w-full mx-auto flex flex-col justify-normal gap-4 p-4 md:min-h-[220px]">
                <label class="text-sm md:text-base lg:text-xl font-semibold text-white" for="date">
                    Válassza ki, mely nap moziműsorát szeretné tervezi:
                </label>
                <div class="relative">

                    <input name="date" :min="minDate" id="date" type="date" v-model="selectedDate"
                        @change="validateDate" class="w-full bg-white text-lg font-semibold p-3 rounded-lg border-2 border-pink-600  text-pink-950 focus:ring-2 focus:ring-pink-300
                             focus:border-pink-700 transition-all duration-200 hover:bg-sky-50" />

                    <!-- <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                        </div> -->
                </div>
                <div v-if="selectedDate" class="bg-stone-400/70 border-r-2 p-3 w-fit border-gray-300/70 rounded-lg">
                    <div class="text-sm text-white font-semibold">Kiválasztott dátum</div>
                    <div class="text-lg font-semibold text-amber-400">{{ selectedDate }}</div>
                </div>
            </div>
        </div>

        <div
            :class="selectedDate == '' ? 'hidden' : 'w-11/12 rounded-full h-[4px] bg-gradient-to-r from-transparent via-sky-300 to-transparent my-6 mx-auto'">
        </div>

        <div
            :class="selectedDate ? 'grid md:grid-cols-2 lg:grid-cols-4 mt-4 md:w-11/12 md:mx-auto gap-8 mb-8 ' : 'hidden'">
            <!-- térközzel itt a gap-pel játsz, ne a width-del! -->
            <div v-for="(movie, i) in selectedMovieObjects" :key="i" class="p-1 mx-auto rounded">
                <h2
                    class="text-sm lg:text-lg font-semibold w-full text-center mb-2 text-pink-100 py-2 px-3 bg-gradient-to-r from-pink-600/75 via-pink-700/70 to-pink-600/75 shadow-md shadow-sky-200/90 slate-400 rounded-md mx-auto cursor-default">
                    {{ i + 1 }}. Vetítés létrehozása</h2>

                <select v-model="selectedMovies[i]"
                    class="w-full text-sm lg:text-base font-medium py-1 px-1 lg:p-2 border mt-2 text-pink-950 lg:font-semibold rounded cursor-pointer">
                    <option disabled value="">Film kiválasztása</option>
                    <option v-for="movie in movieStore.movies" :key="movie.id" :value="movie.id">
                        {{ movie.title }}
                    </option>
                </select>

                <div v-if="movie" class="bg-rose-50 border-2 border-indigo-500 rounded-lg min-h-[670px]
                     shadow-md shadow-sky-300 mt-3 p-2 flex flex-col justify-between">
                    <img v-if="movie.poster_url" :src="storage.url(movie.poster_url)" :alt="movie.title"
                        class="lg:w-full lg:h-64 lg:object-cover object-fit mt-2 mx-auto rounded-md" />

                    <div class="grid grid-cols-1 card-body md:mb-1 lg:mb-0 lg:mt-2">

                        <div class="grid grid-cols-1 md:mt-2 md:gap-3 text-center text-gray-800 pl-1">
                            <div
                                class="bg-amber-300 text-sm my-auto lg:text-base font-semibold px-2 py-2 border-r-2 border-black/10 text-black rounded-md">
                                Film címe:
                            </div>
                            <h2
                                class="card-title pt-2 md:pt-0 text-sm lg:text-base my-auto px-1 lg:px-2 pb-0 lg:pb-2 text-black font-semibold">
                                {{ movie.title }}</h2>
                        </div>
                    </div>
                    <div
                        class="grid grid-rows-4 lg:mt-2 text-center text-gray-800 font-semibold border-b border-black/10 pl-1">
                        <div class="row-span-1 bg-amber-300 border-y-2 border-black/10 px-2 py-2 text-black rounded-md">
                            Film leírása:
                        </div>
                        <div class="row-span-3 text-sm font-normal text-start px-2 text-black pt-2 pb-2 lg:pb-0">{{
                            movie.description }}</div>
                    </div>

                    <div class="grid grid-cols-2 align-middle md:inline-flex md:gap-4 md:justify-around md:mt-2 text-center text-gray-800 font-semibold border-b border-black/10 pb-3 md:pb-2
                    lg:border-b-0 lg:pb-0">

                        <div
                            class="bg-amber-300 w-full md:w-1/3 lg:w-1/2 mr-auto h-fit px-1 lg:px-2 py-2 border-r-2 border-black/10 text-black rounded-md">
                            Vetítés:
                        </div>
                        <div class="px-2 py-2  lg:font-semibold text-black">
                            {{ getSchedule(i, movie.duration_min) }}
                        </div>
                    </div>
                    <div
                        class="grid grid-cols-2 align-middle md:inline-flex md:gap-4 md:justify-around items-center md:mt-2 text-center text-gray-800 font-semibold">
                        <div
                            class="bg-amber-300 w-full md:w-fit lg:w-1/2 p-2 mr-auto text-black rounded-md border-r-2 border-black/10">
                            Kategória:
                        </div>
                        <div class="px-2 py-2 text-black capitalize mx-auto">
                            {{ movie.type }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            :class="selectedMovieObjects.filter(Boolean).length < 1 ? 'hidden' : 'w-11/12 rounded-full h-[4px] bg-gradient-to-r from-transparent via-sky-300 to-transparent mt-14 mx-auto'">
        </div>

        <div :class="'grid gap-4 md:flex w-full h-fit mt-8 mb-4 md:gap-12 md:px-8 md:mb-12'">
            <button @click="handleCreateScreeningDay"
                :class="selectedMovieObjects.filter(Boolean).length < 3 ? 'hidden' : 'order-2 w-full lg:w-fit lg:mx-auto bg-green-600 shadow-lg shadow-sky-100/50 hover:bg-green-600/90 transition-colors duration-200 ease-in-out p-2 px-4 rounded-lg text-white font-semibold block mx-auto border-2 border-sky-300 text-sm md:text-base lg:text-xl'">Vetítési
                nap
                mentése
                <div class="inline-block mx-auto px-2 py-3">
                    <i class="fa-solid fa-download"></i>
                </div>
            </button>
            <button @click="handleDeleteScreeningDay"
                :class="selectedMovieObjects.filter(Boolean).length > 0 ? 'order-1 w-full lg:w-fit lg:mx-auto bg-yellow-600 shadow-lg shadow-yellow-600/60 hover:bg-yellow-600/90 transition-colors duration-200 ease-in-out p-2 px-4 rounded-lg text-white font-semibold block mx-auto border-2 border-white/30 text-sm md:text-base lg:text-xl' : 'hidden'">
                Összeállítás újrakezdése
                <div class="inline-block mx-auto px-2 py-3">
                    <i class="fa-solid fa-repeat"></i>
                </div>
            </button>
        </div>
    </div>
    <div v-else class="w-full my-24 h-full flex justify-center items-top mx-auto font-semibold text-white text-center">
        <p class="inline-flex">
            <BaseSpinner />
            <span class="pl-4 text-lg">Betöltés folyamatban...</span>
        </p>
    </div>
</template>

<script setup>
import { computed, ref, onMounted, onUnmounted } from "vue";
import { storage } from "@utils/http.mjs";
import { ToastService } from "@stores/ToastService";
import { useRouter } from 'vue-router';
import { useMovieStore } from "@stores/MovieStore.mjs";
import { useDriveInCinemaStore } from "@stores/DriveInCinemaStore";
import { useUserStore } from "@stores/UserStore";
import { useScreeningStore } from "@stores/ScreeningStore.mjs";
import BaseSpinner from "./layout/BaseSpinner.vue";

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
const loading = ref(false);

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
    const confirmREQUIRED = await ToastService.showConfirm('Moziműsör Létrehozásának Megerősítése',
        'Biztosan létre szeretné hozni a moziműsort ezekkel az adatokkal? A létrehozás később nem visszavonható!');
    if (confirmREQUIRED) {
        try {
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
        } catch (error) {
            ToastService.showError('Hiba történt a moziműsor létrehozásakor!')
        } finally {
            ToastService.showSuccess(`Vetítések sikeresen létrehozva a ${datePrefix} napra!`)
        }
    }
    else {
        ToastService.showSuccess('Moziműsor létrehozása visszavonásra került!')
    }
}
const handleDeleteScreeningDay = async () => {
    const confirmed = await ToastService.showConfirm('Módosítások visszavonása', 'Biztosan újra szeretné kezdeni? Eszközölt módosításai törlésre kerülnek.');
    if (confirmed) {
        selectedMovies.value = [null, null, null, null];
        selectedValue.value = "";
        selectedDate.value = '';
        ToastService.showSuccess('A módosítások visszavonásra kerültek.');
    }
};

onMounted(async () => {
    loading.value = true;
    try {
        await userStore.getUser();
        if (!userStore.isAdmin) {
            router.replace("/");
        };

        await movieStore.getMovies();
        await driveInCinemaStore.getDriveInCinemas();

        const screeningsResponse = await screeningStore.getScreenings();
        screeningsArray.value = screeningsResponse.data;
    } catch (error) {
        ToastService.showError('Hiba történt a betöltés közben, próbálja újra később!');
    } finally {
        loading.value = false;
    }
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