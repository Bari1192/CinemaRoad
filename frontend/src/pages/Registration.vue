<template>
    <BaseLayout>
      <h1 class="text-5xl font-semibold text-center py-10">Regisztráció</h1>
  
      <div class="w-8/12 mx-auto border border-pink-600 p-6 rounded-lg">
        <FormKit type="form" :actions="false">
  
          <div class="flex flex-col gap-4 md:flex-row mb-4">
            <div class="w-full md:w-1/2">
              <FormKit
                type="text"
                name="name"
                label="Teljes Név"
                label-class="text-xl"
                input-class="rounded-lg p-2 w-full"
              />
            </div>
            <div class="w-full md:w-1/2">
              <FormKit
                type="email"
                name="email"
                label="E-mail"
                label-class="text-xl"
                input-class="rounded-lg p-2 w-full"
              />
            </div>
          </div>
  
          <div class="flex flex-col gap-4 md:flex-row mb-6">
            <div class="w-full md:w-1/2">
              <FormKit
                type="text"
                name="phone"
                label="Telefonszám"
                label-class="text-xl"
                input-class="rounded-lg p-2 w-full"
              />
            </div>
            <div class="w-full md:w-1/2">
              <FormKit
                type="password"
                name="password"
                label="Jelszó"
                label-class="text-xl"
                input-class="rounded-lg p-2 w-full"
              />
            </div>
          </div>
  
          <div class="text-center">
            <button class="bg-gray-800 text-pink-600 py-3 px-6 rounded-lg text-xl font-semibold w-full md:w-auto">Regisztráció</button>
          </div>
  
        </FormKit>
      </div>
    </BaseLayout>
  </template>
  
  <script setup>
  import BaseLayout from '@layouts/BaseLayout.vue'
  </script>
  