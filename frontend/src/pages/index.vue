<script setup>
import BaseHeader from "@components/layout/BaseHeader.vue";
import MovieThemes from "@components/layout/MovieThemes.vue";
import ClickBanner from "@components/layout/ClickBanner.vue";
import BaseFooter from "@components/layout/BaseFooter.vue";
import BaseCard from "@components/layout/BaseCard.vue";
import RetroCTA from "@components/layout/RetroCTA.vue";
</script>


<template>
  <BaseHeader />
  <div class="mx-auto w-full min-h-screen">

    <ClickBanner />
    
    
    <div class="container mx-auto w-full h-full mb-20"> <!-- MY 20!!! -->
    <RetroCTA />
    </div>
    <div class="container mx-auto w-full h-full my-20"> <!-- MY 20!!! -->
      <div
        class="card mx-auto px-6 lg:px-0 w-full lg:w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 justify-center gap-6 md:gap-8 
        lg:gap-6 xl:gap-10">
        <BaseCard :title="'Steel Horizon'" :type="'action'"
          :description="'Lélegzetelállító harci jelenetek, robbanások, hősök és egy mindenre elszánt harcos.'"
          :src="'src/assets/img/action.png'" :alt="'Autós üldözés'" />

        <BaseCard :title="'Autós üldözés'" :type="'family'"
          :description="'A természet lágy ölén a gondtalan gyermekek új kalandra hívnak a varázslatos elemek világába!'"
          :src="'src/assets/img/family.png'" :alt="'The Magical Meadow'" />

        <BaseCard :title="'A nevetés főútján'" :type="'comedy'"
          :description="'Egészestés vígjáték a 90-es évek mindennapjaiból, melyek napjainkra is kihatással vannak.'"
          :src="'src/assets/img/comedy.png'" :alt="'Egészestés vígjáték - A nevetés főútján'" />

        <BaseCard :title="'Baljós árnyak'" :type="'horror'"
          :description="'A sötétség magányában csak magadra számíthatsz. A hangok a fejedből, vagy az éj lepléből szállnak?'"
          :src="'src/assets/img/horror.png'" :alt="'Baljós árnyak - horrofilm, kizárólag felnőtteknek.'" />
      </div>


    </div>


    <div class="my-40">
      <MovieThemes />
    </div>

  </div>

  <BaseFooter />
</template>
