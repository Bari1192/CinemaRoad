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


</BaseLayout>
</template>

<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';
import Stepper from '@components/layout/Stepper.vue';

import { useTicketStore } from '@stores/TicketStore';

const ticketStore = useTicketStore();

</script>