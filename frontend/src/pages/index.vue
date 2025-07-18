<script setup>
import BaseHeader from "@components/layout/BaseHeader.vue";
import MovieThemes from "@components/layout/MovieThemes.vue";
import ClickBanner from "@components/layout/ClickBanner.vue";
import MovieSlides from "@components/layout/MovieSlides.vue";
import BaseFooter from "@components/layout/BaseFooter.vue";
import RetroCTA from "@components/layout/RetroCTA.vue";
</script>


<template>
  <BaseHeader />
  <div class="mx-auto w-full min-h-screen">

    <ClickBanner />

    <MovieSlides />

    <RetroCTA />

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