<script setup>
import BaseLayout from '@layouts/BaseLayout.vue'
import Stepper from '@components/layout/Stepper.vue'
import { useTicketStore } from '@stores/TicketStore'
import { useUserStore } from '@stores/UserStore'
import { computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const userStore = useUserStore();
const ticketStore = useTicketStore();

const router = useRouter();

const locationName = computed(() =>
    ticketStore.location?.name || ticketStore.locationName || '–'
)
const locationDesc = computed(() =>
    ticketStore.location?.description || ''
)

const movieTitle = computed(() =>
    ticketStore.movie?.title || (typeof ticketStore.movie === 'string' ? ticketStore.movie : '–')
)
const movieDesc = computed(() =>
    ticketStore.movie?.description || ''
)
const moviePoster = computed(() =>
    ticketStore.movie?.poster_url || ''
)
const parkings = computed(() =>
    Array.isArray(ticketStore.parkingSpot)
        ? ticketStore.parkingSpot
        : ticketStore.parkingSpot
            ? [ticketStore.parkingSpot]
            : []
)
const formattedTime = computed(() => {
    if (!ticketStore.time) return '–'
    const input = typeof ticketStore.time === 'string'
        ? ticketStore.time
        : (ticketStore.time.start_time || ticketStore.time.date || '')
    if (!input) return '–'
    const dateObj = new Date(input)
    if (isNaN(dateObj)) return input
    return `${dateObj.toLocaleDateString('hu-HU', { year: 'numeric', month: '2-digit', day: '2-digit' })} (${dateObj.toLocaleDateString('hu-HU', { weekday: "long" })}) ${dateObj.toLocaleTimeString('hu-HU', { hour: '2-digit', minute: '2-digit' })}`
});

const handleConfirmation = async () => {
    const parkingSpots = Array.isArray(ticketStore.parkingSpot)
        ? ticketStore.parkingSpot
        : [ticketStore.parkingSpot];

        const parkingSpotsConcat = parkingSpots.join(',');
    const reservationData = {
        user_id: userStore.userID,
        screening_id: ticketStore.time.id,
        location_id: ticketStore.location.id,
        reserved_at: ticketStore.time.start_time,
        parkingspot: parkingSpotsConcat
    };

    await ticketStore.postTicketReservation(reservationData);


    console.log("parkingSpots: ", typeof (parkingSpots), parkingSpots);


    ticketStore.$reset();
    router.push("/ThankYouPage");
};

onMounted(async () => {
    await userStore.getUser();
})
</script>

<template>
    <BaseLayout>
        <Stepper :currentStep="4" />
        <div class="flex justify-center mt-20 mx-4">
            <div
                class=" via-white pink-600 shadow-xl border-[3px] border-dashed border-slate-500/75 rounded-3xl w-full max-w-lg relative 
                py-8 px-6 ticket overflow-hidden
                md: pb-4">
                <!-- Jegy perforáció -->
                <div
                    class="absolute left-0 top-16 h-32 w-6 bg-white border-r-4 border-dashed border-indigo-300 rounded-r-2xl -z-10">
                </div>
                <div
                    class="absolute right-0 bottom-16 h-32 w-6 bg-white border-l-4 border-dashed border-pink-300 rounded-l-2xl -z-10">
                </div>
                <!-- Mozi neve -->
                <div class="text-xl text-black/75 font-bold mb-1 uppercase text-center">Drive-in mozi foglalás
                    megerősítése</div>
                <div class="text-2xl lg:text-3xl mt-4 lg:underline underline-offset-4 font-bold text-pink-600 mb-2 lg:text-center">{{ locationName }}</div>
                <!-- Film -->
                <div class="flex items-center gap-4 py-5  border-pink-100 flex-col md:flex-row w-full">
                    <div>
                    <img v-if="moviePoster" :src="`../src/assets/img/${moviePoster}`"
                        class="w-full h-fit object-cover rounded-lg border border-gray-200 shadow-md" />
                    </div>
                    <div>
                        <div class="text-sm underline underline-offset-4 text-pink-900 font-bold uppercase opacity-70 tracking-wider mb-2">
                            Kiválasztott film:
                            </div>
                        <div class="mx-auto text-lg font-bold text-gray-700">{{ movieTitle }}</div>
                        <div class="mt-2 italic text-gray-500">{{ movieDesc }}</div>
                    </div>
                </div>
                <!-- Időpont -->
                <div class="flex flex-col gap-2">
                    <div class="underline underline-offset-4 text-pink-900 font-bold uppercase opacity-70 text-sm lg:text-base">Vetítés időpontja</div>
                    <div class="text-lg font-bold tracking-wider text-gray-700"
                        style="font-family: 'Nunito','Arial','Times New Roman', Times, serif;">
                        {{ formattedTime }}
                    </div>
                </div>
                <!-- Parkolóhely(ek) -->
                <div class="flex flex-col gap-2 mt-6 border-y-4 border-dashed border-slate-500 py-4 md:w-4/5">
                    <div class="text-pink-800 font-extrabold lg:font-bold tracking-wider uppercase opacity-70 text-sm lg:text-base">Foglalásod a következő hely(ek)re
                        szól:</div>
                    <div class="flex gap-2 flex-wrap mt-1">
                        <span v-for="(place, i) in parkings" :key="i"
                            class="inline-flex items-center gap-1 px-2 py-1 md:px-4 md:py-2 rounded-full border font-bold bg-gradient-to-br 
                            from-pink-100 to-pink-300 border-pink-300 text-pink-900 shadow-sm tracking-wide">
                            <span class="material-icons text-lg text-black/75">{{ place }}</span> 
                        </span>
                    </div>
                </div>
                <div
                    class="italic mt-6 md:mt-2 pt-4 text-center text-lg font-medium text-gray-700">
                    Jó szórakozást kívánunk a Cinema Road csapata!
                </div>
            </div>
        </div>
        <div class="flex justify-center my-10">
            <button class="text-lg px-10 py-3 bg-pink-700 border border-white/55 shadow-md shadow-pink-400/45 text-white uppercase font-bold rounded-xl hover:bg-pink-600 transition"
                @click="handleConfirmation">
                Foglalás véglegesítése
            </button>
        </div>
    </BaseLayout>
</template>

<style scoped>
.ticket {
    background-color: #f3edef;
    box-shadow: 0 6px 30px 0 #e91e6333, 0 0 0 3px #f8bbd0;
    position: relative;
}

.material-icons {
    font-family: 'Material Symbols Outlined', Arial, sans-serif !important;
}
</style>