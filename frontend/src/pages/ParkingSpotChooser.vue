<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';
import { useRouter } from 'vue-router';
import { useTicketStore } from '@stores/TicketStore.js';
import Stepper from '@components/layout/Stepper.vue';

const ticketStore = useTicketStore();
const router = useRouter();

if (!ticketStore.location && localStorage.getItem('location')) {
    ticketStore.location = JSON.parse(localStorage.getItem('location'));
}
if (!ticketStore.locationName && localStorage.getItem('locationName')) {
    ticketStore.locationName = JSON.parse(localStorage.getItem('locationName'));
}
if (!ticketStore.movie && localStorage.getItem('movie')) {
    ticketStore.movie = JSON.parse(localStorage.getItem('movie'));
}
if (!ticketStore.time && localStorage.getItem('time')) {
    ticketStore.time = JSON.parse(localStorage.getItem('time'));
}
if (!ticketStore.parkingSpot && localStorage.getItem('parkingSpot')) {
    ticketStore.parkingSpot = JSON.parse(localStorage.getItem('parkingSpot'));
}


function handleSelect(spot) {
    ticketStore.setParkingSpot(spot);
    router.push('/Summary');
}

const [selected_date, selected_time] = ticketStore.time.split(' ');
const selectedStartTime = selected_time.slice(0, 5);
</script>


<template>
    <BaseLayout>
        <Stepper :currentStep="3" />


        <!-- Hely csekk -->
        <div class="w-full mx-auto flex flex-col justify-center align-middle items-center m-auto text-2xl mb-4"
            v-if="ticketStore.location != null">Hely: <span class="text-4xl text-green-500">{{ ticketStore.locationName
            }}</span></div>

        <div class="w-full mx-auto flex flex-col justify-center align-middle items-center m-auto text-2xl mb-4"
            v-if="ticketStore.movie != null">Film: <span class="text-4xl text-green-500">{{ ticketStore.movie.title
            }}</span></div>

        <div class="w-full mx-auto flex flex-col justify-center align-middle items-center m-auto text-2xl mb-4"
            v-if="ticketStore.time != null">Vetítés napja: <span class="text-green-500">{{
                selected_date
            }}</span></div>
        <div class="w-full mx-auto flex flex-col justify-center align-middle items-center m-auto text-2xl mb-4"
            v-if="ticketStore.time != null">Vetítés időpontja: <span class="text-4xl text-green-500 text-center">{{
                selectedStartTime
            }}</span></div>



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
