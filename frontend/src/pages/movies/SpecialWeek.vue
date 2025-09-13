<script setup>
import BaseLayout from '@layouts/BaseLayout.vue'
import { storage } from '@utils/http.mjs';
import SixteenPlus from '@assets/svg/SixteenPlus.vue'

const films = [
    {
        title: "NIGHTFIRE: REDEMPTION",
        image: storage.url(`/img/Main_Slider_img/Nightfire_redemption.webp`),
        details: [
            { label: "Készült:", value: "2025" },
            { label: "Típus:", value: "Akció / Sci-fi" },
            { label: "Rendező:", value: "Rocco Morty" },
            { label: "Helyszín:", value: "Tokió, Japán" }
        ],
        cast: "Chen Riko,Linda Howe,Carey Okuneva,Kiana Heller, Alfred Lindgren,Thurman Kilback, Gudrun Nikolaus, Icie Ziemann, Johnson Ryan, Annalise Conn,Keegan Pouros, Gabriella Kuphal, Eloise Hilpert",
        description: "Egy jövőbeli városban, ahol a törvény már csak emlék, egy különleges ügynök szembeszáll a saját múltjával és egy globális tech-kartellel. Drámai megvilágítások, esőáztatta tetők és neonfények között játszódik."
    },
    {
        title: "DUSTZONE: LAST RUN",
        image: storage.url(`/img/Main_Slider_img/Dustzone_last_run.webp`),
        details: [
            { label: "Készült:", value: "2025" },
            { label: "Típus:", value: "Posztapokaliptikus akció" },
            { label: "Rendező:", value: "Sauo Xyen" },
            { label: "Helyszín:", value: "Namíbiai sivatag" }
        ],
        cast: "Kovács Gergely, Németh Anna, Tyler McRae, Baron McDermott,Cedrick Adams,Katarina Kuphal,Brown Orn,Winfield Gottlieb,Janie Goodwin,Josiane Marks,Tanya Ward,Lonny Gutkowsk",
        description: "A világ romjai között egy utolsó reménysugárként indul el egy életveszélyes konvoj a túlélésért. Sebesség, por, tűz és elkeseredés – egy sivatagi hajszában, ahol nincs második esély."
    },
    {
        title: "REALMSHATTER",
        image: storage.url(`/img/Main_Slider_img/Realmshatter.webp`),
        details: [
            { label: "Készült:", value: "2025" },
            { label: "Típus:", value: "Fantasy / Sci-fi" },
            { label: "Rendező:", value: "Ziung Wha" },
            { label: "Helyszín:", value: "Új-Zéland & VFX stúdiók" }
        ],
        cast: "Katarina Grimes,Eleonore Cremin,Ona Stanton,Chesley Wisozk,Annabelle Hartmann,Hayley Schimmel,Eleonore Hane,Turner Stroman,Liam O'Connor",
        description: "Két világ ütközik egy pontban: a technológia és a mágia határán egy harcos feladata megakadályozni a teljes valóság széthullását. Egy epikus történet dimenziókon átívelő hősökről és sorsokról."
    }
];
</script>

<template>
    <BaseLayout>
        <div class="min-h-screen text-white flex flex-col items-center py-12 px-4 space-y-20">
            <div class="text-3xl md:text-5xl font-extrabold text-center py-0 space-y-0" style="line-height: 4rem;">
                Következő héten megjelenő
                <br><span class="text-pink-400 ">Premier előtti </span>vetítéseink
            </div>

            <div v-for="(film, index) in films" :key="index"
                class="w-full max-w-6xl flex flex-col md:flex-row gap-8 border-t-4 border-t-slate-600 pt-8">
                <div class="md:w-1/2 flex justify-center relative">
                    <img :src="film.image" :alt="film.title"
                        class="rounded-lg object-cover w-full md:h-full shadow-xl border-2 border-slate-400 border-r-4 border-r-slate-500/90 shadow-slate-600/70" />
                    <div class="absolute bottom-2 right-2 opacity-75">
                        <SixteenPlus />
                    </div>
                </div>
                <div class="md:w-1/2 flex flex-col justify-center gap-4">
                    <h2 class="text-2xl md:text-3xl font-bold text-amber-400 tracking-wide">{{ film.title }}
                    </h2>
                    <div>
                        <p class="mb-2 text-pink-50 text-sm md:text-base font-semibold">{{ film.description }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-y-4 border-y-2 border-y-slate-600/50 py-4 w-11/12 mx-auto">
                        <template v-for="(detail, idx) in film.details" :key="idx">
                            <div
                                class="text-pink-400 font-medium uppercase text-sm md:text-base w-2/3 mx-auto tracking-wide">
                                {{ detail.label }}
                            </div>
                            <div class="text-pink-100 font-semibold text-sm md:text-base w-3/4 mx-auto">
                                {{ detail.value }}
                            </div>
                        </template>
                    </div>
                    <div>
                        <h3 class="text-pink-300 font-medium uppercase mb-1 mt-2">Szereplők</h3>
                        <p class="text-pink-100 italic font-semibold text-sm md:text-base">{{ film.cast }}</p>
                    </div>
                    <div class="cta_reserv pt-10 w-full mx-auto flex justify-center">
                        <a href="http://frontend.cinemaroad/LocationChoose"
                            class="bg-pink-600 hover:bg-pink-700 text-white text-lg font-bold py-4 px-8 rounded-full transition duration-300 shadow-lg  shadow-pink-900/70">
                            Lefoglalom a jegyem
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </BaseLayout>
</template>

<style>
.cta_reserv {
    font-family: Onest, Arial, Helvetica, sans-serif;
}

@import url('https://fonts.googleapis.com/css2?family=Cookie&family=DynaPuff:wght@400..700&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Onest:wght@100..900&family=Permanent+Marker&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap');
</style>