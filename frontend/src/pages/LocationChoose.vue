<template>
    <BaseLayout>
        <div class="relative max-w-md my-40 mx-auto group inline-black">

            <div
            class="absolute inset-0 rounded-2xl bg-indigo-300/70 blur-2xl opacity-0 group-hover:opacity-60 transition-opacity duration-300 -z-10">            </div>

            <div v-for="cinema in driveincinemaStore.driveInCinemas" :key="cinema.id">
                <BaseCard :title="cinema.name" :type="'null'" :src="'/starfield_autosmozi.jpg'" :alt="'asd'"
                    :description="''" class="max-w-md my-40" />
            </div>
        </div>

    </BaseLayout>
</template>

<script setup>
import { useDriveInCinemaStore } from '@stores/DriveInCinemaStore.mjs';
import { onMounted, ref } from 'vue';
import BaseLayout from '@layouts/BaseLayout.vue';
import BaseCard from '@components/layout/BaseCard.vue';

const driveincinemaStore = useDriveInCinemaStore();
const response = ref(null);

onMounted(async () => {
    response.value = driveincinemaStore.getDriveInCinemas();
    console.log("cinemas: ", response.value)
})
</script>