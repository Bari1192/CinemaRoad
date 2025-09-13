<script setup>
import { useScreeningStore } from '@stores/ScreeningStore.mjs'
import { computed, ref, watch } from 'vue'
import BaseLayout from '@layouts/BaseLayout.vue'
import BaseCard from '@components/BaseCard.vue'
import { useRoute } from 'vue-router'
import BaseSpinner from '@components/layout/BaseSpinner.vue'

import { storage } from '@utils/http.mjs'

const route = useRoute()
const screeningStore = useScreeningStore()
const daysOfWeek = ['Hétfő', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat', 'Vasárnap']
const screenings = ref([])
const loading = ref(false)
const error = ref(null)

// EZ A LÉNYEG: computed, hogy REAKTÍV legyen!
const cinemaId = computed(() => route.params.cinemaId)

async function loadScreenings() {
  loading.value = true
  error.value = null
  try {
    await screeningStore.getScreenings()
    screenings.value = screeningStore.screenings.data
  } catch (err) {
    error.value = 'Vetítési adatok nem elérhetők vagy API hiba!'
    screenings.value = []
  } finally {
    loading.value = false
  }
}
// Watch cinemaId, hogy route váltáskor mindig töltsön! (IMMEDIATE!)
watch(cinemaId, () => loadScreenings(), { immediate: true })

const filteredLocationScreenings = computed(() =>
  screenings.value.filter(r => Number(r.drive_in_cinema_id) === Number(cinemaId.value))
)
const screeningsByDate = computed(() => {
  const groups = {}
  for (const vetitesi_idopont of filteredLocationScreenings.value) {
    const dateObj = new Date(vetitesi_idopont.start_time)
    const dateKey = dateObj.toISOString().split('T')[0]
    if (!groups[dateKey])
      groups[dateKey] = {
        dayIndex: (dateObj.getDay() + 6) % 7,
        localDate: dateObj,
        vets: []
      }
    groups[dateKey].vets.push(vetitesi_idopont)
  }
  return groups
})

function magyarNap(d) {
  return daysOfWeek[(d.getDay() + 6) % 7]
}

function magyarDatum(d) {
  return d.toLocaleDateString('hu-HU', { month: '2-digit', day: '2-digit' })
}

function magyarIdo(s) {
  return new Date(s).toLocaleTimeString('hu-HU', {
    hour: '2-digit',
    minute: '2-digit',
    hour12: false
  })
}

const screenWidth = ref(window.innerWidth)
window.addEventListener('resize', () => { screenWidth.value = window.innerWidth })

function limitVets(dayVets) {
  if (screenWidth.value >= 768 && screenWidth.value < 1024) return dayVets.slice(0, 4)
  return dayVets
}
</script>

<template>
  <BaseLayout>
    <div class="w-full min-h-screen h-full flex flex-col items-center py-6 px-4">
      <div v-if="loading"
        class="h-full w-full items-center justify-center flex flex-row gap-4 text-xl text-pink-300 mt-10">
        <BaseSpinner />
        Adatok betöltése…
      </div>
      <div v-else-if="error" class="text-red-600 text-lg my-8">{{ error }}</div>
      <div v-else-if="filteredLocationScreenings.length === 0" class="text-white text-lg mt-8">
        Ehhez a mozihoz egyelőre nincs elérhető vetítés.
      </div>
      
      <div v-else v-for="day in screeningsByDate" :key="day.dateKey"
        class="mt-8 flex flex-col md:flex-row items-start w-full h-full md:w-10/12 bg-slate-800 rounded-xl shadow-xl mb-12 md:mb-4 p-3 md:gap-4">
        <div
          class="mx-2 lg:px-0 flex flex-col w-full md:w-fit md:h-[350px] md:min-h-[210px] self-center items-center align-middle justify-center md:min-w-[120px]">
          <div class="py-4 md:py-0 md:h-full lg:h-[100px] md:min-h-[205px] w-full mr-2 border-r-4 rounded-3xl flex flex-col justify-center mx-auto border-pink-600/70 shadow-inner
             shadow-pink-300 bg-pink-200/30 md:bg-indigo-500/15 ml-[12px]" style="font-family: 'Noto Serif';">
            <span class="font-bold text-2xl md:text-lg text-white mx-auto">
              {{ magyarNap(day.localDate) }}
            </span>
            <span class="font-semibold text-pink-300 text-xl md:text-xl mx-auto">
              {{ magyarDatum(day.localDate) }}
            </span>
          </div>
        </div>
        <div class="
    w-3/4 mx-auto mt-4 md:mt-0 md:w-full
    grid gap-4
    grid-cols-1
    sm:grid-cols-2
    md:grid-cols-2
    lg:grid-cols-4
    py-2">
          <div v-for="vetitesi_idopont in limitVets(day.vets)" :key="vetitesi_idopont.id" class="flex flex-col items-center lg:gap-1 bg-gray-600/85 rounded-lg px-2 py-3 shadow
           h-full w-full 
           md:max-w-[220px] mx-auto
           ">
            <span
              class="font-medium text-pink-800 border-2 border-orange-300/75 bg-white rounded-lg px-2 sm:px-3 lg:px-6 py-1 text-base sm:text-sm lg:text-lg lg:font-semibold"
              style="font-family: 'Onest', 'Cookie','Arial','Times New Roman', Times, serif;">
              {{ magyarIdo(vetitesi_idopont.start_time) }}
            </span>
            <span class="w-7/12 h-[3px] my-0 md:my-2 bg-slate-900/75 rounded-full"></span>
            <BaseCard :title="vetitesi_idopont.movie.title" :type="vetitesi_idopont.movie.type"
              :src="storage.url(`${vetitesi_idopont.movie.poster_url}`)"
              :alt="vetitesi_idopont.movie.title"
              :description="vetitesi_idopont.movie.description" :cta="true" :type_visible="false"
              :link="`/LocationChoose`" :button_text="'Kiválasztás'"
              :img_size_class="screenWidth < 768 ? 'h-[150px] w-full object-cover' : screenWidth < 1024 ? 'h-[140px] w-full object-cover' : 'h-[180px] w-full object-cover'"
              class="w-[180px] md:w-full transition-none hover:cursor-default hover:scale-100 max-w-[210px] md:max-w-[180px] md:max-h-[340px] lg:max-h-[410px] mx-auto" />
          </div>
        </div>
      </div>

    </div>

  </BaseLayout>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Cookie&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Onest:wght@100..900&display=swap');
</style>