<template>
  <BaseLayout>
    <Stepper :currentStep="0" />
    <h1 class="text-4xl md:text-5xl font-bold text-pink-600 text-center drop-shadow-lg mt-40 pb-12">Kérlek, válaszd ki a
      helyszínt, ahova menni szeretnél.</h1>
    <div class="relative my-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-4">
      <div v-for="cinema in driveincinemaStore.driveInCinemas" :key="cinema.id" @click="selectCinema(cinema)"
        class="relative group">
        <!-- Blur div -->
        <div
          class="absolute inset-0 rounded-2xl bg-indigo-300/70 blur-2xl opacity-0 group-hover:opacity-60 transition-opacity duration-300 -z-10">
        </div>

        <BaseCard :title="cinema.name" :src="'/starfield_autosmozi.jpg'" :alt="cinema.name" :description="''"
          :type_visible="false" class="w-full h-full block" />
      </div>
    </div>

  </BaseLayout>
</template>

<script setup>
import { useDriveInCinemaStore } from '@stores/DriveInCinemaStore.mjs'
import { useTicketStore } from '@stores/TicketStore.js'
import { useRouter } from 'vue-router'
import { onMounted } from 'vue'

import BaseLayout from '@layouts/BaseLayout.vue'
import BaseCard from '@components/BaseCard.vue'
import Stepper from '@components/layout/Stepper.vue'

const driveincinemaStore = useDriveInCinemaStore()
const ticketStore = useTicketStore()
const router = useRouter()

function selectCinema(cinema) {
  ticketStore.setLocation(cinema)
  ticketStore.setLocationName(cinema.name)
  router.push('/Selector')
}

onMounted(() => {
  driveincinemaStore.getDriveInCinemas()
})
</script>