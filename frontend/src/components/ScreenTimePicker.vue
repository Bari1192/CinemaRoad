<template>
    <!-- Fő tároló -->
    <div class="bg-slate-800 rounded-lg">

        <!-- Első tároló row-ban. Képnek meg leírásnak. -->
        <div class="flex flex-row">
            <!-- Kép, adatok sora -->
            <div class="grid grid-cols-2 lg:grid-cols-3">
                <!-- Kép -->
                <div class="p-2">
                    <img class="lg:h-[200px] lg:w-[200px] object-cover" :src="storage.url(props.moviePosterUrl)"
                        :alt="props.movieTitle">
                </div>

                <!-- Adatok -->
                <div class="flex flex-col lg:col-span-2">
                    <h1 class="font-bold my-1 text-pink-600 text-lg md:text-2xl hover:underline">
                        <RouterLink :to="`/movies/${props.movieId}`">{{ props.movieTitle }}</RouterLink>
                    </h1>
                    <span class="flex flex-row">
                        <component :is="AgeLimitIcons[props.movieAgeLimit]" class="w-8 h-8" />
                        <span class="bg-yellow-500 text-black text-center p-1 ml-[10px] font-semibold rounded-full"
                            v-if="props.isPremier">Premier</span>
                    </span>
                    <h2 class="my-2"><span
                            class="bg-white p-1 px-2 text-pink-600 font-semibold rounded-full">{{ props.movieType }}</span></h2>

                    <div class="flex-row hidden mt-2 lg:flex">
                        <button type="button"
                            @click="handleSelectScreeningTime(screening.drivein_cinema.name, screening.drivein_cinema.id, screening.movie.id, screening.id)"
                            v-for="screening in onlyFourScreenings"
                            class="bg-white text-pink-600 text-lg font-semibold mx-1 rounded-lg p-2">
                            {{ formatDate(screening.start_time).date }} <br>
                            <div class="bg-pink-600 h-[3px] rounded-full"></div> {{
                                formatDate(screening.start_time).time}}

                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-row p-2 lg:hidden">
            <button type="button"
                @click="handleSelectScreeningTime(screening.drivein_cinema.name, screening.drivein_cinema.id, screening.movie.id, screening.id)"
                v-for="screening in onlyFourScreenings" class="bg-white text-lg font-semibold mx-1 rounded-lg p-2">
                {{ formatDate(screening.start_time).date }} <br>
                <div class="bg-pink-600 h-[3px] rounded-full"></div> {{ formatDate(screening.start_time).time }}
            </button>
        </div>
    </div>
</template>



<script setup>
import { useScreeningStore } from '@stores/ScreeningStore.mjs';
import { useTicketStore } from '@stores/TicketStore';
import { useDriveInCinemaStore } from '@stores/DriveInCinemaStore';
import { computed } from 'vue';
import { storage } from '@utils/http.mjs';

import ZeroPlus from '@assets/svg/ZeroPlus.vue';
import FourPlus from '@assets/svg/FourPlus.vue';
import SixPlus from '@assets/svg/SixPlus.vue';
import TwelvePlus from '@assets/svg/TwelvePlus.vue';
import SixteenPlus from '@assets/svg/SixteenPlus.vue';
import EighteenPlus from '@assets/svg/EighteenPlus.vue';
import { useMovieStore } from '@stores/MovieStore.mjs';
import { useRouter } from 'vue-router';

const screeningStore = useScreeningStore();
const ticketStore = useTicketStore();
const driveinCinemaStore = useDriveInCinemaStore();
const movieStore = useMovieStore();
const router = useRouter();

const onlyFourScreenings = computed(() => {
    const allScreenings = Array.isArray(screeningStore.screenings)
        ? screeningStore.screenings
        : screeningStore.screenings?.data ?? []

    const locationFiltered = allScreenings.filter(
        s =>
            Number(s.drive_in_cinema_id) === Number(ticketStore.location.id) &&
            Number(s.movie_id) === Number(props.movieId)
    )

    const sorted = [...locationFiltered].sort(
        (a, b) => new Date(a.start_time) - new Date(b.start_time)
    )

    return sorted.slice(0, 4)
});

const handleSelectScreeningTime = async (drivein_cinema_name, location_id, movie_id, screening_id) => {

    await driveinCinemaStore.getDriveInCinema(location_id);
    await movieStore.getMovie(movie_id);
    
    const location = await driveinCinemaStore.getDriveInCinema(location_id);
    await ticketStore.setLocation(location);
    await ticketStore.setLocationName(drivein_cinema_name);

    await ticketStore.setMovie(movieStore.movie);

    const screeningObj = await screeningStore.getScreening(screening_id);
    ticketStore.setTime(screeningObj);

    router.push("/ParkingSpotChooser");
}

function formatDate(dateString) {
    const d = new Date(dateString.replace(" ", "T"));
    const month = String(d.getMonth() + 1).padStart(2, "0");
    const day = String(d.getDate()).padStart(2, "0");
    const hours = String(d.getHours()).padStart(2, "0");
    const minutes = String(d.getMinutes()).padStart(2, "0");

    return {
        date: `${month}.${day}`,
        time: `${hours}:${minutes}`
    };
}

const AgeLimitIcons = {
    0: ZeroPlus,
    4: FourPlus,
    6: SixPlus,
    12: TwelvePlus,
    16: SixteenPlus,
    18: EighteenPlus
};

const props = defineProps({
    moviePosterUrl: {
        type: String,
        required: true
    },
    movieTitle: {
        required: true,
        type: String
    },
    movieAgeLimit: {
        required: true,
        type: Number
    },
    movieType: {
        required: true,
        type: String
    },
    movieId: {
        required: true,
        type: Number
    },
    isPremier: {
        required: false,
        type: Number
    }
})
</script>