<template>
    <BaseLayout>
        <!-- Hely csekk -->
        <h1 v-if="!ticketStore.location">Hely: <span class="text-4xl text-red-500">NINCS KIVÁLASZTVA</span></h1>
        <h1 v-else>Hely: <span class="text-4xl text-green-500">KI VAN VÁLASZTVA</span></h1>

        <!-- Film csekk-->
        <h1 v-if="!ticketStore.movie">Film: <span class="text-4xl text-red-500">NINCS KIVÁLASZTVA</span></h1>
        <h1 v-else>Film: <span class="text-4xl text-green-500">KI VAN VÁLASZTVA</span></h1>

        <!-- Időpont csekk-->
        <h1 v-if="!ticketStore.time">Időpont: <span class="text-4xl text-red-500">NINCS KIVÁLASZTVA</span></h1>
        <h1 v-else>Időpont: <span class="text-4xl text-green-500">KI VAN VÁLASZTVA</span></h1>


        <div class="flex gap-4">
            <button class="p-4 rounded-lg"
                :class="ticketStore.parkingSpot === 'A1' ? 'bg-pink-600 text-white' : 'bg-gray-200 font-semibold'"
                @click="handleSelect('A1')">
                A1
            </button>

            <button class="p-4 rounded-lg"
                :class="ticketStore.parkingSpot === 'A2' ? 'bg-pink-600 text-white' : 'bg-gray-200 font-semibold'"
                @click="handleSelect('A2')">
                A2
            </button>

            <button class="p-4 rounded-lg"
                :class="ticketStore.parkingSpot === 'A3' ? 'bg-pink-600 text-white' : 'bg-gray-200 font-semibold'"
                @click="handleSelect('A3')">
                A3
            </button>
        </div>
    </BaseLayout>

</template>

<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';
import { useRouter } from 'vue-router';
import { useTicketStore } from '@stores/TicketStore.js';

const ticketStore = useTicketStore();
const router = useRouter();

function handleSelect(spot) {
  ticketStore.setParkingSpot(spot);
  router.push('/Summary');
}
</script>