<script setup>
import { useTicketStore } from '@stores/TicketStore.js';
import Stepper from '@components/layout/Stepper.vue';
import BaseSeats from './BaseSeats.vue';
import BaseHeader from '@components/layout/BaseHeader.vue';
import BaseFooter from '@components/layout/BaseFooter.vue';

const ticketStore = useTicketStore();

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
</script>

<template>
    <BaseHeader />
    
    <Stepper :currentStep="4" />
    <h1 class="text-4xl text-center font-bold">{{ ticketStore.locationName }}: {{ ticketStore.movie.title }}</h1>
    <div class="w-full h-full px-4 mx-auto ">
        <BaseSeats />
    </div>
    
    <BaseFooter />

</template>
