<script setup>
import { ref, computed, onMounted } from 'vue'
import { useDriveInCinemaStore } from '@stores/DriveInCinemaStore.mjs'
import { useMovieStore } from '@stores/MovieStore.mjs'
import { useScreeningStore } from '@stores/ScreeningStore.mjs'
import { useTicketStore } from '@stores/TicketStore'
import BaseLayout from '@layouts/BaseLayout.vue'
import Stepper from '@components/layout/Stepper.vue'
import BaseCardNavigate from '@components/layout/BaseCardNavigate.vue'
import BaseCard from '@components/layout/BaseCard.vue'
import BaseSeats from '@pages/BaseSeats.vue'

const driveInCinemaStore = useDriveInCinemaStore()
const movieStore = useMovieStore()
const screeningStore = useScreeningStore()
const ticketStore = useTicketStore()

const currentStep = ref(0)
const selectedGenre = ref('Mind')

onMounted(async () => {
    await driveInCinemaStore.getDriveInCinemas?.()
    await screeningStore.getScreenings()
    await movieStore.getMovies()
})

function selectCinema(cinema) {
    ticketStore.setLocation(cinema)
    ticketStore.setLocationName(cinema.name)
    currentStep.value = 1
}

function selectMovie(movie) {
    ticketStore.setMovie(movie)
    currentStep.value = 2
}

const selectedScreeningId = ref('')
const filteredScreeningsForMovie = computed(() => {
    if (!ticketStore.location?.id || !ticketStore.movie?.id) return []
    return screeningStore.screenings?.data?.filter(
        s =>
            Number(s.drive_in_cinema_id) === Number(ticketStore.location.id) &&
            Number(s.movie_id) === Number(ticketStore.movie.id)
    ) || []
})
function selectScreeningAndContinue() {
    if (!selectedScreeningId.value) return
    const screening = filteredScreeningsForMovie.value.find(s => String(s.id) === String(selectedScreeningId.value))
    if (screening) {
        ticketStore.setTime(screening)
        currentStep.value = 3
    }
}
function selectParkingSpot(spot) {
    ticketStore.setParkingSpot(spot)
    currentStep.value = 4
}

function resetFlow() {
    ticketStore.$reset()
    currentStep.value = 0
    selectedGenre.value = 'Mind'
    selectedScreeningId.value = ''
}

const screeningsForLocation = computed(() => {
    if (!ticketStore.location?.id) return []
    return screeningStore.screenings?.data?.filter(
        s => Number(s.drive_in_cinema_id) === Number(ticketStore.location.id)
    ) || []
})

function getMovieById(movieId) {
    return movieStore.movies.value?.find(m => Number(m.id) === Number(movieId)) || null
}

const enrichedScreenings = computed(() => {
    if (!screeningsForLocation.value.length || !movieStore.movies.value.length) return []
    return screeningsForLocation.value.map(screening => {
        const movie = getMovieById(screening.movie_id)
        return { ...screening, movie: movie || null }
    })
})

const filteredScreeningsByGenre = computed(() => {
    if (selectedGenre.value === 'Mind') return enrichedScreenings.value
    return enrichedScreenings.value.filter(s => s.movie?.type === selectedGenre.value)
})

</script>

<template>
    <BaseLayout>
        <Stepper :currentStep="currentStep" />
        <div v-if="currentStep === 0">
            <h1 class="text-3xl mt-10">Válassz helyszínt!</h1>
            <div v-if="driveInCinemaStore.driveInCinemas?.length" class="grid md:grid-cols-2 gap-6 my-12">
                <BaseCardNavigate v-for="cinema in driveInCinemaStore.driveInCinemas" :key="cinema.id"
                    :title="cinema.name" :src="'/starfield_autosmozi.jpg'" :alt="cinema.name"
                    :description="cinema.description" @click="selectCinema(cinema)" />
            </div>
            <div v-else> Betöltés... </div>
        </div>

        <div v-if="currentStep === 1">
            <h2 class="text-3xl text-pink-700 mb-4">Válassz filmet a(z) {{ ticketStore.location?.name }}</h2>
            <div class="flex my-2 gap-4">
                <button v-for="genre in ['Mind', 'Adventure', 'Comedy', 'Family', 'Action', 'Horror']" :key="genre"
                    class="p-2 px-4 rounded-lg border" :class="selectedGenre === genre ? 'bg-pink-700 text-white' : ''"
                    @click="selectedGenre = genre">
                    {{ genre }}
                </button>
            </div>
            <div v-if="filteredScreeningsByGenre.length" class="grid md:grid-cols-4 gap-6 mt-6">
                <BaseCard v-for="screening in filteredScreeningsByGenre" :key="screening.id"
                    :title="screening.movie?.title" :type="screening.movie?.type || '-'"
                    :src="screening.movie?.poster || '/starfield_autosmozi.jpg'" :alt="screening.movie?.title"
                    :description="screening.movie?.description || screening.description"
                    @click="selectMovie(screening.movie)" />
            </div>
            <div v-else class="mt-8 text-red-600">Nincs film ebben a műfajban a helyszínen.</div>
            <button class="mt-8 text-pink-400" @click="resetFlow">Vissza az elejére</button>
        </div>

        <div v-if="currentStep === 2">
            <h2 class="text-3xl mb-4">Válassz vetítési időpontot!</h2>
            <div v-if="filteredScreeningsForMovie.length">
                <select v-model="selectedScreeningId" class="border p-2 rounded">
                    <option disabled value="">Válassz időpontot</option>
                    <option v-for="s in filteredScreeningsForMovie" :key="s.id" :value="s.id">
                        {{ s.movie?.title || ticketStore.movie.title }} –
                        {{ new Date(s.start_time).toLocaleString('hu-HU') }}
                    </option>
                </select>
                <button class="ml-4 px-4 py-2 bg-pink-700 text-white rounded-xl" :disabled="!selectedScreeningId"
                    @click="selectScreeningAndContinue">Tovább</button>
            </div>
            <div v-else class="text-red-600">Nincs időpont ehhez a filmhez a helyszínen.</div>
            <button class="mt-8 text-pink-400 block" @click="currentStep--">Vissza</button>
        </div>

        <div v-if="currentStep === 3">
            <h2 class="text-3xl mb-4">Parkolóhely választás</h2>
            <BaseSeats @select="selectParkingSpot" />
            <button class="mt-8 text-pink-400" @click="currentStep--">Vissza</button>
        </div>

        <div v-if="currentStep === 4">
            <h2 class="text-3xl mb-4">Foglalás összegző</h2>
            <div class="bg-slate-900 rounded-xl p-6 text-white">
                <div><b>Helyszín:</b> {{ ticketStore.location?.name || 'Nincs kiválasztva' }}</div>
                <div><b>Film:</b> {{ ticketStore.movie?.title || 'Nincs kiválasztva' }}</div>
                <div><b>Időpont:</b>
                    {{ ticketStore.time?.start_time ? new Date(ticketStore.time.start_time).toLocaleString('hu-HU') :
                    'Nincs kiválasztva' }}
                </div>
                <div><b>Parkolóhely:</b> {{ ticketStore.parkingSpot || 'Nincs kiválasztva' }}</div>
            </div>
            <button class="mt-8 px-6 py-3 bg-green-700 text-white rounded-xl" @click="resetFlow">Újrakezdés</button>
        </div>
    </BaseLayout>
</template>