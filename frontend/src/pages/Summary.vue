<template>
    <BaseLayout>
        <!-- Hely csekk.  ticketStore => location -->
        <div v-if="!ticketStore.location">
            <h1 class="text-3xl">Hely: <span class="text-4xl text-red-500">NINCS KIVÁLASZTVA</span></h1>
        </div>
        <div v-else class="p-3">
            <h1 class="text-3xl">Hely: <span class="text-3xl rounded-lg text-green-500">KI VAN VÁLASZTVA</span></h1>
            <p>{{ ticketStore.location }}</p>
        </div>

        <!-- Film csekk.  ticketStore => movie-->
        <div v-if="!ticketStore.movie">
            <h1 class="text-3xl">Film: <span class="text-4xl text-red-500">NINCS KIVÁLASZTVA</span></h1>
        </div>
        <div v-else class="p-3">
            <h1 class="text-3xl">Film: <span class="text-3xl rounded-lg text-green-500">KI VAN VÁLASZTVA</span></h1>
            <p>{{ ticketStore.movie }}</p>
        </div>

        <!-- Időpont csekk. ticketStore => time -->
        <div v-if="!ticketStore.time">
            <h1 class="text-3xl">Időpont: <span class="text-4xl text-red-500">NINCS KIVÁLASZTVA</span></h1>
        </div>
        <div v-else class="p-3">
            <h1 class="text-3xl">Időpont: <span class="text-4xl text-green-500">KI VAN VÁLASZTVA</span></h1>
            <p>{{ ticketStore.time }}</p>
        </div>

        <!-- Parkolóhely csekk.  ticketStore => parkingSpot-->
        <div v-if="!ticketStore.time">
            <h1 class="text-3xl">Parkolóhely: <span class="text-4xl text-red-500">NINCS KIVÁLASZTVA</span></h1>
        </div>
        <div v-else class="p-3">
            <h1 class="text-3xl">Parkolóhely: <span class="text-4xl text-green-500">KI VAN VÁLASZTVA</span></h1>
            <p>{{ ticketStore.parkingSpot }}</p>
        </div>



    </BaseLayout>
</template>

<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';
import { useTicketStore } from '@stores/TicketStore';

const ticketStore = useTicketStore();
</script>