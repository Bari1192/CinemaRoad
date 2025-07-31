<template>
  <BaseLayout>
    <h1 class="text-5xl font-semibold text-center py-10">Regisztráció</h1>

    <div class="w-8/12 mx-auto border border-pink-600 p-6 rounded-lg">
      <FormKit type="form" :actions="false" @submit="handleRegistration">

        <div class="flex flex-col gap-4 md:flex-row mb-4">
          <div class="w-full md:w-1/2">
            <FormKit v-model="name" type="text" name="name" label="Teljes Név" label-class="text-xl"
              input-class="rounded-lg p-2 w-full" validation="alpha_spaces" />
          </div>
          <div class="w-full md:w-1/2">
            <FormKit v-model="email" type="email" name="email" label="E-mail" label-class="text-xl"
              input-class="rounded-lg p-2 w-full" validation="email" />
          </div>
        </div>

        <div class="flex flex-col gap-4 md:flex-row mb-6">
          <div class="w-full md:w-1/2">
            <FormKit v-model="phone" type="text" name="phone" label="Telefonszám" label-class="text-xl"
              input-class="rounded-lg p-2 w-full" />
          </div>
          <div class="w-full md:w-1/2">
            <FormKit v-model="password" type="password" name="password" label="Jelszó" label-class="text-xl"
              input-class="rounded-lg p-2 w-full" />
          </div>
        </div>

        <div class="text-center">
          <button
            class="bg-gray-800 text-pink-600 py-3 px-6 rounded-lg text-xl font-semibold w-full md:w-auto">Regisztráció</button>
        </div>

      </FormKit>
    </div>
  </BaseLayout>
</template>

<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';
import { useUserStore } from '@stores/UserStore';

import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const userStore = useUserStore();

const name = ref('');
const email = ref('');
const phone = ref('');
const password = ref('');

const handleRegistration = async () => {
  try {
    console.log("Regisztráció megkezdése...");

    await userStore.registerUser({
      name: name.value,
      email: email.value,
      phone: phone.value,
      password: password.value
    });

    router.push("/Login")
  } catch (error) {
    console.error("Hiba a regisztráció során: ", error)
  }
}
</script>