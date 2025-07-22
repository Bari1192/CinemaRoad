<template>
    <BaseLayout>
        <Stepper :currentStep="2" />

        <!-- Csekk, hogy elmentette-e a helyet és filmet! -->
        <h1 v-if="!ticketStore.location">Hely: <span class="text-4xl text-red-500">NINCS KIVÁLASZTVA</span></h1>
        <h1 v-else>Hely: <span class="text-4xl text-green-500">KI VAN VÁLASZTVA</span></h1>
        <h1 v-if="ticketStore.locationName">Hely neve:
            <span class="text-4xl text-green-500">{{ ticketStore.locationName }}</span>
        </h1>

        <h1 v-if="!ticketStore.movie">Film: <span class="text-4xl text-red-500">NINCS KIVÁLASZTVA</span></h1>
        <h1 v-else>Film: <span class="text-4xl text-green-500">KI VAN VÁLASZTVA</span></h1>
        <h1 v-if="ticketStore.movie">Film neve:
            <span class="text-4xl text-green-500">{{ ticketStore.movie.title }}</span>
        </h1>

        <select v-model="selectedScreeningId" class="border p-2 rounded">
            <option disabled value="">Válassz időpontot</option>
            <option v-for="s in filteredScreenings" :key="s.id" :value="s.id">
                {{ formatDate(s.start_time) }}
            </option>
        </select>

        <button @click="handleButton">
            <a href="ParkingSpotChooser">Tovább</a>
        </button>



    </BaseLayout>
</template>

<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';
import Stepper from '@components/layout/Stepper.vue';

import { useTicketStore } from '@stores/TicketStore';
import { useScreeningStore } from '@stores/ScreeningStore.mjs';
import { onMounted, ref, computed } from 'vue';

const ticketStore = useTicketStore();
const screeningStore = useScreeningStore();

const screenings = ref([]);
const selectedScreeningId = ref('');

const filteredScreenings = computed(() => {
    if (!ticketStore.location?.id || !ticketStore.movie?.id) return [];
    return screenings.value.filter(s =>
        Number(s.drive_in_cinema_id) === Number(ticketStore.location.id) &&
        Number(s.movie_id) === Number(ticketStore.movie.id)
    );
});

function formatDate(dateStr) {
    const d = new Date(dateStr);
    return d.toLocaleString();
}

function handleButton() {
    if (!selectedScreeningId.value) {
        alert('Válassz egy időpontot!');
        return;
    }

    const selectedScreening = filteredScreenings.value.find(s => s.id === selectedScreeningId.value);
    if (!selectedScreening) {
        alert('Hiba történt a vetítés kiválasztásakor.');
        return;
    }

    ticketStore.setTime(selectedScreening);
}


onMounted(async () => {
    await screeningStore.getScreenings();
    screenings.value = screeningStore.screenings.data;
});


</script>