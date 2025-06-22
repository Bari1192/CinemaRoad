<template>
  <BaseHeader />
  <div class="mx-auto w-full min-h-screen">
    <div class="container mx-auto w-full h-full">
      <h1 class="text-6xl my-10 text-white">Welcome banner</h1>

      <div class="container mx-auto w-full">

        <div class="container w-full mx-auto my-8">
          <div class="grid grid-cols-2 w-full h-full mx-auto text-center items-center">

            <div
              class="w-full h-full text-center items-center min-h-[400px] flex justify-center mx-auto font-extrabold text-3xl text-white bg-slate-500">
              SZÖVEG HELYE</div>

            <div
              class="w-full text-center items-center mx-auto min-h-[400px] flex justify-center font-extrabold text-3xl text-white bg-pink-800">
              Kép helye</div>

          </div>
        </div>
      </div>
    </div>
    <div class="banner_slider mx-auto min-w-full min-h-72 bg-slate-700/15 py-8 ">
      <div class="grid grid-cols-6 w-full h-full mx-auto items-center gap-2">

        <div
          class="card relative gap-2 flex justify-center items-center text-pink-300 bg-slate-600 w-full min-h-[16rem] border-2 border-rose-100 text-2xl font-semibold">
          Vakasszony Visszanéz <p class="text-black/80"> 2</p>
          <span
            class="horror-label absolute bg-red-600 shadow-lg text-lg tracking-wider font-semibold py-2 px-3 text-white right-0 top-0 overflow-hidden rounded-bl-lg rounded-tr-lg">
            Horror
          </span>
        </div>

        <div
          class="card relative gap-2 flex justify-center items-center text-pink-100 bg-slate-600 w-full min-h-[16rem] border-2 border-rose-100 text-2xl font-semibold">
          Árvaházi Szülői
          <span
            class="horror-label absolute bg-yellow-600 shadow-lg text-lg tracking-wider font-semibold py-2 px-3 text-white right-0 top-0 overflow-hidden rounded-bl-lg rounded-tr-lg">
            Vígjáték
          </span>
        </div>

        <div
          class="card relative gap-2 flex justify-center items-center text-pink-100 bg-slate-600 w-full min-h-[16rem] border-2 border-rose-100 text-2xl font-semibold">
          rm -rf ./, right?
          <span
            class="horror-label absolute bg-sky-600 shadow-lg text-lg tracking-wider font-semibold py-2 px-3 text-white right-0 top-0 overflow-hidden rounded-bl-lg rounded-tr-lg">
            Dráma
          </span>
        </div>

        <div
          class="card relative gap-2 flex justify-center items-center text-pink-100 bg-slate-600 w-full min-h-[16rem] border-2 border-rose-100 text-2xl font-semibold">
          rebase --force
          <span
            class="horror-label absolute bg-emerald-600 shadow-lg text-lg tracking-wider font-semibold py-2 px-3 text-white right-0 top-0 overflow-hidden rounded-bl-lg rounded-tr-lg">
            Természetfilm
          </span>
        </div>

        <div
          class="card relative gap-2 flex justify-center items-center text-pink-100 bg-slate-600 w-full min-h-[16rem] border-2 border-rose-100 text-2xl font-semibold">
          upstream origin
          <span
            class="horror-label absolute bg-sky-600 shadow-lg text-lg tracking-wider font-semibold py-2 px-3 text-white right-0 top-0 overflow-hidden rounded-bl-lg rounded-tr-lg">
            Dráma
          </span>
        </div>

        <div
          class="card relative gap-2 flex justify-center items-center text-pink-100 bg-slate-600 w-full min-h-[16rem] border-2 border-rose-100 text-2xl font-semibold">
          push --force
          <span
            class="horror-label absolute bg-red-600 shadow-lg text-lg tracking-wider font-semibold py-2 px-3 text-white right-0 top-0 overflow-hidden rounded-bl-lg rounded-tr-lg">
            Horror
          </span>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
import BaseHeader from "@components/layout/BaseHeader.vue";
import { ref } from "vue";

</script>

<style>
.card {
  position: relative;
  border: 3px solid #f43f5e;
  border-radius: 12px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}
</style>