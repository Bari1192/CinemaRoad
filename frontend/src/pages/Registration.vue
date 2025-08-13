<template>
  <BaseLayout>
    <h1 class="text-5xl font-semibold text-center py-10">Regisztráció</h1>

    <div class="w-8/12 mx-auto border border-pink-600 p-6 mb-10 rounded-lg">
      <FormKit type="form" :actions="false" @submit="handleRegistration">
        <div class="space-y-4">
          <FormKit type="text" name="name" label="Teljes vév" v-model="form.name" validation="required"
            input-class="form-input w-full p-3 rounded-lg border border-gray-300 text-black"
            label-class="text-pink-600 block mb-1 text-lg font-semibold" />

          <FormKit type="email" name="email" label="Email cím" v-model="form.email"
            input-class="form-input w-full p-3 rounded-lg border border-gray-300 text-black"
            label-class="text-pink-600 block mb-1 text-lg font-semibold"
            :validation="[['required'], ['matches', emailRegex]]"
            :validation-messages="{ matches: 'Kérlek, valós Email-t adj meg!' }"
            :validation-visibility="dirty"/>

          <FormKit type="text" name="phone" label="Telefonszám" v-model="form.phone"
            input-class="form-input w-full p-3 rounded-lg border border-gray-300 text-black"
            label-class="text-pink-600 block mb-1 text-lg font-semibold"
            :validation="[['required'], ['matches', phoneRegex]]"
            :validation-messages="{ matches: 'A telefonszám csak 06, vagy +36-al kezdődhet!' }"
            :validation-visibility="dirty"/>

          <FormKit type="password" name="password" label="Jelszó" v-model="form.password"
            input-class="form-input w-full p-3 rounded-lg border border-gray-300 text-black"
            label-class="text-pink-600 block mb-1 text-lg font-semibold"
            :validation="[['required'], ['matches', passwordRegex]]"
            :validation-messages="{ matches: 'A jelszónak tartalmaznia kell legalább egy nagybetűt, egy számot és egy speciális karaktert.' }"
            :validation-visibility="dirty"/>

          <FormKit type="password" name="password_confirm" label="Jelszó újra" v-model="form.password_confirm"
            validation="required|confirm" validation-visibility="dirty" validation-label="Jelszó megerősítés"
            input-class="form-input w-full p-3 rounded-lg border border-gray-300 text-black"
            label-class="text-pink-600 block mb-1 text-lg font-semibold" />

          <div class="text-center pt-4">
            <button class="bg-white text-pink-600 py-3 px-6 rounded-lg text-xl font-semibold w-full sm:w-auto">
              Regisztráció
            </button>
          </div>
        </div>
      </FormKit>
    </div>
  </BaseLayout>
</template>

<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';
import { useUserStore } from '@stores/UserStore';

import { cloneVNode, ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const userStore = useUserStore();

const emailRegex = /^[a-zA-Z0-9._%+-]+@(gmail|freemail|yahoo|citromail|aoutlook)\.(com|hu)$/;
const phoneRegex = /^(\+36|06)(20|30|40|70)\d{7}$/;
const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*_])[A-Za-z\d!@#$%^&*_]{8,}$/;


const form = ref({
  name: '',
  email: '',
  phone: '',
  password: '',
  password_confirm: ''
});

const handleRegistration = async () => {
  try {
    console.log("Regisztráció megkezdése...");

    await userStore.registerUser({
      name: form.value.name,
      email: form.value.email,
      phone: form.value.phone,
      password: form.value.password
    });

    router.push("/Login")
  } catch (error) {
    console.error("Hiba a regisztráció során: ", error)
  }
}
</script>

<style>
.formkit-message {
  color: white;
}
</style>






