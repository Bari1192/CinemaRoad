    <template>
        <BaseLayout>
            <div v-if="loading">
                <BaseSpinner class="mx-auto my-32" />
            </div>

            <div v-else>
                <!-- Ha be van jelentkezve, de nincs aktív foglalása -->
                <div v-if="reservations.length == 0">
                    <h1 class="text-center text-3xl my-20">Nincs aktív foglalásod</h1>
                </div>

                <!-- Ha be van jelentkezve és van aktív foglalása -->
                <div v-else>
                    <h1 class="text-3xl font-bold mt-20 mb-10" v-if="userStore.userData && userStore.userData.name">
                        {{ userStore.userData.name }} aktív foglalásai:
                    </h1>

                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5">

                        <div class="p-3 bg-gray-300 m-3 md:m-3 card max-w-[350px] mx-auto rounded-lg"
                            v-for="reservation in filteredReservations" :key="reservation.id">

                            <div class="card-body">

                                <!-- Film címe -->
                                <h1 class="text-3xl card-title font-bold text-center">{{
                                    screeningsById[reservation.screening_id]?.movie?.title || 'Ismeretlen' }}</h1>

                                <!-- Mozi neve -->
                                <p class="card-text text-center"><b>{{
                                    screeningsById[reservation.screening_id]?.drivein_cinema?.name ||
                                    'Ismeretlen' }}</b></p>

                                <!-- Parkolóhelyek -->
                                <p class="card-text text-center"><b>{{ reservation.parkingspot }}</b></p>

                                <!-- Vetítés ideje -->
                                <p class="card-text px-10 text-center"><b>{{
                                    screeningsById[reservation.screening_id]?.start_time || 'Ismeretlen' }}</b></p>
                            </div>

                            <div class="card-footer text-center mt-5">
                                <button class="bg-gray-700 font-semibold p-2 rounded-lg"
                                    @click="deleteMyReservation(reservation.id)">
                                    Foglalás törlése
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </BaseLayout>
    </template>

<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';
import { useUserStore } from '@stores/UserStore.js';
import { useTicketStore } from '@stores/TicketStore';
import { useScreeningStore } from '@stores/ScreeningStore.mjs';
import { onMounted, computed, ref } from 'vue';
import BaseSpinner from '@components/layout/BaseSpinner.vue';

const userStore = useUserStore();
const ticketStore = useTicketStore();
const screeningStore = useScreeningStore();

const screeningsById = ref({});
const loading = ref(true);
const reservations = ref([]);




const filteredReservations = computed(() => {
    return reservations.value.filter(r => Number(r.user_id) === Number(userStore.userData.id));
});

const deleteMyReservation = async (id) => {
    if (confirm("Biztosan törlöd a foglalásod?") === true) {
        await ticketStore.deleteReservation(id);
        reservations.value = reservations.value.filter(r => r.id !== id);
        console.log('Foglalás törölve!');
        alert("Foglalás törölve!");
    } else {
        alert("Foglalás törlése megszakítva!");
    }
}

const loadReservationsAndScreenings = async () => {
    loading.value = true;
    try {
        const [reservationsArray, screeningsArray] = await Promise.all([
            ticketStore.getReservations(),
            screeningStore.getScreenings()
        ]);

        reservations.value = reservationsArray;

        screeningsById.value = Object.fromEntries(
            screeningsArray.data.map(s => [s.id, s])
        );

    } catch (e) {
        console.error('Hiba történt:', e);
    } finally {
        loading.value = false;
    }
};


onMounted(async () => {
    await userStore.getUser();
    await loadReservationsAndScreenings();
});

</script>