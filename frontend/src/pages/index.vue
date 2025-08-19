<script setup>
import BaseHeader from "@components/layout/BaseHeader.vue";
import MovieThemes from "@components/layout/MovieThemes.vue";
import ClickBanner from "@components/layout/ClickBanner.vue";
import BaseFooter from "@components/layout/BaseFooter.vue";
import BaseCard from "@components/BaseCard.vue";
import RetroCTA from "@components/layout/RetroCTA.vue";
import { useDriveInCinemaStore } from "@stores/DriveInCinemaStore";
import { useMovieStore } from "@stores/MovieStore.mjs";
import { useScreeningStore } from "@stores/ScreeningStore.mjs";
import { onMounted, ref } from "vue";

const driveInCinemas = useDriveInCinemaStore();
const screenings = useScreeningStore();
const movies = useMovieStore();
const loading = ref(false);

onMounted(async () => {
  loading.value = true;
  try {
    await screenings.getScreenings();
    await movies.getMovies();
    await driveInCinemas.getDriveInCinemas();
  } catch (error) {
    console.log('Hiba a főoldalon -> adatok lekérésében', error.value);
  } finally {
    loading.value = false;
  }
});
</script>


<template>
  <BaseHeader />
  <div class="mx-auto w-full min-h-screen">

    <ClickBanner />


    <div class="container mx-auto w-full h-full mb-20 md:mb-8">
      <RetroCTA />
    </div>

    <div class="container mx-auto w-full h-full mb-8">
      <div class="card mx-auto px-6 w-fit lg:w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 justify-center gap-6 md:gap-8 
        lg:gap-6 xl:gap-10">
        <BaseCard :title="'Steel Horizon'" :type="'action'"
          :description="'Lélegzetelállító harci jelenetek, robbanások, hősök és egy mindenre elszánt harcos.'"
          :src="'src/assets/img/action.png'" :alt="'Autós üldözés'" :img_size_class="'object-cover overflow-hidden'"
          :cta="true" :link="'/movies/SpecialWeek'" />

        <BaseCard :title="'Autós üldözés'" :type="'family'"
          :description="'A természet lágy ölén a gondtalan gyermekek új kalandra hívnak a varázslatos elemek világába!'"
          :src="'src/assets/img/family.png'" :alt="'The Magical Meadow'"
          :img_size_class="' object-cover overflow-hidden'" :cta="true" :link="'/movies/SpecialWeek'" />


        <BaseCard :title="'Baljós árnyak'" :type="'horror'"
          :description="'A sötétség magányában csak magadra számíthatsz. A hangok a fejedből, vagy az éj lepléből szállnak?'"
          :src="'src/assets/img/horror.png'" :alt="'Baljós árnyak - horrofilm, kizárólag felnőtteknek.'"
          :img_size_class="'object-cover overflow-hidden'" :cta="true" :link="'/movies/SpecialWeek'" />

        <BaseCard :title="'Premier Filmek a Héten'" :type="'premier'"
          :description="'Elsők között néznéd meg várva várt mozifilmed? Nézd meg még premier előtt!'"
          :src="'src/assets/img/news.webp'" :alt="'Premier Filmek a Héten'"
          :img_size_class="'object-cover overflow-hidden'" :cta="true" :link="'/movies/SpecialWeek'" />
      </div>
    </div>
    <div class="my-40 mx-4">
      <MovieThemes />
    </div>

  </div>

  <BaseFooter />
</template>
