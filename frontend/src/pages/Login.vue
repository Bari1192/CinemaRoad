<template>
    <BaseLayout>
        <h1 class="text-5xl font-semibold text-center py-10">Bejelentkezés</h1>

        <div class="w-8/12 mx-auto border border-pink-600 p-6 rounded-lg">

            <FormKit type="form" :actions="false">

                <div class="w-full md:w-1/2 mx-auto">
                    <FormKit
                        type="email"
                        name="email"
                        label="E-mail"
                        label-class="text-xl"
                        input-class="rounded-lg p-2 w-full"
                        validation="email"
                        />
                </div>

                <div class="w-full md:w-1/2 mx-auto">
                    <FormKit
                        type="password"
                        name="password"
                        label="Jelszó"
                        label-class="text-xl"
                        input-class="rounded-lg p-2 w-full"
                        validation="alpha"
                        />

                    <RouterLink :to="'/Registration'">
                        Még nem regisztrált? Kattintson ide!
                    </RouterLink>
                </div>

                <div class="text-center">
                    <button class="bg-gray-800 text-pink-600 py-3 mt-4 px-6 rounded-lg text-xl font-semibold w-full md:w-auto">Bejelentkezés</button>
                </div>

            </FormKit>

        </div>

    </BaseLayout>
</template>

<script setup>
import BaseLayout from '@layouts/BaseLayout.vue'
</script>