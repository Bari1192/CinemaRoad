<script setup>
import { ref, computed, onMounted } from 'vue'
import { useMovieStore } from '@stores/MovieStore.mjs'
import Family from '@assets/svg/ZeroPlus.vue'
import SixteenPlus from '@assets/svg/SixteenPlus.vue'
import EighteenPlus from '@assets/svg/EighteenPlus.vue'
import { useRouter } from 'vue-router'
const router = useRouter();
const store = useMovieStore()
const movies = ref([])
const imgpath = '../src/assets/img/';
const handleImageError = (e) => {
    console.error('Kép betöltési hiba:', e.target.src)
}
onMounted(async () => {
    movies.value = await store.getMovies();
})
const familyMovies = computed(() =>
    movies.value.filter(m => m.type == 'family')
)
const actionMovies = computed(() =>
    movies.value.filter(m => m.type == 'action')
)
const horrorMovies = computed(() =>
    movies.value.filter(m => m.type == 'horror')
)

function goToMoviePage(movieID) {
    router.push(`/movie/${movieID}`);
}
</script>

<template>
    <div
        class="mx-auto w-full md:max-w-7xl lg:max-w-[1800px] my-6 px-2 sm:px-6 py-5 bg-slate-900 rounded-lg shadow-xl mb-8">
        <h2 class="text-2xl sm:text-4xl md:text-5xl text-white font-bold mb-5 uppercase text-start px-2">Családi filmek
            <div class="max-w-[160px] md:max-w-[385px] h-[4px] bg-yellow-400/80 mt-1 mb-5 rounded-full"></div>
        </h2>
        <div
            class="grid grid-cols-2 gap-4 p-2 md:flex md:overflow-x-auto md:-mx-4 md:px-4 md:pb-8 md:gap-0 md:custom-scrollbar-family">
            <div v-for="movie in familyMovies" :key="movie.id" class="card-themes overflow-hidden relative flex-shrink-0 m-2 gap-2 flex justify-center items-center w-full max-w-full min-w-0
          md:w-[300px] md:max-w-[300px] md:min-w-[300px] border-4 border-yellow-400 hover:cursor-pointer" @click="goToMoviePage(movie.id)">
                <div class="w-full h-full relative">
                    <img :src="`${imgpath}${movie.poster_url}`"
                        class="h-[160px] sm:h-[220px] md:h-[400px] w-full object-cover overflow-hidden"
                        :alt="movie.title || 'Nincs adat'" />
                    <div class="absolute top-0 left-0 opacity-85">
                        <Family class="w-8 h-8" />
                    </div>
                </div>
                <span
                    class="absolute z-10 bottom-0 left-0 right-0 px-2 sm:p-4 md:pb-1 lg:pb-1.5 text-[13px] sm:text-xl text-white font-semibold text-center">
                    {{ movie.title || 'Nincs megjeleníthető adat' }}
                    <span
                        class="h-12 -z-10 w-full absolute bottom-0 left-0 right-0 bg-gradient-to-t from-yellow-600/60 via-slate-900/95 to-transparent">
                    </span>
                </span>
            </div>
        </div>
    </div>

    <div
        class="mx-auto w-full md:max-w-7xl lg:max-w-[1800px] my-6 px-2 sm:px-6 py-5 bg-slate-900 rounded-lg shadow-xl mb-8">
        <h2 class="text-2xl sm:text-4xl md:text-5xl font-bold text-slate-200 uppercase text-start px-2">Akciófilmek
            <div class="max-w-[160px] md:max-w-[325px] h-[4px] bg-slate-300 mt-1 mb-5 rounded-full"></div>
        </h2>
        <div
            class="grid grid-cols-2 gap-4 p-2 md:flex md:overflow-x-auto md:-mx-4 md:px-4 md:pb-8 md:gap-0 md:custom-scrollbar-family">
            <div v-for="movie in actionMovies" :key="movie.id" class="card-themes overflow-hidden relative flex-shrink-0 m-2 gap-2 flex justify-center items-center w-full max-w-full min-w-0
                    md:w-[300px] md:max-w-[300px] md:min-w-[300px] border-4 border-slate-500/75 hover:cursor-pointer" @click="goToMoviePage(movie.id)">
                <div class="w-full h-full relative">
                    <img :src="`${imgpath}${movie.poster_url}`"
                        class="h-[160px] sm:h-[220px] md:h-[400px] w-full object-cover">
                    <div class="absolute top-0 left-0">
                        <SixteenPlus class="w-8 h-8" />
                    </div>
                </div>
                <span
                    class="absolute z-10 bottom-0 left-0 right-0 px-2 sm:p-4 md:pb-1 lg:pb-1.5 text-[13px] sm:text-xl text-white font-semibold text-center">
                    {{ movie.title || 'Nincs megjeleníthető adat' }}
                    <span
                        class="h-12 -z-10 w-full absolute bottom-0 left-0 right-0 bg-gradient-to-t from-gray-600/95 via-slate-900/95 to-transparent">
                        <!-- Ez csak a háttér "shadow" a szöveg mögött z-mínusz 10-zel -->
                    </span>
                </span>
            </div>
        </div>
    </div>

    <div
        class="mx-auto w-full md:max-w-7xl lg:max-w-[1800px] my-6 px-2 sm:px-6 py-5 bg-slate-900 rounded-lg shadow-xl mb-8">
        <h2 class="text-2xl sm:text-4xl md:text-5xl text-white font-bold uppercase text-start px-2">Horror Filmek
            <div class="max-w-[160px] md:max-w-[385px] h-[4px] bg-red-600/75 mt-1 mb-5 rounded-full"></div>
        </h2>
        <div
            class="grid grid-cols-2 gap-4 p-2 md:flex md:overflow-x-auto md:-mx-4 md:px-4 md:pb-8 md:gap-0 md:custom-scrollbar-family">
            <div v-for="movie in horrorMovies" :key="movie.id" class="card-themes overflow-hidden relative flex-shrink-0 m-2 gap-2 flex justify-center items-center w-full max-w-full min-w-0
          md:w-[300px] md:max-w-[300px] md:min-w-[300px] border-4 border-red-600 hover:cursor-pointer" @click="goToMoviePage(movie.id)">
                <div class="w-full h-full relative">
                    <img :src="`${imgpath}${movie.poster_url}`"
                        class="h-[160px] sm:h-[220px] md:h-[400px] w-full object-cover" :alt="movie.title"
                        @error="handleImageError" />
                    <div class="absolute z-10 top-0.5 left-0.5 opacity-95">
                        <EighteenPlus class="w-7 h-7" />
                    </div>
                </div>
                <span
                    class="absolute bottom-0 z-10 left-0 right-0 px-2 sm:p-4 md:pb-1 lg:pb-1.5 text-white text-sm sm:text-xl font-semibold tracking-wide text-center">
                    {{ movie.title || 'Nincs megjeleníthető adat' }}
                    <span
                        class="h-12 -z-10 w-full absolute bottom-0 left-0 right-0 bg-gradient-to-t from-red-900/95 via-slate-900/95 to-transparent">
                    </span>
                </span>
            </div>
        </div>
    </div>
</template>

<style scoped>
@import url('@assets/css/MovieThemesSections.css');
</style>