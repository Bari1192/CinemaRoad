<template>
  <BaseLayout>

  <!-- csúszka -->
    <Stepper :currentStep="2" />

    <!-- időpontválasztó naptár ITTEN! -->
    <Calendar :screenings="filteredScreenings" @select-screening="onVetítésVálaszt" />

    <div class="w-full flex justify-end items-center align-middle ">
      <button
        @click="handleNext"
        class="text-pink-700 my-8 w-1/6 text-xl bg-white border-2 px-6 font-semibold py-3 border-pink-700  hover:bg-white/90 hover:text-pink-500
        rounded-lg hover:shadow-sm hover:shadow-slate-300/55 transition-all ease-in-out duration-200"
      >
        Következő
      </button>
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