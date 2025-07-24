<script setup>
import { useDriveInCinemaStore } from '@stores/DriveInCinemaStore.mjs'
import { useTicketStore } from '@stores/TicketStore.js'
import { useRouter } from 'vue-router'
import { ref, onMounted, computed } from 'vue'

import BaseLayout from '@layouts/BaseLayout.vue'
import BaseCardNavigate from '@components/layout/BaseCardNavigate.vue'
import Stepper from '@components/layout/Stepper.vue'
// import BaseSpinner ha van sajátod

const driveincinemaStore = useDriveInCinemaStore()
const ticketStore = useTicketStore()
const router = useRouter()

const isLoading = ref(true)  // Loader flag

async function fetchCinemas() {
  isLoading.value = true
  await driveincinemaStore.getDriveInCinemas()
  isLoading.value = false
}

function selectCinema(cinema) {
  ticketStore.setLocation(cinema)
  ticketStore.setLocationName(cinema.name)
  router.push('/Selector')
}

const cinemas = computed(() => driveincinemaStore.driveInCinemas || [])  // SAFETY net

onMounted(async () => {
  await fetchCinemas()
})
</script>

<template>
  <BaseLayout>
    <Stepper :currentStep="0" />

    <h1 class="text-3xl mt-40">Kérlek, válaszd ki a helyszínt, ahova menni szeretnél.</h1>

    <div class="relative max-w-md my-40 mx-auto group inline-black">
      <div class="absolute inset-0 rounded-2xl bg-indigo-300/70 blur-2xl opacity-0 group-hover:opacity-60 transition-opacity duration-300 -z-10"></div>
      <!-- LOADER / HIBAELHÁRÍTÁS -->
      <div v-if="isLoading">
        <div class="text-center p-8 text-pink-800">Betöltés...</div>
      </div>
      <!-- NINCS MOZIK -->
      <div v-else-if="cinemas.length === 0">
        <div class="text-red-600 text-center p-8">Nincs elérhető mozihelyszín!</div>
      </div>
      <!-- LISTA -->
      <div v-else>
        <div v-for="cinema in cinemas" :key="cinema.id" @click="selectCinema(cinema)">
          <BaseCardNavigate :title="cinema.name"
            :src="'/starfield_autosmozi.jpg'"
            :alt="cinema.name"
            :description="cinema.description || ''"
            class="max-w-xs md:max-w-md my-40 mx-auto" />
        </div>
      </div>
    </div>
  </BaseLayout>
</template>