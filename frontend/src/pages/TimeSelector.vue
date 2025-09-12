<template>
  <BaseLayout>

    <div class="min-h-screen px-2 w-full flex flex-col justify-between">
      <Stepper :currentStep="2" />
      <h1 class="text-3xl mb-10 font-bold text-center">{{ ticketStore.locationName }}: {{ ticketStore.movie.title }}</h1>
      <div class="flex flex-1 items-center justify-center w-full">
        <Calendar :screenings="filteredScreenings" @select-screening="onVetítésVálaszt" />
      </div>
      <div class="w-full md:w-4/5 md:mx-auto flex justify-end items-center">
        <button @click="handleNext" class="text-pink-700 w-fit min-w-[110px] max-w-xs  bg-white border-2 font-semibold  border-pink-700 hover:bg-white/90 hover:text-pink-500
        rounded-lg hover:shadow-sm hover:shadow-slate-300/55 transition-all ease-in-out duration-200
        text-base lg:text-xl px-3 py-2 mt-3 mb-6 
        md:text-base
        lg:px-6 lg:py-3 lg:my-8">
          Következő
        </button>
      </div>
    </div>
  </BaseLayout>
</template>

<script setup>
import BaseLayout from '@layouts/BaseLayout.vue'
import Stepper from '@components/layout/Stepper.vue'
import Calendar from './Calendar.vue'
import { useTicketStore } from '@stores/TicketStore'
import { useScreeningStore } from '@stores/ScreeningStore.mjs'
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const ticketStore = useTicketStore()
const screeningStore = useScreeningStore()
const router = useRouter()
const screenings = ref([])
const kiválasztottVetítésId = ref('')

const filteredScreenings = computed(() => {
  if (!ticketStore.location?.id || !ticketStore.movie?.id) return []
  return screenings.value.filter(s =>
    Number(s.drive_in_cinema_id) === Number(ticketStore.location.id) &&
    Number(s.movie_id) === Number(ticketStore.movie.id)
  )
})

function onVetítésVálaszt(screeningId) {
  kiválasztottVetítésId.value = screeningId
}

function handleNext() {
  if (!kiválasztottVetítésId.value) {
    alert('Válassz vetítési időpontot!')
    return
  }
  const kiválasztott = filteredScreenings.value.find(s => String(s.id) === String(kiválasztottVetítésId.value))
  if (!kiválasztott) {
    alert('Hibás vagy nem létező vetítés!')
    return
  }
  ticketStore.setTime(kiválasztott)
  router.push('/ParkingSpotChooser')
}

onMounted(async () => {
  await screeningStore.getScreenings()
  screenings.value = screeningStore.screenings.data
})
</script>