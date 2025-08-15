<template>
  <BaseLayout>
    <div class="flex flex-col items-center justify-center min-h-[70vh] text-center px-4">
      <div class="bg-pink-100 rounded-3xl p-8 shadow-xl max-w-lg w-full">

        <svg class="w-20 h-20 mx-auto mb-4 text-pink-600" xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12l2 2l4-4M12 2a10 10 0 100 20a10 10 0 000-20z" />
        </svg>

        <h1 v-if="userIsLoggedIn" class="text-3xl md:text-4xl font-bold text-pink-700 mb-2">Köszönjük a foglalásod!</h1>
        <h1 v-else class="text-3xl md:text-4xl font-bold text-pink-700 mb-2">Köszönjük a vásárlásod!</h1>
        <p class="text-gray-700 mb-6 text-lg md:text-xl">A helyszínen találkozunk, és jó szórakozást kívánunk!</p>
        <button @click="goHome"
          class="px-6 py-3 bg-pink-600 text-white font-semibold rounded-lg shadow-md hover:bg-pink-500 transition">
          Vissza a főoldalra
        </button>
      </div>
    </div>
  </BaseLayout>
</template>

<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';
import { useUserStore } from '@stores/UserStore';
import { onMounted, computed } from 'vue';
import { useRouter } from 'vue-router';

const userStore = useUserStore();
const userIsLoggedIn = computed(() => userStore.isUserLoggedIn);

const router = useRouter();

const goHome = () => router.push('/');

onMounted(async () => {
  await userStore.getUser();
})
</script>