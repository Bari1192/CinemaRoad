<script setup>
import { computed, ref } from 'vue'

const props = defineProps({
    screenings: { type: Array, required: true }
})
const emit = defineEmits(['select-screening'])

const daysOfWeek = ['Hétfő', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat', 'Vasárnap']
const selectedScreeningId = ref(null);

// Map: dátum → { napIndex, localDate, vetítések[] }
const screeningsByDate = computed(() => {
    const groups = {}
    for (const vetitesi_idopont of props.screenings) {
        const dateObj = new Date(vetitesi_idopont.start_time)
        // ISO napra (YYYY-MM-DD)
        const dateKey = dateObj.toISOString().split('T')[0]
        if (!groups[dateKey]) groups[dateKey] = {
            dayIndex: (dateObj.getDay() + 6) % 7, // 0=vasárnap, 1=hétfő (magyar), ezért +6%7
            localDate: dateObj,
            vets: []
        }
        groups[dateKey].vets.push(vetitesi_idopont)
    }
    return groups
})
// Hány hét jelenik meg (lehet csak a legközelebbi hét, vagy az összes adott hónapban)
const weekRows = computed(() => {
    const allDates = Object.entries(screeningsByDate.value).map(([dateKey, obj]) => ({
        dateKey, ...obj
    }))
    if (!allDates.length) return []

    // A legkorábbi start-dátum
    const minDate = allDates.reduce((min, d) => d.localDate < min ? d.localDate : min, allDates[0].localDate)
    const maxDate = allDates.reduce((max, d) => d.localDate > max ? d.localDate : max, allDates[0].localDate)

    // Hány hétig tart (pl. aug 1 - aug 14 = 2 hét)
    const startOfWeek = (date) => {
        const n = (date.getDay() + 6) % 7
        const d = new Date(date)
        d.setDate(d.getDate() - n)
        d.setHours(0, 0, 0, 0)
        return d
    }
    const endOfWeek = (date) => {
        const n = 6 - ((date.getDay() + 6) % 7)
        const d = new Date(date)
        d.setDate(d.getDate() + n)
        d.setHours(23, 59, 59, 999)
        return d
    }

    const rows = []
    let from = startOfWeek(minDate)
    let to = endOfWeek(maxDate)
    let weekStart = new Date(from)
    while (weekStart <= to) {
        const days = []
        for (let i = 0; i < 7; i++) {
            const d = new Date(weekStart)
            d.setDate(d.getDate() + i)
            const dateKey = d.toISOString().slice(0, 10)
            days.push({
                dateKey,
                dayName: daysOfWeek[i],
                localDate: d,
                screenings: (screeningsByDate.value[dateKey]?.vets) || []
            })
        }
        rows.push(days)
        weekStart.setDate(weekStart.getDate() + 7)
    }
    return rows
})

function magyarDatum(d) {
    return d.toLocaleDateString('hu-HU', { month: '2-digit', day: '2-digit' })
}
function magyarIdo(s) {
    return new Date(s).toLocaleTimeString('hu-HU', { hour: '2-digit', minute: '2-digit', hour12: false })
}
function clickScreening(vetitesi_idopont) {
    selectedScreeningId.value = vetitesi_idopont.start_time;
    emit('select-screening', vetitesi_idopont.id)
}
</script>

<template>
    <div class="w-full overflow-x-auto">
        <table class="min-w-full bg-slate-800 rounded-xl shadow-xl select-none">
            <thead>
                <tr>
                    <th v-for="d in daysOfWeek" :key="d"
                        class="py-4  tracking-wide px-1 text-lg md:text-2xl font-bold text-white border-b-4 border-pink-600 text-center">
                        {{ d }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(week, wi) in weekRows" :key="wi">
                    <td v-for="(day, di) in week" :key="day.dateKey"
                        class="align-top p-2 bg-slate-900 border-x-slate-700 border-x-2">
                        <div class="flex flex-col items-center min-h-[60px] ">
                            <div
                                class="font-bold text-pink-800 text-[1.2rem] min-w-fit w-full text-center bg-white rounded-md mx-auto mt-1">
                                {{ magyarDatum(day.localDate) }}
                            </div>
                            <div class="flex flex-col gap-3 w-full my-4">
                                <template v-if="day.screenings.length">
                                    <button v-for="vetitesi_idopont in day.screenings" :key="vetitesi_idopont.id"
                                        @click="clickScreening(vetitesi_idopont)"
                                        :class="selectedScreeningId=== vetitesi_idopont.start_time? 'bg-pink-600':'bg-slate-400/70'"
                                        class="max-w-full w-2/3 mx-auto rounded-md  text-xl text-white font-medium px-2 py-2 mb-1transition duration-150">
                                        {{ magyarIdo(vetitesi_idopont.start_time) }}
                                    </button>
                                </template>
                                <template v-else >
                                    <span class="text-gray-400/90 text-sm italic text-center">Vetítés Szünet</span>
                                </template>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>