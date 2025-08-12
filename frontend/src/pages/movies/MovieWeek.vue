<script setup>
import { useScreeningStore } from '@stores/ScreeningStore.mjs'
import { computed, onMounted, ref } from 'vue'
import BaseLayout from '@layouts/BaseLayout.vue'
import BaseCard from '@components/BaseCard.vue'

const screeningStore = useScreeningStore()
const daysOfWeek = ['Hétfő', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat', 'Vasárnap']
const screenings = ref([])

onMounted(async () => {
  await screeningStore.getScreenings()
  screenings.value = screeningStore.screenings.data
})

const screeningsByDate = computed(() => {
  const groups = {}
  for (const vetitesi_idopont of screenings.value) {
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
    <div class="w-full min-h-screen h-full flex flex-col items-center py-6">
      <div v-for="day in screeningsByDate" :key="day.dateKey"
        class="flex flex-row items-start w-full h-full md:w-4/5 bg-slate-800 rounded-xl shadow-xl mb-4 p-3">
        <div class="flex flex-col min-h-[210px] self-center mx-auto items-center align-middle justify-center min-w-[120px]">
          <div class="h-full min-h-[205px] w-full mr-2 border-r-4 rounded-3xl flex flex-col justify-center mx-auto border-pink-600/70 shadow-inner shadow-pink-300 bg-indigo-500/15 ml-[12px]"
            style="font-family: 'Noto Serif';">
            <span class="font-bold text-lg text-white mx-auto">
              {{ magyarNap(day.localDate) }}
            </span>
            <span class="font-semibold text-pink-300 text-xl mx-auto">
              {{ magyarDatum(day.localDate) }}
            </span>
          </div>
        </div>

        <div v-if="day.vets && day.vets.length" class=" px-4 flex-1 flex items-center">
          <div
            class="
              w-full grid gap-4
              grid-cols-1
              md:grid-cols-2 md:grid-rows-2
              lg:grid-cols-3 lg:grid-rows-none
              xl:grid-cols-4
              py-2
            "
          >
            <div v-for="vetitesi_idopont in limitVets(day.vets)" :key="vetitesi_idopont.id"
              class="flex flex-col items-center gap-2 mb-1 bg-gray-600/85 rounded-lg px-3 py-3 shadow h-full w-full transition-transform hover:-translate-y-0.5">
              <span
                class="font-medium text-pink-800 border-2 border-orange-300/75 bg-white rounded-lg px-2 sm:px-3 lg:px-6 py-1 text-sm sm:text-base lg:text-xl">
                {{ magyarIdo(vetitesi_idopont.start_time) }}
              </span>
              <span class="w-10/12 my-1 h-[3px] bg-slate-900/60 rounded-full"></span>
              <div class="w-full h-full mx-auto">
                <BaseCard
                  :title="vetitesi_idopont.movie.title"
                  :type="vetitesi_idopont.movie.type"
                  :src="`../src/assets/img/${vetitesi_idopont.movie.poster_url}`"
                  :alt="vetitesi_idopont.movie.title"
                  :description="vetitesi_idopont.movie.description"
                  :cta="true"
                  :type_visible="false"
                  :link="`/LocationChoose`"
                  :button_text="'Kiválasztás'"
                  :img_size_class="'h-[200px] lg:h-[300px] lg:w-fit w-full object-cover overflow-hidden'"
                />
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </BaseLayout>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Cookie&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Onest:wght@100..900&display=swap');
</style>