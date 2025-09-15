<template>
    <!-- Fő tároló -->
    <div class="bg-slate-800 rounded-lg">

        <!-- Első tároló row-ban. Képnek meg leírásnak. -->
        <div class="flex flex-row">
            <!-- Kép, adatok sora -->
            <div class="grid grid-cols-2">
                <!-- Kép -->
                <div class="p-2">
                    <img :src="storage.url(props.moviePosterUrl)" :alt="props.movieTitle">
                </div>

                <!-- Adatok -->
                <div class="flex flex-col">
                    <h1 class="font-bold my-1 text-lg">{{ props.movieTitle }}</h1>
                    <component :is="AgeLimitIcons[props.movieAgeLimit]" class="w-8 h-8" />
                    <h2 class="my-2"><span class="bg-white p-1 px-2 rounded-full">{{ props.movieType }}</span></h2>
                </div>
            </div>
        </div>

        <div class="flex flex-row p-2">
            <button v-for="screening in onlyFourScreenings" class="bg-white text-lg font-semibold mx-1 rounded-lg p-2"> {{
                formatDate(screening.start_time).date }} <br> {{ formatDate(screening.start_time).time }}</button>
        </div>
    </div>
</template>



<script setup>
import { useScreeningStore } from '@stores/ScreeningStore.mjs';
import { useTicketStore } from '@stores/TicketStore';
import { ref, computed } from 'vue';
import { storage } from '@utils/http.mjs';

import ZeroPlus from '@assets/svg/ZeroPlus.vue';
import FourPlus from '@assets/svg/FourPlus.vue';
import SixPlus from '@assets/svg/SixPlus.vue';
import TwelvePlus from '@assets/svg/TwelvePlus.vue';
import SixteenPlus from '@assets/svg/SixteenPlus.vue';
import EighteenPlus from '@assets/svg/EighteenPlus.vue';

const screeningStore = useScreeningStore();
const ticketStore = useTicketStore();
const screening = ref(null);

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

function formatDate(dateString) {
  const d = new Date(dateString.replace(" ", "T")); // '2025-09-15T16:30:00'
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
    }
})
</script>