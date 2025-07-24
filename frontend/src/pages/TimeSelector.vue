<template>
    <BaseLayout>
        <Stepper :currentStep="2" />
        <Calendar :screenings="screenings" @select-screening="onScreeningSelect" />
        <div class="w-full flex justify-end align-middle items-center">
            <button @click="handleButton"
                class="text-pink-700 mx-auto w-1/5 text-xl bg-white border-2 px-6 font-semibold py-3 my-4 border-pink-700 transition-all duration-300 hover:bg-slate-400 hover:text-white rounded-lg">
                Tovább
            </button>
        </div>
    </BaseLayout>
</template>

<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';
import Stepper from '@components/layout/Stepper.vue';
import { useTicketStore } from '@stores/TicketStore';
import { useScreeningStore } from '@stores/ScreeningStore.mjs';
import { onMounted, ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import Calendar from './Calendar.vue';

const ticketStore = useTicketStore();
const screeningStore = useScreeningStore();
const router = useRouter();

const screenings = ref([]);
const selectedScreeningId = ref('');

onMounted(async () => {
    await screeningStore.getScreenings();
    screenings.value = screeningStore.screenings.data;
});

const filteredScreenings = computed(() => {
    if (!ticketStore.location?.id || !ticketStore.movie?.id) return [];
    return screenings.value.filter(s =>
        Number(s.drive_in_cinema_id) === Number(ticketStore.location.id) &&
        Number(s.movie_id) === Number(ticketStore.movie.id)
    );
});

function onScreeningSelect(id) {
    selectedScreeningId.value = id;
}
function handleButton() {
    // csak debug
    console.log('filteredScreenings:', JSON.stringify(filteredScreenings.value));
    console.log('selectedScreeningId:', selectedScreeningId.value, typeof selectedScreeningId.value);
    // csak debug

    const selectedScreening = filteredScreenings.value.find(
      s => String(s.id) === String(selectedScreeningId.value)
    );
    if (!selectedScreeningId.value) {
      alert('Válassz egy időpontot!');
      return;
    }
    if (!selectedScreening) {
      alert('Hibás vagy nem létező vetítési időpont!');
      return;
    }
    ticketStore.setTime(selectedScreening);
    router.push('/ParkingSpotChooser');
}
</script>