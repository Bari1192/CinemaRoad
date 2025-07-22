<template>
    <BaseLayout>
        <Stepper :currentStep="0" />
        <h1 class="text-3xl mt-40">Kérlek, válaszd ki a helyszínt, ahova menni szeretnél.</h1>

        <div class="relative max-w-md my-40 mx-auto group inline-black">
            <div
                class="absolute inset-0 rounded-2xl bg-indigo-300/70 blur-2xl opacity-0 group-hover:opacity-60 transition-opacity duration-300 -z-10">
            </div>

            <div v-for="cinema in driveincinemaStore.driveInCinemas" :key="cinema.id" @click="selectCinema(cinema)">
                <BaseCardNavigate :title="cinema.name" :src="'/starfield_autosmozi.jpg'" :alt="cinema.name"
                    :description="''" class="max-w-xs md:max-w-md my-40 mx-auto" />
            </div>
        </div>
    </BaseLayout>
</template>

<script setup>
import { useDriveInCinemaStore } from '@stores/DriveInCinemaStore.mjs';
import { useTicketStore } from '@stores/TicketStore.js';
import { useRouter } from 'vue-router';
import { onMounted, ref } from 'vue';

import BaseLayout from '@layouts/BaseLayout.vue';
import BaseCardNavigate from '@components/layout/BaseCardNavigate.vue';
import Stepper from '@components/layout/Stepper.vue';

const driveincinemaStore = useDriveInCinemaStore();
const ticketStore = useTicketStore();
const router = useRouter();

const response = ref(null);

function selectCinema(cinema) {
    ticketStore.setLocation(cinema);
    ticketStore.setLocationName(cinema.name);
    router.push('/Selector');
}

onMounted(() => {
    response.value = driveincinemaStore.getDriveInCinemas();
});
</script>