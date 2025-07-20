<script setup>
import { ref, computed, onMounted } from 'vue'
import { useMovieStore } from '@stores/MovieStore.mjs'
import defaultPoster from '@/assets/img/No_image_available.png'

const store = useMovieStore()
const movies = ref([])

const setDefaultImg = (e) => {
    e.target.src = defaultPoster
}
onMounted(async () => {
    movies.value = await store.getMovies();
    // console.log('Lekért MOVIES:', movies.value)
})
const familyMovies = computed(() =>
    movies.value.filter(m => m.type && m.type.toLowerCase().includes('family'))
)
const actionMovies = computed(() =>
    movies.value.filter(m => m.type && m.type.toLowerCase().includes('action'))
)
const horrorMovies = computed(() =>
    movies.value.filter(m => m.type && m.type.toLowerCase().includes('horror'))
)
</script>

<template>
    <div class="mx-auto w-full max-w-[1980px] my-6 px-2 sm:px-6 py-5 bg-slate-900 rounded-lg shadow-xl mb-8">
        <h2 class="text-2xl sm:text-4xl md:text-5xl text-white font-bold mb-5 text-start px-2">Családi filmek
            <div class="max-w-[160px] md:max-w-[325px] h-[4px] bg-yellow-400/80 mt-1 mb-5 rounded-full"></div>
        </h2>
        <div
            class="grid grid-cols-2 gap-4 p-2 md:flex md:overflow-x-auto md:-mx-4 md:px-4 md:pb-8 md:gap-0 md:custom-scrollbar-family">
            <div v-for="movie in familyMovies" :key="movie.id" class="card-themes overflow-hidden relative flex-shrink-0 m-2 gap-2 flex justify-center items-center w-full max-w-full min-w-0
          md:w-[300px] md:max-w-[300px] md:min-w-[300px] border-4 border-yellow-400">
                <img :src="movie.poster_url || defaultPoster"
                    class="h-[160px] sm:h-[220px] md:h-[400px] w-full object-cover" :alt="movie.title || 'Nincs adat'"
                    @error="setDefaultImg($event)" />
                <span
                    class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-yellow-900 via-slate-900/95 to-transparent p-2 sm:p-4 text-white text-sm sm:text-xl font-semibold tracking-wide text-center">Harry
                    {{ movie.title || 'Nincs megjeleníthető adat' }}</span>
            </div>
        </div>
    </div>

    <div class="mx-auto w-full max-w-[1980px] my-6 px-2 sm:px-6 py-5 bg-slate-900 rounded-lg shadow-xl mb-8">
        <h2 class="text-2xl sm:text-4xl md:text-5xl font-bold text-slate-200 uppercase text-start px-2">Akciófilmek
            <div class="max-w-[160px] md:max-w-[325px] h-[4px] bg-slate-300 mt-1 mb-5 rounded-full"></div>
        </h2>
        <div
            class="grid grid-cols-2 gap-4 p-2 md:flex md:overflow-x-auto md:-mx-4 md:px-4 md:pb-8 md:gap-0 md:custom-scrollbar-family">
            <div v-for="movie in actionMovies" :key="movie.id" class="card-themes overflow-hidden relative flex-shrink-0 m-2 gap-2 flex justify-center items-center w-full max-w-full min-w-0
                    md:w-[300px] md:max-w-[300px] md:min-w-[300px] border-4 border-slate-500/75">
                <img :src="movie.poster_url || defaultPoster" :alt="movie.title || 'Nincs adat'"
                    class="h-[160px] sm:h-[220px] md:h-[400px] w-full object-cover">
                <span
                    class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-yellow-900 via-slate-900/95 to-transparent px-2 py-2 text-[13px] sm:text-xl text-white font-semibold text-center">
                    {{ movie.title || 'Nincs megjeleníthető adat' }}</span>
            </div>
        </div>
    </div>

    <div class="mx-auto w-full max-w-[1980px] my-6 px-2 sm:px-6 py-5 bg-slate-900 rounded-lg shadow-xl mb-8">
        <h2 class="text-2xl sm:text-4xl md:text-5xl text-white font-bold  text-start px-2">Horror Filmek
            <div class="max-w-[160px] md:max-w-[325px] h-[4px] bg-red-600/75 mt-1 mb-5 rounded-full"></div>
        </h2>
        <div
            class="grid grid-cols-2 gap-4 p-2 md:flex md:overflow-x-auto md:-mx-4 md:px-4 md:pb-8 md:gap-0 md:custom-scrollbar-family">
            <div v-for="movie in horrorMovies" :key="movie.id" class="card-themes overflow-hidden relative flex-shrink-0 m-2 gap-2 flex justify-center items-center w-full max-w-full min-w-0
          md:w-[300px] md:max-w-[300px] md:min-w-[300px] border-4 border-red-600">
                <img :src="movie.poster_url || defaultPoster"
                    class="h-[160px] sm:h-[220px] md:h-[400px] w-full object-cover" :alt="movie.title"
                    @error="setDefaultImg($event)" />
                <span
                    class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-red-900 via-slate-900/95 to-transparent p-2 sm:p-4 text-white text-sm sm:text-xl font-semibold tracking-wide text-center">Harry
                    {{ movie.title || 'Nincs megjeleníthető adat' }}</span>
            </div>
        </div>
    </div>
</template>

<style scoped>
@import url('@assets/css/MovieThemesSections.css');
</style>