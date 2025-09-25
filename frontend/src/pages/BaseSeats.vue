<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { useTicketStore } from '@stores/TicketStore.js'
import { useRouter } from 'vue-router'
import { http } from '@utils/http.mjs'
import BaseSpinner from '@components/layout/BaseSpinner.vue'

const rows = ['X', 'A', 'X', 'B', 'X', 'C', 'X', 'D', 'X', 'E']
const cols = 9

const seats = ref([])
const selectedSeats = ref([])
const reservations = ref([])
const purchases = ref([])
const loading = ref(true)

const ticketStore = useTicketStore()
const router = useRouter()

function initSeats() {
    seats.value = []
    for (const row of rows) {
        if (row !== 'X') {
            for (let col = 1; col <= cols - 1; col++) {
                seats.value.push({
                    id: `${row}${col}`,
                    row,
                    col,
                    reserved: false,
                    occupied: false
                })
            }
        }
    }
}

async function loadData() {
    try {
        const [resResp, purResp] = await Promise.all([
            http.get('/reservations'),
            http.get('/purchases')
        ])

        reservations.value = resResp.data.data
        purchases.value = purResp.data.data

        updateOccupiedSeats()
    } catch (err) {
        console.error('API hiba:', err)
    } finally {
        loading.value = false
    }
}

const foglaltParkolok = computed(() => {
    if (!ticketStore.time) return []

    const scr = Number(ticketStore.time.id)

    return [
        ...reservations.value.filter(r => Number(r.screening_id) === scr),
        ...purchases.value.filter(p => Number(p.screening_id) === scr)
    ]
        .flatMap(f => f.parkingspot.split(','))
        .map(s => s.trim())
})


function updateOccupiedSeats() {
    seats.value.forEach(seat => {
        seat.occupied = foglaltParkolok.value.includes(seat.id)
    })
}

function toggleSeat(seatID) {
    const seat = seats.value.find(s => s.id === seatID)
    if (!seat || seat.occupied) return

    const i = selectedSeats.value.indexOf(seatID)
    if (i === -1) {
        selectedSeats.value.push(seatID)
        seat.reserved = true
    } else {
        selectedSeats.value.splice(i, 1)
        seat.reserved = false
    }
}

function handleNext() {
    if (!selectedSeats.value.length) {
        alert('Nem választott ki parkolóhelyet a nézőtéren!')
        return
    }
    ticketStore.setParkingSpot([...selectedSeats.value])
    router.push('/Summary')
}
watch(() => ticketStore.time, async (ujIdo) => {
    if (!ujIdo) return;
    await loadData();
}, { immediate: true });

onMounted(async () => {
    initSeats()
    await loadData()
})
</script>

<template>
    <div v-if="loading" class="w-full h-full flex flex-col items-center justify-center py-12">
        <BaseSpinner class="w-12 h-12 text-pink-600 mb-4" />
        <p class="text-slate-300 text-lg font-semibold">Betöltés...</p>
    </div>

    <div v-else
        class="container w-full h-full lg:max-w-3xl xl:max-w-5xl mx-auto my-12 lg:my-0 bg-gray-800/80 rounded-3xl shadow-xl">

        <h2 class="text-3xl text-slate-400 font-bold mb-8 text-center uppercase"></h2>

        <div class="grid grid-cols-8 w-full h-full text-center pt-4">
            <div></div>
            <div
                class="col-span-7 w-[95%] mx-auto h-[80px] border-t-8 border-t-gray-950/30 shadow-md shadow-gray-500/45 bg-gray-900 mb-12 rounded-t-full border-b-4 border-pink-900/90 text-4xl text-center text-slate-200 text-opacity-50 uppercase">
                <div
                    class="w-full h-4/5 relative bg-white -bottom-16 right-50 blur-lg bg-opacity-10 rounded-t-3xl xl:-bottom-18">
                </div>
                <div
                    class="block -mt-9 w-full h-full mx-auto justify-center text-white/70 items-center text-2xl font-extrabold tracking-wider xl:text-3xl xl:tracking-widest">
                    Mozivászon
                </div>
            </div>
        </div>

        <div class="mx-auto w-full h-full px-8">
            <div
                class="container mx-auto w-full my-12 lg:mb-12 lg:mt-0 bg-gray-800/80 shadow-slate-900/65 border-t-4 border-t-slate-900/65 rounded-3xl shadow-2xl">

                <div class="grid grid-cols-11 justify-center text-center mb-2 md:mb-4">
                    <div></div>
                    <div></div>
                    <div v-for="col in cols - 1" :key="'col-' + col"
                        class="font-semibold text-yellow-500 text-xs border-2 border-pink-700/50 rounded-full w-fit mx-auto px-1.5 mt-2 md:text-base md:px-2.5 lg:text-lg md:border-4 lg:px-3 xl:mt-2">
                        {{ col }}
                    </div>
                    <div></div>
                </div>

                <div v-for="row in rows" :key="'row-' + row"
                    class="grid grid-cols-11 gap-2 items-center justify-center mx-auto text-center w-full h-full">

                    <div v-if="row !== 'X'"
                        class="font-semibold text-yellow-500 border-2 md:border-4 border-pink-700/50 rounded-full w-fit h-fit px-1 text-[10px] sm:text-xs md:text-sm lg:text-lg sm:px-2 mx-auto -mr-1 md:ml-3 lg:px-2 xl:ml-4 text-center">
                        {{ row }}
                    </div>
                    <div v-else></div>

                    <div v-if="row === 'X'" class="bg-gray-600/30 col-span-10 h-4 md:h-10 w-full"></div>
                    <div v-else class="bg-gray-600/30 h-full w-full mx-auto justify-center items-center rounded-none">
                        <div class="flex w-full h-full mx-auto justify-center items-center opacity-85">
                            <i class="text-xs md:text-xl lg:text-2xl text-sky-400/65 fa-solid fa-angles-up h-3 "></i>
                        </div>
                    </div>

                    <template v-if="row !== 'X'">
                        <div v-for="col in 8" :key="`${row}${col}`" @click="toggleSeat(`${row}${col}`)"
                            class="flex items-center justify-center cursor-pointer border-b-2 border-r-2 md:border-b-4 md:border-r-4 border-slate-600 rounded-lg transition duration-300 aspect-square w-6 h-6 sm:w-10 sm:h-10 md:w-14 md:h-14 mx-auto my-2 select-none text-center bg-gray-900/40 md:bg-[url('../assets/img/car_80x50.webp')] md:bg-no-repeat md:bg-center md:bg-contain"
                            :class="{
                                'cursor-not-allowed -z-10 bg-red-800 border-red-800': seats.find(s => s.id === `${row}${col}`)?.occupied,
                                'border-lime-500/45 bg-lime-700/45': selectedSeats.includes(`${row}${col}`) && !seats.find(s => s.id === `${row}${col}`)?.occupied,
                                'border-gray-400 bg-slate-400/15': !selectedSeats.includes(`${row}${col}`) && !seats.find(s => s.id === `${row}${col}`)?.occupied
                            }">
                            <span
                                class="md:hidden w-full h-full flex items-center justify-center font-bold text-yellow-400 text-[10px] sm:text-sm md:text-lg xl:text-xl tracking-tight select-none"
                                style="line-height: 1;">
                                {{ row + col }}
                            </span>
                        </div>

                        <div class="flex bg-gray-600/30 h-full w-full mx-auto justify-center items-center rounded-none">
                            <i class="text-xs md:text-xl lg:text-2xl text-sky-400/65 fa-solid fa-angles-down h-3 "></i>
                        </div>
                    </template>
                </div>

                <div class="w-full flex h-32 justify-center flex-col mx-auto text-center my-10 gap-8 pb-12">
                    <div v-if="selectedSeats.length"
                        class="text-white h-16 mt-4 font-semibold underline underline-offset-2 md:text-lg text-base">
                        Kiválasztott helyek:
                        <p class="text-lime-500">{{ selectedSeats.join(', ') }}</p>
                    </div>
                    <button @click="handleNext" :disabled="!selectedSeats.length"
                        :class="selectedSeats.length > 0 ? 'bg-pink-700 cursor-pointer' : 'bg-gray-400 cursor-not-allowed opacity-60'"
                        class="text-white w-fit mx-auto font-bold rounded-xl px-2 py-1 text-base md:text-lg lg:px-8 lg:py-3 lg:w-1/5 transition duration-150 hover:bg-pink-800 border border-white/65">
                        Tovább
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
