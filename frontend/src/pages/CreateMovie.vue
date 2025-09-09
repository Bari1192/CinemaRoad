    <template>
        <BaseLayout>
            <div class="max-w-4xl mx-auto my-8 px-4">
                <h1 class="text-center text-pink-600 font-bold text-3xl my-6">Film létrehozása</h1>

                <div class="bg-gray-300 rounded-lg p-4">
                    <div class="flex flex-col md:flex-row gap-4">

                        <!-- Poszter -->
                        <div class="w-full md:w-4/12">
                            <h2 class="text-center text-pink-600 text-2xl font-semibold mb-2">Poszter</h2>

                            <label class="block mb-2">
                                <input type="file" method="post" name="poster" enctype="multipart/form-data"
                                    accept="image/png" @change="onFileChange"
                                    class="block w-full text-sm text-gray-900 bg-white rounded-lg cursor-pointer" />
                            </label>

                            <img v-if="src" :src="src" alt="Image preview"
                                class="shadow-md h-80 rounded-xl mt-3 sm:w-64" />
                        </div>

                        <div class="w-full md:w-8/12 space-y-4">
                            <!-- Cím és Hossz -->
                            <div class="flex flex-col sm:flex-row gap-3 items-center">
                                <div class="flex-1">
                                    <label class="block text-pink-600 text-xl font-semibold mb-2">Cím</label>
                                    <FormKit type="text" v-model="movieTitle"
                                        input-class="w-full p-2 rounded-lg border-2 border-pink-300" />
                                </div>

                                <div class="w-24 sm:w-28">
                                    <label class="block text-xl text-pink-600 font-semibold mb-2 text-center">Hossz (perc)</label>
                                    <FormKit type="number" v-model="movieDurationMin"
                                        input-class="w-full p-2 rounded-lg border-2 border-pink-300 text-center" />
                                </div>
                            </div>

                            <div>
                                <label class="block text-xl font-semibold text-pink-600 mb-2">Leírás</label>
                                <textarea v-model="movieDescription"
                                    class="w-full rounded-lg p-3 border-2 border-pink-300 text-lg min-h-[120px]"
                                    name="movieDescription" id="movieDescription"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Műfaj / Rendező -->
                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">

                        <div>
                            <h3 class="text-center text-pink-600 text-xl font-semibold mb-2">Megjelenés</h3>
                            <input type="date" v-model="movieReleaseDate"
                                class="w-full text-pink-600 p-2 rounded-lg border-2 border-pink-300 text-lg" />
                        </div>

                        <div>
                            <h3 class="text-center text-pink-600 text-xl font-semibold mb-2">Műfaj</h3>
                            <select v-model="movieType" class="w-full p-2 text-pink-600 rounded-lg border-2 border-pink-300">
                                <option value="">Válassz műfajt</option>
                                <option value="Action">Akció</option>
                                <option value="Family">Családi</option>
                                <option value="Horror">Horror</option>
                            </select>
                        </div>

                        <div>
                            <h3 class="text-center text-pink-600 text-xl font-semibold mb-2">Rendező</h3>
                            <FormKit type="text" v-model="movieDirector"
                                input-class="w-full p-2 rounded-lg border-2 border-pink-300" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <h3 class="text-center text-2xl text-pink-600 font-semibold mb-2">Színészek</h3>
                        <textarea v-model="movieActors"
                            class="w-full rounded-lg p-3 border-2 border-pink-300 text-lg min-h-[100px]" name="actors"
                            id="actors"></textarea>
                    </div>

                    <div class="mt-4 flex justify-end gap-3">
                        <button type="button" @click="handleCreateMovie"
                            class="px-5 py-2 rounded-md bg-pink-600 text-white">Mentés</button>
                    </div>
                </div>
            </div>
        </BaseLayout>
    </template>


<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';
import { ToastService } from '@stores/ToastService';
import { onMounted, ref } from 'vue';
import { useUserStore } from '@stores/UserStore';
import { useRouter } from 'vue-router';

import { http } from '@utils/http.mjs';
import { FormKit } from '@formkit/vue';
const router = useRouter();

const userStore = useUserStore();

const movieTitle = ref('');
const movieDurationMin = ref(null);
const movieDescription = ref('');
const movieReleaseDate = ref(null);
const movieType = ref('');
const movieDirector = ref('');
const movieActors = ref('');
const actorsArray = movieActors.value.split(',').map(actor => actor.trim());

const selectedFile = ref(null);

const fallbackImage = new URL('@/assets/img/No_image_selected.png', import.meta.url).href;
const src = ref(fallbackImage);

function onFileChange(e) {
    selectedFile.value = e.target.files[0];
    if(selectedFile.value) {
        src.value = URL.createObjectURL(selectedFile.value);
    } else {
        src.value = fallbackImage;
    }
}

const handleCreateMovie = async () => {
    if (!selectedFile.value) {
        alert("No file selected");
        return;
    } else {
        src.value = fallbackImage;
    }

    const formData = new FormData();
    formData.append("title", movieTitle.value);
    formData.append("description", movieDescription.value);
    formData.append("type", movieType.value);
    formData.append("director", movieDirector.value);
    formData.append("release_date", movieReleaseDate.value);
    formData.append("duration_min", movieDurationMin.value);

    formData.append('actors', actorsArray);

    // poster_url név létrehozása
    const fileName = selectedFile.value.name;
    const extension = fileName.split('.').pop().toLowerCase();
    let posterUrl = '/' + movieType.value + '_Movies_img/' + normalizeString(movieTitle.value) + '.' + extension;
    formData.append("poster_url", posterUrl);


    try {
        // Filmfeltöltés!
        const token = sessionStorage.getItem("token");

        const response = await http.post("/movies", formData, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        });
        console.log("Success", response.data);
        alert("Film sikeresen létrehozva!");

        // Képfeltöltés!! plusz a film típus fájlnév miatt
        const posterFormData = new FormData();
        const sanitizedFile = sanitizeFile(selectedFile.value);
        posterFormData.append('poster', sanitizedFile);
        posterFormData.append('type', movieType.value);
        console.log("posterFormData poster: ", posterFormData.get('poster'))

        const posterResponse = await http.post("/movies/upload-poster", posterFormData, {
            headers: {
                'Content-Type': 'multipart/form-data',
                Authorization: `Bearer ${token}`
            }
        });
        console.log("Poster upload successful", posterResponse.data);

    } catch (err) {
        console.error("Error", err.response?.data || err);
        alert("Sikertelen film létrehozás!");
    }
};

function sanitizeFile(file) {
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
    let normalized = str.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
    normalized = normalized.replace(/\s+/g, '_'); return normalized;
}

onMounted(async () => {
    await userStore.getUser();
    if (!userStore.isAdmin) {
        router.replace("/");
    };
})
</script>