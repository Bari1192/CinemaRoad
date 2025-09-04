<template>
    <BaseLayout>
        <!-- Fő tároló -->
        <div class="bg-gray-900 w-11/12 flex flex-col md:flex-row justify-center md:items-start my-10 gap-8 p-4 rounded-lg shadow-lg mx-auto">

            <!-- Kép div-->
            <div class="hidden md:flex justify-center md:justify-end w-full md:w-1/2">
                <img src="@/assets/img/LoginPagePicture.png" alt="LoginPagePicture" class="w-full h-auto md:min-w-[320px] md:max-w-[600px] rounded-lg shadow-md">
            </div>

            <!-- Tartalom div -->
            <div class="w-full md:w-2/3 flex justify-center my-auto ">
                <FormKit type="form" :actions="false" @submit="handleLogin" class="w-full md:max-w-3xl bg-orange-500">

                    <!-- Title -->
                     <h1 class="text-3xl text-pink-600 font-bold text-center mb-6">Bejelentkezés</h1>

                    <!-- Email -->
                    <div class="mb-5">
                        <FormKit v-model="email" type="email" name="email" label="E-mail" label-class="text-xl text-pink-600"
                            input-class="rounded-lg p-2 text-black w-full border-2 border-pink-700" validation="email" />
                    </div>

                    <!-- Jelszó -->
                    <div class="mb-4">
                        <FormKit v-model="password" type="password" name="password" label="Jelszó" label-class="text-xl text-pink-600"
                            input-class="rounded-lg text-black p-2 w-full border-2 border-pink-700" />
                    </div>

                    <!-- Regisztráció linkje -->
                    <div class="text-center">
                        <RouterLink class="text-pink-600" :to="'/Registration'">
                            Még nem regisztrált? Kattintson ide!
                        </RouterLink>
                    </div>

                    <!-- Hibaüzenet, HA van -->
                    <div v-if="errorMessage" class="text-red-600 text-center font-semibold mb-4">
                        {{ errorMessage }}
                    </div>

                    <!-- Login Gomb -->
                    <div class="text-center">
                        <button
                            class="bg-white text-pink-600 py-3 border-2 border-pink-700 mt-4 px-6 rounded-lg text-xl font-semibold max-w-[350px] md:w-auto">Bejelentkezés</button>
                    </div>

                </FormKit>
            </div>
        </div>
    </BaseLayout>
</template>

<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';
import { useUserStore } from '@stores/UserStore.js';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const userStore = useUserStore();

const email = ref('');
const password = ref('');
const errorMessage = ref('');

const handleLogin = async () => {
    errorMessage.value = '';

    try {
        console.log("Bejelentkezés megkezdése...");
        await userStore.logInUser({
            email: email.value,
            password: password.value
        });

        router.push("/");
    } catch (error) {
        errorMessage.value = 'Hibás E-mail vagy jelszó.';

    }


}
</script>

<style scoped>
.formkit-form {
    width: 75%;
}
</style>
