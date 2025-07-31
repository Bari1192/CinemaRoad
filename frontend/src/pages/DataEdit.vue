<template>
    <BaseLayout>
        <div class="m-5 w-full max-w-xl mx-auto my-10 bg-slate-700 rounded-xl shadow-md text-white p-4 sm:p-8">
            <h1 class="text-3xl font-bold text-pink-600 text-center mb-6">Saját adataim módosítása</h1>

            <FormKit type="form" :actions="false" @submit="submitForm">
                <div class="space-y-4">
                    <FormKit type="email" name="email" label="Email cím" v-model="form.email"
                        validation="required|email"
                        input-class="form-input w-full p-3 rounded-lg border border-gray-300 text-black"
                        label-class="text-pink-600 block mb-1 text-lg font-semibold" />

                    <FormKit type="text" name="phone" label="Telefonszám" v-model="form.phone"
                        input-class="form-input w-full p-3 rounded-lg border border-gray-300 text-black"
                        label-class="text-pink-600 block mb-1 text-lg font-semibold" />

                    <FormKit type="password" name="password" label="Jelszó" v-model="form.password"
                        validation="required" validation-visibility="dirty"
                        input-class="form-input w-full p-3 rounded-lg border border-gray-300 text-black"
                        label-class="text-pink-600 block mb-1 text-lg font-semibold" />

                    <FormKit type="password" name="password_confirm" label="Jelszó újra" v-model="form.password_confirm"
                        validation="required|confirm" validation-visibility="dirty"
                        validation-label="Jelszó megerősítés"
                        input-class="form-input w-full p-3 rounded-lg border border-gray-300 text-black"
                        label-class="text-pink-600 block mb-1 text-lg font-semibold" />

                    <div class="text-center pt-4">
                        <button
                            class="bg-white text-pink-600 py-3 px-6 rounded-lg text-xl font-semibold w-full sm:w-auto">
                            Mentés
                        </button>
                    </div>
                </div>
            </FormKit>
        </div>
    </BaseLayout>
</template>

<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';
import { useUserStore } from '@stores/UserStore.js';
import { ref, onMounted } from 'vue';

const userStore = useUserStore();

const form = ref({
    email: '',
    phone: '',
    password: '',
    password_confirm: ''
});

onMounted(async () => {
    await userStore.getUser();

    form.value.email = userStore.userData.email || '';
    form.value.phone = userStore.userData.phone || '';
});

async function submitForm() {
    const data = {
        email: form.value.email,
        phone: form.value.phone,
        password: form.value.password
    };

    try {
        await userStore.updateUserData(userStore.userID, data);
        alert('Sikeresen frissítve!');
    } catch (err) {
        console.error('Hiba frissítés közben:', err);
        alert('Hiba történt a frissítés során.');
    }
}
</script>