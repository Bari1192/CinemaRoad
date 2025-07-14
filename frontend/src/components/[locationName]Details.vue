<template>
    <div v-if="cinema" class="max-w-10xl mx-auto p-5">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
            <img
                src="/starfield_autosmozi.jpg"
                alt="Helyszín képe"
                class="rounded-xl shadow-md max-h-80 object-cover md:w-1/2"
            />

            <div class="flex flex-col space-y-4 md:w-1/2 md:mt-10">
                <h1 class="text-3xl font-bold text-pink-600">
                    {{ cinema.name }}
                </h1>
                <p class="text-base text-pink-700 text-justify md:mt-5">
                    {{ cinema.description }}
                </p>
            </div>
        </div>
    </div>

    <div v-else>
        <BaseSpinner class="mx-auto mt-10" />
    </div>
</template>


<script setup>
import { useDriveInCinemaStore } from '@stores/DriveInCinemaStore.js';
import BaseSpinner from '@components/layout/BaseSpinner.vue';

import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';

const cinema = ref(null);
const route = useRoute();

function slugify(text) {
    return text
    .toLowerCase()
    .replace(/á/g, 'a')
    .replace(/é/g, 'e')
    .replace(/í/g, 'i')
    .replace(/ó|ö|ő/g, 'o')
    .replace(/ú|ü|ű/g, 'u')
    .replace(/\s+/g, '-')
    .replace(/[^\w\-]+/g, '')
    .replace(/\-\-+/g, '-')
    .replace(/^-+/, '')
    .replace(/-+$/, '');
}

onMounted( async() => {
    const driveInCinemaStore = useDriveInCinemaStore();
    await driveInCinemaStore.getDriveInCinemas();
    
    cinema.value = driveInCinemaStore.driveInCinemas.find(c =>
        slugify(c.name) === route.params.locationName.toLowerCase()
    );
});

</script>
