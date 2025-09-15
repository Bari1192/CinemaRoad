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
import { storage } from "@utils/http.mjs";

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
      <div class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-white leading-relaxed
            pb-1 w-10/12 md:w-3/4 lg:w-2/3 space-y-2 mx-auto lg:mb-6">
        <p
          class="flex text-2xl lg:text-5xl justify-start text-white pb-1 md:pb-2 lg:pb-4 lg:mb-6 border-b-4 border-pink-500 w-fit">
          Hamarosan a kínálatban</p>
        <p class="inline-block text-2xl lg:text-5xl justify-end bg-gradient-to-r from-amber-300 via-orange-300 to-amber-400 
        bg-clip-text text-transparent md:pt-1 lg:pt-0 pb-6 border-pink-500 w-full text-end">
          Csekkold a
          <router-link to="/movies/PremierWeek" class="hover:text-amber-300 transition-colors duration-200 ease-in-out"> premier filmeket </router-link>
          <span class="text-rose-500/90 font-extrabold text-2xl lg:text-5xl">!</span>
        </p>
      </div>
      <div class="card mx-auto px-6 w-fit lg:w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 justify-center gap-6 md:gap-8 
        lg:gap-6 xl:gap-10">
        <router-link to="/movies/PremierWeek">
          <BaseCard :title="'Steel Horizon'" :type="'Akció'" :age_limit="16" :class="'text-gray-900 font-extrabold'"
            :description="'Lélegzetelállító harci jelenetek, robbanások, hősök és egy mindenre elszánt harcos.'"
            :src="storage.url(`/img/action.png`)" :alt="'Autós üldözés'"
            :img_size_class="'object-cover overflow-hidden'" :cta="true" :link="'/movies/PremierWeek'" />
        </router-link>

        <router-link to="/movies/PremierWeek">
          <BaseCard :title="'The Magical Meadow'" :type="'Családi'" :age_limit="12"
            :class="'text-yellow-700 font-extrabold'"
            :description="'A természet lágy ölén a gondtalan gyermekek új kalandra hívnak a varázslatos elemek világába!'"
            :src="storage.url(`/img/family.png`)" :alt="'The Magical Meadow'"
            :img_size_class="' object-cover overflow-hidden'" :cta="true" :link="'/movies/PremierWeek'" />
        </router-link>

        <router-link to="/movies/PremierWeek">
          <BaseCard :title="'Baljós árnyak'" :type="'Horror'" :age_limit="18" :class="'text-red-900 font-extrabold'"
            :description="'A sötétség magányában csak magadra számíthatsz. A hangok a fejedből, vagy az éj lepléből szállnak?'"
            :src="storage.url(`/img/horror.png`)" :alt="'Baljós árnyak - horrofilm, kizárólag felnőtteknek.'"
            :img_size_class="'object-cover overflow-hidden'" :cta="true" :link="'/movies/PremierWeek'"
            :button_text="'Hamarosan'" />
        </router-link>

        <router-link to="/movies/PremierWeek">
          <BaseCard :title="'Premier Filmek a Héten'" :type="'Premierek'"
            :description="'Elsők között néznéd meg várva várt mozifilmed? Nézd meg még premier előtt!'"
            :src="storage.url(`/img/news.webp`)" :alt="'Premier Filmek a Héten'"
            :img_size_class="'object-cover overflow-hidden'" :cta="true" :link="'/movies/PremierWeek'" />
        </router-link>
      </div>
    </div>
    <div class="my-40 mx-4">
      <MovieThemes />
    </div>

  </div>

  <BaseFooter />
</template>
