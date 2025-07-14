<script setup>
import BaseHeader from "@components/layout/BaseHeader.vue";
import MovieThemes from "@components/layout/MovieThemes.vue";
import ClickBanner from "@components/layout/ClickBanner.vue";
import BaseFooter from "@components/layout/BaseFooter.vue";
import BaseCard from "@components/layout/BaseCard.vue";
</script>


<template>
  <BaseHeader />
  <div class="mx-auto w-full min-h-screen">

    <ClickBanner />

    <div class="container mx-auto w-full h-full">

      <div class="mx-auto w-full h-full bg-slate-950 py-8 flex justify-center">
        <div class="w-full md:lg:max-w-5xl lg:max-w-[1920px] grid grid-cols-1 gap-12 px-10 sm:grid-cols-2 lg:gap-6 lg:grid-cols-4">
          <BaseCard :title="'Autós üldözés'" :type="'Akció'"
            :description="'Lélegzetelállító kocsis üldözések, menekülés és adrenalin—csak a legbátrabbaknak.'"
            :src="'https://d32qys9a6wm9no.cloudfront.net/images/movies/poster/d6/20249e4b290423cd14d4fbb932faa88a_500x735.jpg?t=1725823421'"
            :alt="'Autós üldözés'" />
          <BaseCard :title="'Autós üldözés'" :type="'Akció'"
            :description="'Lélegzetelállító kocsis üldözések, menekülés és adrenalin—csak a legbátrabbaknak.'"
            :src="'https://d32qys9a6wm9no.cloudfront.net/images/movies/poster/d6/20249e4b290423cd14d4fbb932faa88a_500x735.jpg?t=1725823421'"
            :alt="'Autós üldözés'" />
          <BaseCard :title="'Autós üldözés'" :type="'Akció'"
            :description="'Lélegzetelállító kocsis üldözések, menekülés és adrenalin—csak a legbátrabbaknak.'"
            :src="'https://d32qys9a6wm9no.cloudfront.net/images/movies/poster/d6/20249e4b290423cd14d4fbb932faa88a_500x735.jpg?t=1725823421'"
            :alt="'Autós üldözés'" />
          <BaseCard :title="'Autós üldözés'" :type="'Akció'"
            :description="'Lélegzetelállító kocsis üldözések, menekülés és adrenalin—csak a legbátrabbaknak.'"
            :src="'https://d32qys9a6wm9no.cloudfront.net/images/movies/poster/d6/20249e4b290423cd14d4fbb932faa88a_500x735.jpg?t=1725823421'"
            :alt="'Autós üldözés'" />
        </div>
      </div>

      <h1 class="text-6xl my-10 text-white">Welcome banner</h1>

      <div class="container mx-auto w-full my-12">

        <div class="container w-full max-w-screen-2xl  mx-4">
          <div class="grid grid-cols-2 w-full h-full mx-auto text-center items-center">

            <div
              class="w-full h-full text-center items-center min-h-[400px] flex justify-center mx-auto font-extrabold text-3xl text-white bg-slate-500">
              [Jobb kép] AI kép autóból kitekintés Mozivászon irányába. Popcorn evés, férfi + nő. nézőpont a hátuk
              mögül.</div>
            [Bal szöveg] "Retro élmény, modern környezet"
            <div
              class="w-full text-center items-center mx-auto min-h-[400px] flex justify-center font-extrabold text-3xl text-white bg-pink-800">
              <img
                src="https://m.media-amazon.com/images/S/pv-target-images/e900fe5f2785b76c68d73b55e5a13812b85802fab074972bf96990c38077f106.jpg"
                class="w-full max-h-[700px]">

            </div>

          </div>
        </div>
      </div>
    </div>


    <MovieThemes class="my-32" />

  </div>

  <BaseFooter />
</template>



<style>
.card {
  position: relative;
  border-radius: 12px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}
</style>