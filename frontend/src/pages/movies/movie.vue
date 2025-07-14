<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';


// Ez egyelőre így, ameddig majd át nem adjuk ténylegesen, a Store-ból lekérteket.
const film = {
    image: "https://images.unsplash.com/photo-1517602302552-471fe67acf66?auto=format&fit=crop&w=640&q=80",
    details: [
        { label: "Készült", value: "2025" },
        { label: "Típus", value: "Dráma" },
        { label: "Rendező", value: "Kovács Anna" },
        { label: "Játékidő", value: "120 perc" }
    ],
    cast: "Nagy Péter, Kiss Liza, Tóth Márton",
    description: "Egy rövid filmleírás, ahol a főszereplők váratlan utazásra indulnak az ismeretlenbe. Reális és átérezhető történet a bizonytalanságról és önkeresésről." // <– ezt tetszés szerint
}
</script>

<template>
    <BaseLayout>
        <div class="min-h-screen text-white flex flex-col items-center align-middle w-full py-8">
            <h1
                class="text-pink-500 text-2xl md:text-4xl lg:text-5xl lg:font-extrabold font-bold mb-4 text-center tracking-wide w-full md:w-2/5 lg:w-3/5">
                A Cinema Road Bemutatja
            </h1>
            <h2 class="w-5/6 md:w-2/5 lg:w-3/5 text-2xl md:text-4xl mb-12 text-center tracking-wide font-extrabold">
                Itt vagyok, de hol vagyok?!
            </h2>
            <div
                class="w-full max-w-md flex flex-col gap-6 md:max-w-3xl md:flex-row md:gap-8 border-t-4 border-t-slate-600 pt-6">
                <div class="flex-shrink-0 flex justify-center md:w-1/2">
                    <img :src="film.image" :alt="film.title"
                        class="rounded-lg object-cover w-52 h-72 shadow-xl border-2 border-slate-400 border-r-4 border-r-slate-500/90 shadow-slate-600/70 md:w-full md:h-full"
                        draggable="false" />
                </div>
                <div class="mt-6 md:mt-0 md:flex-1 mx-auto flex justify-center items-center w-full">
                    <div class="grid grid-cols-2 gap-y-6 w-full h-full mx-auto">
                        <template v-for="(detail, idx) in film.details" :key="idx">
                            <div
                                class="col-span-1 text-base md:text-lg lg:text-xl font-medium text-pink-500 uppercase tracking-wide flex items-center justify-center md:justify-start border-r-4 border-slate-600 w-full md:w-4/5">
                                {{ detail.label }}
                            </div>
                            <div
                                class="col-span-1 text-xs md:text-base lg:text-lg text-left md:text-center font-semibold flex items-center pl-4 md:pl-0 justify-start w-full">
                                {{ detail.value }}
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="w-full max-w-md md:max-w-3xl mt-4 px-4 md:mt-10">
                <div class="grid grid-cols-1 gap-y-3 gap-x-8 items-center py-2">
                    <div
                        class="text-center md:text-left text-base md:text-lg lg:text-xl font-medium text-pink-300 uppercase tracking-wide col-span-1  underline underline-offset-4">
                        Szereplők
                    </div>
                    <div
                        class="text-center md:text-left col-span-1 text-pink-50 text-xs md:text-base lg:text-lg font-semibold italic w-full whitespace-normal break-words">
                        {{ film.cast }}
                    </div>
                </div>
            </div>

            <div class="w-full max-w-md md:max-w-3xl mt-6 px-4">
                <div
                    class="text-center md:text-left text-base md:text-lg lg:text-xl font-medium text-pink-300 uppercase tracking-wide mb-1 underline underline-offset-4">
                    Rövid leírás
                </div>
                <div
                    class="px-2 md:px-0 text-left w-full text-pink-50 text-xs md:text-base leading-5 lg:text-lg font-semibold">
                    {{ film.description }}
                </div>
            </div>
        </div>
    </BaseLayout>
</template>