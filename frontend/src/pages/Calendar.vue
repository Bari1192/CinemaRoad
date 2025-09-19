<script setup>
import { computed, ref } from 'vue'

const props = defineProps({
  screenings: { type: Array, required: true },
  showLocations: { type: Boolean, required: false }
})

const emit = defineEmits(['select-screening'])

const daysOfWeek = ['Hétfő', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat', 'Vasárnap']
const openedDayKey = ref(null)
const selectedScreeningId = ref(null);

function localDateKey(input) {
  const d = new Date(input)
  d.setHours(0, 0, 0, 0)
  const y = d.getFullYear()
  const m = String(d.getMonth() + 1).padStart(2, '0')
  const day = String(d.getDate()).padStart(2, '0')
  return `${y}-${m}-${day}`
}


const screeningsByDate = computed(() => {
  const groups = {}
  for (const screening of props.screenings) {
    const dateObj = new Date(screening.start_time)
    const dateKey = localDateKey(dateObj)
    if (!groups[dateKey]) {
      const localMidnight = new Date(dateObj)
      localMidnight.setHours(0, 0, 0, 0)
      groups[dateKey] = {
        dayIndex: (dateObj.getDay() + 6) % 7,
        localDate: localMidnight,
        vets: []
      }
    }
    groups[dateKey].vets.push(screening)
  }
  return groups
})

const weekRows = computed(() => {
  const allDates = Object.entries(screeningsByDate.value).map(([dateKey, obj]) => ({
    dateKey, ...obj
  }))
  if (!allDates.length) return []
  const minDate = allDates.reduce((min, d) => d.localDate < min ? d.localDate : min, allDates[0].localDate)
  const maxDate = allDates.reduce((max, d) => d.localDate > max ? d.localDate : max, allDates[0].localDate)
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
  let weekStart = startOfWeek(minDate)
  const to = endOfWeek(maxDate)
  while (weekStart <= to) {
    const days = []
    for (let i = 0; i < 7; i++) {
      const d = new Date(weekStart)
      d.setDate(d.getDate() + i)
      const dateKey = localDateKey(d)
      days.push({
        dateKey,
        dayName: daysOfWeek[i],
        localDate: d,
        screenings: screeningsByDate.value[dateKey]?.vets ?? []
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

function clickScreening(screening) {
  selectedScreeningId.value = screening.id;
  emit('select-screening', screening.id)
}

const toggleDay = (dayKey) => {
  openedDayKey.value = openedDayKey.value === dayKey ? null : dayKey
}
</script>

<template>
  <div class="w-full h-full">
    <!-- LG MÉRET FELETT!!!! -->
    <table class="w-full bg-slate-900 rounded-xl shadow-lg select-none hidden lg:table">
      <thead>
        <tr>
          <th v-for="d in daysOfWeek" :key="d"
            class="py-4 tracking-wide text-lg md:text-2xl font-bold text-slate-100 border-b-2 border-slate-700 text-center">
            {{ d }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(week, wi) in weekRows" :key="wi">
          <td v-for="(day, di) in week" :key="day.dateKey"
            class="align-top p-3 bg-gray-700/40 border border-slate-700 hover:bg-slate-600/50 transition-colors duration-200 ease-in-out">

            <!-- Dátum -->
            <div
              class="font-semibold text-pink-500 text-sm md:text-base lg:text-lg bg-slate-100 rounded px-3 py-1 text-center shadow-sm">
              {{ magyarDatum(day.localDate) }}
            </div>

            <!-- Vetítések -->
            <div class="flex flex-col gap-2 w-full h-full mt-6">
              <template v-if="day.screenings.length">
                <button v-for="screening in day.screenings" :key="screening.id"
                  @click="clickScreening(screening)" :class="selectedScreeningId === screening.id
                    ? 'bg-pink-600 hover:bg-pink-700'
                    : 'bg-slate-300/60 hover:bg-slate-500/75'"
                  class="w-fit px-4 mx-auto rounded-md text-white font-medium py-1.5 text-base transition-all shadow">

                  <template v-if="showLocations">
                    <div class="w-full min-w-[100px]">
                      {{ screening.drivein_cinema.name }}<br />
                    </div>
                  </template>
                  {{ magyarIdo(screening.start_time) }}
                </button>
              </template>
              <template v-else>
                <span class="text-gray-500 italic text-sm text-center py-4 min-h-[80px]"></span>
              </template>
            </div>

          </td>
        </tr>
      </tbody>
    </table>


    <!-- LISTA nézet, csak md-tól lefelé -->
    <div class="block lg:hidden w-full md:w-4/5 md:mx-auto space-y-4 px-2 py-4">
      <template v-for="(week, wi) in weekRows" :key="'mweek'+wi">
        <template v-for="(day, di) in week" :key="day.dateKey">

          <!-- VAN VETÍTÉS -->
          <div v-if="day.screenings.length > 0"
            class="bg-slate-800 rounded-lg shadow border border-slate-700 overflow-hidden">

            <!-- Fejléc -->
            <button @click="toggleDay(day.dateKey)"
              class="flex items-center justify-between w-full p-3 hover:bg-slate-700 transition-colors">
              <div class="flex items-center gap-2">
                <span class="bg-pink-500 text-white font-bold px-3 py-1 rounded-md text-sm">
                  {{ magyarDatum(day.localDate) }}
                </span>
                <span class="text-gray-200 text-base font-semibold">
                  {{ daysOfWeek[day.localDate.getDay() === 0 ? 6 : day.localDate.getDay() - 1] }}
                </span>
              </div>
              <svg :class="openedDayKey === day.dateKey ? 'rotate-180' : ''"
                class="w-5 h-5 text-white transition-transform" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <!-- Lenyíló rész -->
            <transition name="fade">
              <div v-if="openedDayKey === day.dateKey" class="p-3 flex flex-wrap gap-2 bg-slate-900">
                <button v-for="screening in day.screenings" :key="screening.id"
                  @click="clickScreening(screening)" :class="selectedScreeningId === screening.id
                    ? 'bg-pink-600 hover:bg-pink-700'
                    : 'bg-slate-500 hover:bg-slate-600'"
                  class="px-4 py-1.5 rounded-md text-white font-medium text-sm transition-all shadow">
                  <template v-if="showLocations">
                    <div class="w-full min-w-[80px]">
                      {{ screening.drivein_cinema.name }}<br />
                    </div>
                  </template>
                  {{ magyarIdo(screening.start_time) }}
                </button>
              </div>
            </transition>
          </div>

          <!-- NINCS VETÍTÉS -->
          <div v-else class="hidden bg-slate-700 rounded-lg shadow p-3 items-center gap-2 opacity-60 cursor-not-allowed">
            <span class="bg-gray-500 text-white font-bold px-3 py-1 rounded-md text-sm">
              {{ magyarDatum(day.localDate) }}
            </span>
            <span class="text-gray-200 text-base font-semibold">
              {{ daysOfWeek[day.localDate.getDay() === 0 ? 6 : day.localDate.getDay() - 1] }}
            </span>
            <span class="text-gray-400 italic text-sm ml-auto">Nem vetítjük</span>
          </div>

        </template>
      </template>
    </div>

  </div>
</template>

<style>
tbody>tr:first-of-type td>div {
  border-top: 0;
}
</style>