<script setup>
import { storage } from '@utils/http.mjs';
</script>

<template>
  <div class="container mx-auto px-4 py-8 md:py-12 lg:py-16 xl:py-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 xl:gap-48 items-center lg:w-7xl xl:w-full mx-auto">

      <div class="order-2 lg:order-1 text-center lg:text-left space-y-6 lg:space-y-8">
        <div class="space-y-6">
          <h2 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-white leading-relaxed
            pb-1">
            <span class="block text-pink-400">Retro élmény,</span>
            <span class="block bg-gradient-to-r from-slate-200 to-slate-400 bg-clip-text text-transparent">
              Modern környezet
            </span>
          </h2>

          <div
            class="w-1/3 md:w-1/2 lg:w-24 xl:w-40 h-1 lg:h-1.5 xl:h-2 bg-gradient-to-r from-pink-500 via-pink-700 to-pink-500 mx-auto lg:mx-0 rounded-full">
          </div>

          <p class="pt-1 text-lg md:text-xl lg:text-2xl text-slate-300 font-medium max-w-md mx-auto lg:mx-0">
            Élvezd a klasszikus autósmozi hangulatának találkozását a 21. század kényelmével
          </p>
        </div>

        <div class="w-4/5 md:w-2/3 lg:w-full h-0.5 bg-gradient-to-r from-slate-500/5  via-slate-700/10  to-slate-500/5  mx-auto lg:mx-0 rounded-full
            lg:from-slate-500/45 lg:via-slate-700/35 lg:to-slate-500/45 ">
        </div>

        <div class="grid grid-cols-2 md:flex-row gap-4 justify-center lg:justify-start w-full">

          <router-link :to="'/LocationChoose'" class="md:flex md:justify-end">
            <button class="order-2 lg:order-1 bg-gradient-to-r from-pink-600 to-pink-800 hover:from-pink-700 hover:to-pink-900
              border-2 border-pink-300/70 
               rounded-xl shadow-lg transform transition-all duration-300 hover:scale-105 hover:shadow-xl
              text-white font-semibold py-3 px-1 w-full me-0
              md:w-fit md:px-6 md:text-base
              lg:w-full lg:text-lg
              ">
              Jegyvásárlás
            </button>
          </router-link>


          <router-link :to="'/movies/SpecialWeek'" class="md:flex md:justify-start">
            <button class="order-1 lg:order-2 bg-slate-700 hover:bg-slate-600 rounded-xl border-2 border-slate-400/65
              transition-all duration-300 hover:border-slate-400
            text-white font-semibold py-3 px-1 w-full
              md:w-fit md:px-6 md:text-base
              lg:w-full lg:text-lg
              ">
              Heti vetítések
            </button>
          </router-link>
        </div>
      </div>

      <div class="order-1 lg:order-2">
        <div
          class="shadow-indigo-400/30 max-w-lg mx-auto lg:w-full xl:max-w-7xl relative rounded-2xl overflow-hidden shadow-2xl bg-gradient-to-br from-slate-800 to-slate-900 border-4 border-slate-600">
          <img :src="storage.url('img/cinema.png')"  alt="Egy férfi és egy nő a CinemaRoad mozijában filmet néz egy popcorn társaságában, romantikusan."
            class="w-full h-64 sm:h-80 md:h-96 lg:h-[500px] xl:h-[600px] object-cover" />

          <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>

          <div class="absolute bottom-2 md:bottom-4 left-4 right-4">
            <div class="bg-black/60 backdrop-blur-sm rounded-lg p-2 border border-slate-500 mx-auto w-fit
              md:px-4 md:w-full">
              <p class="text-white text-xs font-medium  
                md:text-base md:tracking-wide lg:text-lg lg:text-center
                ">
                🍿 Randi ötlet keresel? Ez tuti beválik, <router-link :to="'/movies/MovieWeek/1'"
                  class="text-pink-500 underline underline-offset-2">csekkold!</router-link>
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>