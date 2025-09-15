<template>
  <BaseLayout>
    <div
  class="w-full max-w-lg mx-4 sm:mx-auto my-10 bg-gray-700 p-6 sm:p-10 rounded-2xl shadow-xl border border-pink-200 box-border">


      <h1 class="text-4xl font-bold text-pink-600 text-center mb-8 drop-shadow-sm">
        Regisztráció
      </h1>

      <FormKit type="form" :actions="false" @submit="handleRegistration" class="space-y-6">
        <!-- Név -->
        <FormKit type="text" name="name" label="Teljes név" v-model="form.name" validation="required"
          :validation-visibility="'dirty'"
          input-class="form-input w-full p-3 pl-10 rounded-xl border border-gray-300 text-gray-900 focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
          label-class="text-pink-600 block mb-1 text-lg font-semibold">

        </FormKit>

        <!-- Email -->
        <FormKit type="email" name="email" label="Email cím" v-model="form.email"
          :validation="[['required'], ['matches', emailRegex]]"
          :validation-messages="{ matches: 'Kérlek, valós Email-t adj meg!' }" :validation-visibility="'dirty'"
          input-class="form-input w-full p-3 pl-10 rounded-xl border border-gray-300 text-gray-900 focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
          label-class="text-pink-600 block mb-1 text-lg font-semibold">

        </FormKit>

        <!-- Telefon -->
        <FormKit type="text" name="phone" label="Telefonszám" v-model="form.phone"
          :validation="[['required'], ['matches', phoneRegex]]"
          :validation-messages="{ matches: 'A telefonszám csak 06, vagy +36-al kezdődhet!' }"
          :validation-visibility="'dirty'"
          input-class="form-input w-full p-3 pl-10 rounded-xl border border-gray-300 text-gray-900 focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
          label-class="text-pink-600 block mb-1 text-lg font-semibold">

        </FormKit>

        <!-- Jelszó -->
        <FormKit type="password" name="password" label="Jelszó" v-model="form.password"
          :validation="[['required'], ['matches', passwordRegex]]"
          :validation-messages="{ matches: 'A jelszónak tartalmaznia kell legalább egy nagybetűt, egy számot és egy speciális karaktert.' }"
          :validation-visibility="'dirty'"
          input-class="form-input w-full p-3 pl-10 rounded-xl border border-gray-300 text-gray-900 focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
          label-class="text-pink-600 block mb-1 text-lg font-semibold">

        </FormKit>

        <!-- Jelszó megerősítés -->
        <FormKit type="password" name="password_confirm" label="Jelszó újra" v-model="form.password_confirm"
          validation="required|confirm" validation-label="Jelszó megerősítés" :validation-visibility="'dirty'"
          input-class="form-input w-full p-3 pl-10 rounded-xl border border-gray-300 text-gray-900 focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
          label-class="text-pink-600 block mb-1 text-lg font-semibold">

        </FormKit>

        <!-- Gomb -->
        <div class="text-center pt-4">
          <button
            class="w-full bg-pink-600 text-white py-3 px-6 rounded-xl text-lg font-semibold shadow-md hover:bg-pink-700 hover:shadow-lg transition-all duration-300">
            Regisztráció
          </button>
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

const emailRegex = /^[a-zA-Z0-9._%+-]+@(gmail|freemail|yahoo|citromail|outlook)\.(com|hu)$/;
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
    const user = await userStore.registerUser({
      name: form.value.name,
      email: form.value.email,
      phone: form.value.phone,
      password: form.value.password,
    });

    console.log("Sikeres regisztráció:", user);

    router.push("/Login");

  } catch (error) {
    console.error("Hiba a regisztráció során:", error.response?.data || error);
  }
};
</script>

<style>
.formkit-message {
  color: #e11d48;
  font-size: 0.9rem;
  margin-top: 4px;
}
</style>
