<template>
  <BaseLayout>
    <Stepper :currentStep="0" />
    <h1 class="text-4xl md:text-5xl font-bold text-pink-600 text-center drop-shadow-lg mt-10">Kérlek, válaszd ki a
      helyszínt, ahova menni szeretnél.</h1>
    <div class="relative  grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-4">
      <div v-for="cinema in driveincinemaStore.driveInCinemas" :key="cinema.id" @click="selectCinema(cinema)"
        class="relative group">

        <div class="relative max-w-md  mx-auto group inline-black">
          <!-- Blur div -->
          <div
            class="absolute inset-0 rounded-2xl bg-indigo-300/70 blur-2xl opacity-0 group-hover:opacity-60 transition-opacity duration-300 -z-10">
          </div>
          <div @click="selectCinema(cinema)">
            <BaseCard :title="cinema.name" :displayLocationName="true" :locationName="cinema.location" :button_text="'Mozi kiválasztása'" 
            :src="storage.url(`/img/${cinema.name}.jpg`)" :alt="cinema.name" :description="''"
              :type_visible="false" class="max-w-xs md:max-w-md my-10 mx-auto" />
          </div>
        </div>
      </div>
    </div>

  </BaseLayout>
</template>

<script setup>
import { useDriveInCinemaStore } from '@stores/DriveInCinemaStore'
import { useTicketStore } from '@stores/TicketStore.js'
import { useRouter } from 'vue-router'
import { onMounted } from 'vue'

import BaseLayout from '@layouts/BaseLayout.vue'
import BaseCard from '@components/BaseCard.vue'
import Stepper from '@components/layout/Stepper.vue'
import Button from 'primevue/button'

import { storage } from '@utils/http.mjs'

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