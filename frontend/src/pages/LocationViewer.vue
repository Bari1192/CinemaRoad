<template>
    <BaseLayout>
        <h1 class="text-5xl font-bold mt-20 text-center">Melyik helyszínt szeretnéd megtekinteni?</h1>

        <div class="grid grid-row justify-center my-20">
            <div class="grid grid-cols-3 gap-5">
                <div v-for="cinema in driveInCinemaStore.driveInCinemas" :key="cinema.id"
                    @click="navigateToCinemaSite(cinema.name)" class="relative group cursor-pointer rounded-2xl">

                    <div
                        class="absolute inset-0 rounded-2xl bg-indigo-300/70 blur-2xl opacity-0 group-hover:opacity-60 transition-opacity duration-300 -z-10">
                    </div>

                    <div>
                        <BaseCard :title="cinema.name" :displayLocationName="true" :locationName="cinema.location"
                            :button_text="'Mozi megtekintése'" :src="storage.url(`/img/${cinema.name}.jpg`)"
                            :alt="cinema.name" :description="''" :type_visible="false"
                            class="max-w-xs md:max-w-md mx-auto" />
                    </div>
                </div>
            </div>
        </div>
    </BaseLayout>
</template>

<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';
import BaseCard from '@components/BaseCard.vue';
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useDriveInCinemaStore } from '@stores/DriveInCinemaStore';
import { storage } from '@utils/http.mjs';

const driveInCinemaStore = useDriveInCinemaStore();

const router = useRouter();

const navigateToCinemaSite = (cinemaName) => {
    const slugName = slugify(cinemaName);
    router.push(`/${slugName}`)
};

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

onMounted(async () => {
    await driveInCinemaStore.getDriveInCinemas();
});


</script>