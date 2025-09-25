<template>
    <div v-if="!loading" class="max-w-4xl mx-auto my-8 px-4">
        <h1 class="text-center text-pink-600 font-bold text-3xl my-6">Film létrehozása</h1>

        <div class="bg-gradient-to-r from-indigo-500 via-purple-700 to-indigo-600 rounded-lg p-4">
            <div class="flex flex-col md:flex-row gap-4">

                <div class="w-full md:w-4/12 text-center">
                    <h2
                        class="text-center text-pink-600 text-xl bg-white inline-block rounded-lg p-2 font-semibold mb-2">
                        Poszter</h2>

                    <label class="block mb-2">
                        <input type="file" method="post" name="poster" ref="fileInput" enctype="multipart/form-data"
                            accept="image/png" @change="onFileChange"
                            class="block w-full text-sm text-gray-900 bg-white rounded-lg cursor-pointer" />
                    </label>

                    <img v-if="src" :src="src" alt="Image preview" class="h-80 rounded-xl mt-3 sm:w-64" />
                </div>

                <div class="w-full md:w-8/12 space-y-4">
                    <div class="flex flex-col sm:flex-row gap-3 text-center">
                        <div class="flex-1">
                            <label
                                class="inline-block text-pink-600 bg-white p-2 rounded-lg text-xl font-semibold mb-2">Cím</label>
                            <FormKit type="text" v-model="movieTitle"
                                input-class="w-full p-2 rounded-lg border-2 border-pink-300" />
                        </div>

                        <div class="lg:w-24 sm:w-28 text-center">
                            <label
                                class="inline-block text-xl text-pink-600 bg-white p-2 rounded-lg font-semibold mb-2">Hossz</label>
                            <FormKit type="number" v-model="movieDurationMin"
                                input-class="w-full p-2 rounded-lg border-2 border-pink-300" />
                        </div>
                    </div>

                    <div class="text-center">
                        <label
                            class="inline-block text-xl font-semibold bg-white p-2 rounded-lg text-pink-600 mb-2">Leírás</label>
                        <textarea v-model="movieDescription"
                            class="w-full rounded-lg p-3 border-2 border-pink-300 text-lg min-h-[120px]"
                            name="movieDescription" id="movieDescription"></textarea>
                    </div>

                    <div>
                        <label class="inline-block text-xl font-semibold text-pink-600 bg-white p-2 rounded-lg mb-2"
                            for="isPremier">Premier?</label>
                        <label class="text-lg text-white mx-1">
                            <input class="accent-pink-600" type="radio" v-model="isPremier" name="isPremier"
                                :value="true">
                            Igen
                        </label>
                        <label class="text-lg text-white mx-1">
                            <input class="accent-pink-600" type="radio" v-model="isPremier" name="isPremier"
                                :value="false" checked>
                            Nem
                        </label>
                    </div>

                </div>
            </div>

            <div class="mt-4 grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div class="text-center">
                    <h3
                        class="text-center text-pink-600 bg-white inline-block p-2 rounded-lg text-xl font-semibold mb-2">
                        Megjelenés</h3>
                    <input type="date" v-model="movieReleaseDate"
                        class="w-full text-pink-600 p-2 rounded-lg border-2 border-pink-300 text-lg" />
                </div>
                <div class="text-center">
                    <h3 class="text-pink-600 inline-block bg-white p-2 rounded-lg text-xl font-semibold mb-2">Műfaj</h3>
                    <select v-model="movieType" class="w-full p-2 text-pink-600 rounded-lg border-2 border-pink-300">
                        <option value="" disabled>Válassz műfajt</option>
                        <option value="Action">Akció</option>
                        <option value="Family">Családi</option>
                        <option value="Horror">Horror</option>
                    </select>
                </div>
                <div class="text-center">
                    <h3 class="text-pink-600 inline-block text-xl bg-white p-2 rounded-lg font-semibold mb-2">Korhatár
                    </h3>
                    <select v-model="ageLimit" class="w-full p-2 text-pink-600 rounded-lg border-2 border-pink-300">
                        <option value="" disabled>Válassz korhatárt</option>
                        <option value="0">0+</option>
                        <option value="4">4+</option>
                        <option value="6">6+</option>
                        <option value="12">12+</option>
                        <option value="16">16+</option>
                        <option value="18">18+</option>
                    </select>
                </div>

                <div class="text-center">
                    <h3 class="inline-block text-pink-600 bg-white p-2 rounded-lg text-xl font-semibold mb-2">Rendező
                    </h3>
                    <FormKit type="text" v-model="movieDirector"
                        input-class="w-full p-2 rounded-lg border-2 border-pink-300" />
                </div>
            </div>

            <div class="mt-4 text-center">
                <h3 class="inline-block text-2xl text-pink-600 bg-white p-2 rounded-lg font-semibold mb-2">Színészek
                </h3>
                <textarea v-model="movieActors"
                    class="w-full rounded-lg p-3 border-2 border-pink-300 text-lg min-h-[100px]" name="actors"
                    id="actors"></textarea>
            </div>

            <div class="mt-4 flex justify-end gap-3">
                <button type="button" @click="handleCreateMovie"
                    class="px-5 py-2 rounded-md bg-pink-600 font-bold text-white">Mentés</button>
            </div>
        </div>
    </div>
    <div v-else class="w-full my-24 h-full flex justify-center items-top mx-auto font-semibold text-white text-center">
        <p class="inline-flex">
            <BaseSpinner />
            <span class="pl-4 text-lg">Létrehozási adatok szinkronizációja folyamatban...</span>
        </p>
    </div>
</template>

<script setup>
import { ToastService } from '@stores/ToastService';
import { onMounted, ref, computed } from 'vue';
import { useUserStore } from '@stores/UserStore';
import { useRouter } from 'vue-router';
import { storage } from '@utils/http.mjs';
import BaseSpinner from './layout/BaseSpinner.vue';

import { FormKit } from '@formkit/vue';
import { useMovieStore } from '@stores/MovieStore.mjs';
const router = useRouter();

const userStore = useUserStore();
const movieStore = useMovieStore();

const movieTitle = ref('');
const movieDurationMin = ref(null);
const movieDescription = ref('');
const movieReleaseDate = ref(null);
const movieType = ref('');
const ageLimit = ref('');
const movieDirector = ref('');
const loading = ref(false);

const isPremier = ref(false);
const movieActors = ref('');
const actorsArray = computed(() => {
    if (!movieActors.value) return [];
    return movieActors.value
        .split(',')
});

const fileInput = ref(null);
const selectedFile = ref(null);
const fallbackImage = storage.url('/img/No_image_selected.png');
const src = ref(fallbackImage);

function onFileChange(e) {
    selectedFile.value = e.target.files[0];
    if (selectedFile.value) {
        src.value = URL.createObjectURL(selectedFile.value);
    } else {
        src.value = fallbackImage;
    }
}
const missingInputs = computed(() => {
    const missing = [];

    if (!movieTitle.value) missing.push("cím");
    if (!movieDurationMin.value) missing.push("hossz");
    if (!movieDescription.value) missing.push("leírás");
    if (!movieReleaseDate.value) missing.push("megjelenés");
    if (!movieType.value) missing.push("műfaj");
    if (!ageLimit.value) missing.push("korhatár besorolás");
    if (!movieDirector.value) missing.push("rendező");
    if (!movieActors.value) missing.push("színészek");

    return missing;
});

const handleCreateMovie = async () => {
    if (!selectedFile.value) {
        ToastService.showError("Nincs kép kiválasztva!")
        return;
    } else {
        src.value = URL.createObjectURL(selectedFile.value);
    }

    if (missingInputs.value.length > 0) {
        ToastService.showError(
            "Kérem töltse ki az alábbi mezőket: " + missingInputs.value.join(", ")
        );
        return;
    }

    const formData = new FormData();
    formData.append("title", movieTitle.value);
    formData.append("description", movieDescription.value);
    formData.append("type", movieType.value.toLowerCase());
    formData.append("director", movieDirector.value);
    formData.append("release_date", movieReleaseDate.value);
    formData.append("duration_min", movieDurationMin.value);
    formData.append("age_limit", Number(ageLimit.value));
    formData.append("is_premier", isPremier.value ? 1 : 0)

    actorsArray.value.forEach((actor, index) => {
        formData.append(`actors[${index}]`, actor);
    });

    const fileName = selectedFile.value.name;
    const extension = fileName.split('.').pop().toLowerCase();
    let posterUrl = '/img/' + movieType.value + '_Movies_img/' + normalizeString(movieTitle.value) + '.' + extension;
    formData.append("poster_url", posterUrl);


    try {
        await movieStore.createMovie(formData);
        ToastService.showSuccess("Film sikeresen létrehozva!")

        const posterFormData = new FormData();

        const normalizedFile = normalizeFile(selectedFile.value);
        posterFormData.append('poster', normalizedFile);
        posterFormData.append('type', movieType.value);

        await movieStore.uploadMoviePoster(posterFormData);

        clearOutInputs();
    } catch (err) {
        console.error("Error", err.response?.data || err);
        alert("Sikertelen film létrehozás!");
    }
};

function normalizeFile(file) {
    const ext = file.name.split('.').pop().toLowerCase();
    const baseName = file.name
        .split('.')
        .slice(0, -1)
        .join('.')
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .replace(/\s+/g, '_')
        .replace(/[^a-zA-Z0-9_-]/g, '');
    return new File([file], baseName + '.' + ext, { type: file.type });
}
function normalizeString(str) {
    return str
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .replace(/[^a-zA-Z0-9\s]/g, " ")
        .split(/\s+/)
        .filter(Boolean)
        .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
        .join("_");
}

function clearOutInputs() {
    movieTitle.value = "";
    movieDescription.value = "";
    movieType.value = "";
    movieDirector.value = "";
    movieReleaseDate.value = "";
    movieDurationMin.value = "";
    ageLimit.value = "";
    movieActors.value = "";
    actorsArray.value = [];
    selectedFile.value = null;
    isPremier.value = false;
    if (fileInput.value) {
        fileInput.value.value = "";
    }
    src.value = fallbackImage;
}

onMounted(async () => {
    loading.value = true;
    try {
        await userStore.getUser();
        if (!userStore.isAdmin) {
            router.replace("/");
        };
    } catch (error) {
        ToastService.showError('Hiba történt a betöltés közben, próbálja újra később!');
    } finally {
        loading.value = false;
    }
})
</script>