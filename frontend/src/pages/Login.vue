<template>
    <BaseLayout>
        <h1 class="text-5xl font-semibold text-center py-10">Bejelentkezés</h1>

        <FormKit type="form" :actions="false">
            <div class="w-8/12 mx-auto border border-pink-600 p-6 rounded-lg">

                <div class="w-6/12 mx-auto mb-4">
                    <FormKit type="email" name="email" label="E-mail" label-class="text-xl"
                    input-class="rounded-lg p-2 w-full" />
                </div>

                <div class="w-6/12 mx-auto mb-4">
                    <FormKit type="password" name="password" label="Jelszó" label-class="text-xl"
                    input-class="rounded-lg p-2 w-full" />

                </div>

                <div class="text-center">
                    <button
                        class="bg-gray-800 text-pink-600 py-3 px-6 rounded-lg text-xl font-semibold w-4/12 md:w-1/3">Bejelentkezés</button>
                </div>


            </div>
        </FormKit>
    </BaseLayout>
</template>

<script setup>
import BaseLayout from '@layouts/BaseLayout.vue'
</script>