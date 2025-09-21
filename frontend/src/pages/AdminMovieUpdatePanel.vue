<script setup>
import { ref, onMounted } from 'vue'
import { useMovieStore } from '@stores/MovieStore.mjs'
import { ToastService } from '@stores/ToastService'
import { useUserStore } from '@stores/UserStore'
import { toast } from 'vue3-toastify';
import { storage } from '@utils/http.mjs';
import BaseSpinner from '@components/layout/BaseSpinner.vue';

const userStore = useUserStore();
const movieStore = useMovieStore()
const editableMovies = ref([])
const loading = ref(false);

onMounted(async () => {
    loading.value = true;
    try {
        await userStore.getUser();
        if (!userStore.isAdmin) {
            router.replace("/");
        };
        await movieStore.getMovies()
        editableMovies.value = [...movieStore.movies]
    } catch (error) {
        ToastService.showError('Hiba történt a betöltés közben. Próbálja újra később!');
    }
    finally {
        loading.value = false;
    }
})
const formatDate = (d) => {
    if (!d) return null;
    if (d instanceof Date) return d.toISOString().slice(0, 10);
    return String(d).split('T')[0];
};

const saveEdit = async (movie) => {
    const confirmed = await ToastService.showConfirm('Módosítások mentése', 'Biztosan menteni szeretnéd a módosításokat?', 'Mentés', 'Mégse');
    if (!confirmed) return; if (!confirmed) return;

    const movieData = {
        title: movie.title,
        description: movie.description,
        type: movie.type,
        age_limit: movie.age_limit,
        release_date: formatDate(movie.release_date),
        director: movie.director,
        duration_min: Number(movie.duration_min),
        poster_url: movie.poster_url,
        is_premier: movie.is_premier
    }
    try {
        await movieStore.updateMovie(movie.id, movieData);
        ToastService.showSuccess(`'${movie.title}' sikeresen módosításra került!`);
        await movieStore.getMovies();
        editableMovies.value = [...movieStore.movies];
    } catch (e) {
        console.error("Update error:", e.response?.data ?? e);
        ToastService.showError('Mentési hiba!');
    }
}

const deleteMovie = async (movie) => {
    const confirmed = await ToastService.showConfirm('Film törlése', `Biztosan törölni szeretnéd a "${movie.title}" filmet?`, 'Törlés', 'Mégse');
    if (confirmed) {
        try {
            await movieStore.deleteMovie(movie.id)
            ToastService.showSuccess('Film törölve!')
            await movieStore.getMovies()
            editableMovies.value = [...movieStore.movies]
        } catch (e) {
            ToastService.showError('Törlési hiba!')
        }
    }
}
</script>

<template>
    <div v-if="!loading" class="w-full mx-auto my-4 px-2 sm:px-4 lg:px-8">
        <div class="w-full sm:w-2/3 lg:w-1/3 mb-6 sm:mb-8 mt-6 sm:mt-12 mx-auto block relative">
            <div class="absolute inset-0 bg-purple-400 blur-2xl -z-10"></div>
            <h1
                class="text-lg sm:text-xl lg:text-3xl font-extrabold text-center text-pink-50 tracking-wider py-2 sm:py-3 mb-4 sm:mb-6 relative z-10">
                Mozifilmek Módosítása
            </h1>
        </div>

        <div class="space-y-4 lg:hidden">
            <div v-for="(movie, idx) in editableMovies" :key="movie.id"
                class="bg-gradient-to-r from-indigo-400 via-purple-600 to-indigo-500 p-4 sm:p-6 rounded-lg shadow-lg">

                <div class="flex items-center justify-center space-x-3 sm:space-x-4 mb-4">
                    <img :src="storage.url(`${movie.poster_url}`)"
                        class="w-12 h-12 sm:w-16 sm:h-16 md:w-20 md:h-20 object-cover rounded" />
                    <div class="flex-1">
                        <label class="block text-base font-medium text-pink-100 mb-1">Film neve:</label>
                        <input v-model="movie.title"
                            class="w-full p-2 sm:px-3 text-sm sm:text-base border border-gray-300 rounded text-black" />
                    </div>
                    <div class="md:flex md:mt-6 space-x-2 space-y-1 md:space-y-0 mx-auto align-middle">
                        <label
                            class="block mb-1 md:mb-0 text-base font-medium md:bg-indigo-900/75 md:border-yellow-400 md:border-2 md:py-3 md:px-2 rounded-md text-pink-100">Korhatár
                            besorolás:</label>
                        <input v-model="movie.age_limit" type="number"
                            class="w-full max-w-[95px] md:max-w-[75px] flex justify-center md:bg-gray-200 bg-black/45 mx-auto text-center py-1.5 h-fit md:py-2 font-semibold text-base md:text-lg xl:px-3 border border-gray-300 rounded"
                            :class="movie.age_limit == 18 ? 'text-red-400 md:text-red-600' : 'text-amber-500'" />
                    </div>
                </div>



                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 mb-4">
                    <div>
                        <label class="block text-base font-medium text-pink-100 mb-1">
                            Típus:
                        </label>
                        <select v-model="movie.type"
                            class="w-full py-2 px-2 sm:px-3 text-sm sm:text-base border border-gray-300 rounded text-black">
                            <option value="family">Családi film</option>
                            <option value="action">Akciófilm</option>
                            <option value="horror">Horrorfilm</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-base font-medium text-pink-100 mb-1">Megjelenés:</label>
                        <input v-model="movie.release_date" type="date"
                            class="w-full py-2 px-2 sm:px-3 text-sm sm:text-base border border-gray-300 rounded text-black" />
                    </div>
                    <div>
                        <label class="block text-base font-medium text-pink-100 mb-1">Rendező:</label>
                        <input v-model="movie.director"
                            class="w-full py-2 px-2 sm:px-3 text-sm sm:text-base border border-gray-300 rounded text-black" />
                    </div>

                    <div class="grid grid-cols-3 items-center gap-0 pt-5 w-full h-full justify-center align-middle">
                        <div class="col-span-2 justify-center mx-auto">
                            <label class="w-full text-[18px] font-medium text-white underline underline-offset-4"
                                for="isPremier">
                                Premier bemutató lesz?
                            </label>
                        </div>
                        <div class="col-span-1 flex justify-center">
                            <select v-model.number="movie.is_premier" name="isPremier"
                                class="w-fit py-1 px-2 font-semibold rounded border-2 border-black/65"
                                :class="movie.is_premier ? 'text-lime-600' : 'text-red-600'">
                                <option :value="0" class="text-red-600 font-semibold text-base">Nem</option>
                                <option :value="1" class="text-lime-600 font-semibold text-base">Igen</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 sm:gap-4">
                    <button @click="saveEdit(movie)"
                        class="flex-1 bg-green-500 w-2/3 border-2 border-indigo-500/55 mx-auto text-white font-semibold py-2 px-4 text-sm sm:text-base rounded-lg hover:bg-green-500/80 transition-colors duration-200">
                        Mentés
                    </button>
                    <button @click="deleteMovie(movie)" class="flex-1 bg-red-500 w-2/3 mx-auto text-white font-semibold py-2 px-4 text-sm sm:text-base border-2 border-indigo-700/55 
                            rounded-lg hover:bg-red-500/80 transition-colors duration-200">
                        Törlés
                    </button>
                </div>
            </div>
        </div>

        <div
            class="hidden lg:block overflow-x-auto rounded-lg shadow mb-10 bg-gradient-to-r from-indigo-400 to-indigo-500">
            <table class="w-full bg-gradient-to-r from-indigo-400 via-purple-600 to-indigo-500">
                <thead>
                    <tr
                        class="bg-gradient-to-r from-indigo-50/20 via-pink-100 to-indigo-100/30 border-b-4 border-b-pink-700 text-pink-800">
                        <th class="py-4 px-3 text-center rounded-tl-lg font-bold text-sm lg:text-lg">Film posztere</th>
                        <th class="py-4 px-3 text-center font-bold text-sm lg:text-lg">Film neve</th>
                        <th class="py-4 px-3 text-center font-bold text-sm lg:text-lg">Film típusa</th>
                        <th class="py-4 px-3 text-center font-bold text-sm lg:text-lg">Korhatár</th>
                        <th class="py-4 px-3 text-center font-bold text-sm lg:text-lg">Megjelenés</th>
                        <th class="py-4 px-3 text-center font-bold text-sm lg:text-lg">Rendező</th>
                        <th class="py-4 px-3 text-center font-bold text-sm lg:text-lg">Premier</th>
                        <th class="py-4 px-3 text-center rounded-tr-lg font-bold text-sm lg:text-lg">Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(movie, idx) in editableMovies" :key="movie.id" class="text-white md:font-semibold border-b border-white/20
                    cursor-pointer">
                        <td class="w-fit">
                            <div class="flex justify-center w-fit">
                                <img :src="storage.url(`${movie.poster_url}`)" :alt="movie.title"
                                    class="min-w-[50px] md:min-w-[80px] lg:w-40 lg:h-40 object-cover rounded" />
                            </div>
                        </td>
                        <td class="py-3 px-2">
                            <input v-model="movie.title"
                                class="w-full py-2 px-2 xl:px-3 text-sm xl:text-base border border-gray-300 rounded text-black" />
                        </td>
                        <td class="py-3 px-2">
                            <select v-model="movie.type"
                                class="w-full py-2 px-2 xl:px-3 text-sm xl:text-base border border-gray-300 rounded text-black">
                                <option value="family">Családi film</option>
                                <option value="action">Akciófilm</option>
                                <option value="horror">Horrorfilm</option>
                            </select>
                        </td>

                        <td class="py-3 px-2">
                            <select class="text-pink-600 p-2 rounded flex mx-auto" v-model="movie.age_limit"
                                name="ageLimit" id="ageLimit">
                                <option class="text-pink-600" value="0">0+</option>
                                <option class="text-pink-600" value="4">4+</option>
                                <option class="text-pink-600" value="6">6+</option>
                                <option class="text-pink-600" value="12">12+</option>
                                <option class="text-pink-600" value="16">16+</option>
                                <option class="text-pink-600" value="18">18+</option>
                            </select>
                        </td class="py-3 px-2">

                        <td class="py-3 px-2">
                            <input v-model="movie.release_date" type="date"
                                class="w-full py-2 px-2 xl:px-3 text-sm xl:text-base border border-gray-300 rounded text-black" />
                        </td>
                        <td class="py-3 px-2">
                            <input v-model="movie.director"
                                class="w-full py-2 px-2 xl:px-3 text-sm xl:text-base border border-gray-300 rounded text-black" />
                        </td>
                        <td class="py-3 px-2 flex justify-center items-center my-16 h-full">
                            <input type="checkbox" :true-value="1" :false-calue="0" v-model="movie.is_premier"
                                class="inline-block min-h-5 min-w-6 accent-pink-600" />
                        </td>
                        <td class="p-2">
                            <div class=" flex justify-center flex-col lg:flex-row gap-1 lg:gap-4">
                                <button @click="saveEdit(movie)"
                                    class="bg-lime-500/80 text-gray-200 tracking-wider font-semibold px-2 xl:px-4 py-1 text-xs lg:text-base rounded hover:bg-green-500/80 transition-colors duration-200">
                                    Mentés
                                </button>
                                <span
                                    class="h- min-h-[50px] w-[4px] rounded-full bg-gradient-to-b from-sky-400 via-white to-purple-400">
                                </span>
                                <button @click="deleteMovie(movie)"
                                    class="bg-red-500 text-white font-semibold px-2 xl:px-4 py-1 text-xs lg:text-base rounded hover:bg-red-500/80 transition-colors duration-200">
                                    Törlés
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div v-else class="w-full my-24 h-full flex justify-center items-top mx-auto font-semibold text-white text-center">
        <p class="inline-flex">
            <BaseSpinner />
            <span class="pl-4 text-lg">Adatok szinkronizációja folyamatban...</span>
        </p>
    </div>
</template>