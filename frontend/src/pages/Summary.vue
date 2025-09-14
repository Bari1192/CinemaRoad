<script setup>
import BaseLayout from '@layouts/BaseLayout.vue'
import Stepper from '@components/layout/Stepper.vue'
import BaseSpinner from '@components/layout/BaseSpinner.vue'
import { useTicketStore } from '@stores/TicketStore'
import { useUserStore } from '@stores/UserStore'
import { computed, onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import AgeLimitBadge from '@components/AgeLimitBadge.vue'
import { storage } from '@utils/http.mjs'

const userStore = useUserStore();
const ticketStore = useTicketStore();
const router = useRouter();

const locationName = computed(() =>
    ticketStore.location?.name || ticketStore.locationName || '–'
)

const bookingType = ref(null);
const guestEmail = ref(null);

const movieTitle = computed(() =>
    ticketStore.movie?.title || (typeof ticketStore.movie === 'string' ? ticketStore.movie : '–')
)
const movieDesc = computed(() =>
    ticketStore.movie?.description || ''
)
const moviePoster = computed(() =>
    ticketStore.movie?.poster_url || ''
)
const movieAgeLimit = computed(() =>
    ticketStore.movie?.age_limit || ''
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
    if (!bookingType.value && userStore.userID) {
        alert("Kérlek válassz! Foglalni, vagy vásárolni szeretnél?");
        return;
    }

    const parkingSpots = Array.isArray(ticketStore.parkingSpot)
        ? ticketStore.parkingSpot
        : [ticketStore.parkingSpot];
    let resultData = null;

    if (bookingType.value === 'reservation' && userStore.userID) {
        const payload = {
            user_id: userStore.userID,
            screening_id: ticketStore.time.id,
            location_id: ticketStore.location.id,
            reserved_at: ticketStore.time.start_time,
            parkingspot: parkingSpots.join(',')
        };
        console.log("Reservation bejelentkezett payload: ", payload);
        resultData = await ticketStore.postTicketReservation(payload);
    }
    else if ((bookingType.value === 'purchase' && userStore.userID)) {
        const payload = {
            location_id: ticketStore.location.id,
            movie_id: ticketStore.movie.id,
            screening_id: ticketStore.time.id,
            parkingspot: parkingSpots.join(','),
            user_id: userStore.userID
        };
        console.log("Purchase bejelentkezett payload: ", payload);
        resultData = await ticketStore.postTicketPurchase(payload);
    }

    else if (!userStore.userID && guestEmail.value) {
        const payload = {
            location_id: ticketStore.location.id,
            movie_id: ticketStore.movie.id,
            screening_id: ticketStore.time.id,
            parkingspot: parkingSpots.join(','),
            guest_email: guestEmail.value
        };
        console.log("Purchase guest payload: ", payload);
        resultData = await ticketStore.postTicketPurchase(payload);
    }

    ticketStore.$reset();
    router.push({
        path: "/ThankYouPage",
        query: {
            bookingType: bookingType.value || 'purchase',
            code: bookingType.value === 'reservation'
                ? resultData.confirmation
                : resultData.ticket_code
        }
    });
};
const emailRegex = /^[a-zA-Z0-9._%+-]+@(gmail|freemail|yahoo|citromail|aoutlook)\.(com|hu)$/;
const userIsLoggedIn = computed(() => userStore.isUserLoggedIn);

const isLoading = ref(false);
onMounted(async () => {
    isLoading.value = true;
    await userStore.getUser();
    isLoading.value = false;
})
</script>

<template>
    <BaseLayout>
        <div v-if="isLoading">
            <BaseSpinner />
        </div>
        <div v-else>
            <Stepper :currentStep="4" />
            <div class="flex justify-center mt-20 mx-4">
                <div class=" via-white pink-600 shadow-xl border-[3px] border-dashed border-slate-500/75 rounded-3xl w-full max-w-lg relative 
                    py-8 px-6 ticket overflow-hidden
                    md: pb-4">
                    <div
                        class="absolute left-0 top-16 h-32 w-6 bg-white border-r-4 border-dashed border-indigo-300 rounded-r-2xl -z-10">
                    </div>
                    <div
                        class="absolute right-0 bottom-16 h-32 w-6 bg-white border-l-4 border-dashed border-pink-300 rounded-l-2xl -z-10">
                    </div>
                    <div class="text-xl text-black/75 font-bold mb-1 uppercase text-center">Drive-in mozi foglalás
                        megerősítése</div>
                    <div
                        class="text-2xl lg:text-3xl mt-4 lg:underline underline-offset-4 font-bold text-pink-600 mb-2 lg:text-center">
                        {{ locationName }}</div>
                    <div class="flex items-center gap-4 pt-5 pb-2  border-pink-100 flex-col md:flex-row w-full">
                        <div>
                            <img v-if="moviePoster" :src="storage.url(`${moviePoster}`)"
                                class="w-full h-fit object-cover rounded-lg border border-gray-200 shadow-md" />
                        </div>
                        <div>
                            <div
                                class="text-sm underline underline-offset-4 text-pink-900 font-bold uppercase opacity-70 tracking-wider mb-2">
                                Kiválasztott film:
                            </div>
                            <div
                                class="mx-auto inline-flex items-center align-middle gap-2 md:text-lg lg:text-2xl font-bold text-gray-700">
                                <AgeLimitBadge :age="movieAgeLimit" klassz="h-4 w-4 md:w-6 md:h-6 lg:w-8 lg:h-8" />
                                {{ movieTitle }}
                            </div>
                            <div class="mt-2 italic text-gray-500">{{ movieDesc }}</div>
                        </div>
                    </div>
                    <div v-if="!userStore.userID" class="flex flex-col w-full gap-2 my-4">
                        <label for="email"
                            class="block font-bold text-pink-500 border border-pink-500 bg-amber-300/90 w-fit rounded-md px-2 py-1 mb-2 text-sm lg:text-base ">
                            Email cím megadása
                        </label>
                        <div class="flex flex-col sm:flex-row items-start gap-2 w-full sm:w-1/2">
                            <FormKit id="email" type="email" name="email" v-model="guestEmail"
                                input-class="py-1.5 lg:py-1 border-pink-600 border-2 rounded-lg w-full px-2 text-black font-semibold"
                                :validation="[['required'], ['matches', emailRegex]]"
                                :validation-messages="{ matches: 'Kérlek, valós Email-t adj meg!' }"
                                :validation-visibility="dirty" />
                            <FormKitMessages for="email" class="text-red-600 text-sm font-semibold" />
                        </div>
                        <p class="pt-1 text-sm italic text-gray-500 font-semibold mb-2 w-full sm:w-1/2">
                            Vásárlás után erre az e-mail címre küldjük számodra a vásárolt jegyeidet!
                        </p>
                    </div>
                    <div v-if="userStore.userID" class="flex my-3 flex-col gap-2">
                        <label for="options"
                            class="block font-bold text-pink-500 border border-pink-500 bg-amber-300/90 w-fit rounded-md px-3 py-1 mb-2 text-sm lg:text-base">
                            Hogyan szeretnéd biztosítani a jegyed?
                        </label>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <label class="flex items-center justify-center border rounded-lg px-6 py-4 cursor-pointer transition-all
                                focus-within:ring-pink-400
                               select-none font-semibold text-black" :class="bookingType === 'reservation'
                                ? 'bg-pink-500 text-white border-pink-500 shadow-md'
                                : 'bg-white border-pink-500'">
                                <input type="radio" name="options" value="reservation" v-model="bookingType"
                                    class="hidden" />
                                Előfoglalom
                            </label>

                            <label class="flex items-center justify-center border rounded-lg px-4 py-2 cursor-pointer transition-all
                            focus-within:ring-pink-400
                           select-none font-semibold text-black" :class="bookingType === 'purchase'
                            ? 'bg-pink-500 text-white border-pink-500 shadow-md'
                            : 'bg-white border-pink-500'">
                                <input type="radio" name="options" value="purchase" v-model="bookingType"
                                    class="hidden" />
                                Megveszem
                            </label>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <div
                            class="underline underline-offset-4 text-pink-900 font-bold uppercase opacity-70 text-sm lg:text-base">
                            Vetítés időpontja</div>
                        <div class="text-lg font-bold tracking-wider text-gray-700"
                            style="font-family: 'Nunito','Arial','Times New Roman', Times, serif;">
                            {{ formattedTime }}
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 mt-6 border-t-4 border-dashed border-slate-500 py-4 md:w-4/5">
                        <div
                            class="text-pink-800 font-extrabold lg:font-bold tracking-wider uppercase opacity-70 text-sm lg:text-base">
                            Foglalásod a következő hely(ek)re
                            szól:</div>
                        <div class="flex gap-2 flex-wrap mt-1">
                            <span v-for="(place, i) in parkings" :key="i" class="inline-flex items-center gap-1 px-2 py-1 md:px-4 md:py-2 rounded-full border font-bold bg-gradient-to-br 
                                from-pink-100 to-pink-300 border-pink-300 text-pink-900 shadow-sm tracking-wide">
                                <span class="material-icons text-lg text-black/75">{{ place }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center my-10">
                <button v-if="userIsLoggedIn"
                    class="text-lg px-10 py-3 bg-pink-700 border border-white/55 shadow-md shadow-pink-400/45 text-white uppercase font-bold rounded-xl hover:bg-pink-600 transition"
                    @click="handleConfirmation">
                    Foglalás véglegesítése
                </button>
                <button v-else
                    class="text-lg px-10 py-3 bg-pink-700 border border-white/55 shadow-md shadow-pink-400/45 text-white uppercase font-bold rounded-xl hover:bg-pink-600 transition"
                    @click="handleConfirmation">
                    Vásárlás véglegesítése
                </button>
            </div>
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