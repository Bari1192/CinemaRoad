    <template>
        <BaseLayout>
            <div v-if="loading">
                <BaseSpinner class="mx-auto my-32" />
            </div>

            <div v-else class="h-screen">
                <div>

                    <div class="mt-20 mb-10 mx-3">
                        <h1 class="text-3xl px-2 font-bold"
                            v-if="userStore.userData && view == 'Foglalások' && userStore.userData.name">
                            {{ userStore.userData.name }} aktív foglalásai:
                        </h1>
                        <h1 class="text-3xl px-2 font-bold"
                            v-if="userStore.userData && view == 'Vásárlások' && userStore.userData.name">
                            {{ userStore.userData.name }} aktív vásárlásai:
                        </h1>
                        <div class="mt-2">
                            <button :class="view === 'Foglalások' ? 'bg-pink-600 text-white' : 'bg-white text-pink-600'"
                                @click="changeView('Foglalások')"
                                class="mx-1 p-2 font-semibold rounded-lg">Foglalások</button>
                            <button :class="view === 'Vásárlások' ? 'bg-pink-600 text-white' : 'bg-white text-pink-600'"
                                @click="changeView('Vásárlások')"
                                class="mx-1 p-2 font-semibold rounded-lg">Vásárlások</button>
                        </div>

                    </div>
                    
                    <div v-if="view == 'Foglalások'">

                        <div v-if="filteredReservations.length === 0" class="text-center my-10">
                            <h1 class="text-center text-3xl font-semibold text-pink-600">Jelenleg nincsen egyetlen aktív foglalása sem.</h1>
                        </div>

                        <div v-else class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5">

                            <div class="p-3 bg-gray-300 m-3 md:m-3 card max-w-[350px] mx-auto rounded-lg"
                                v-for="reservation in filteredReservations" :key="reservation.id">

                                <div class="card-body">

                                    <h1 class="text-3xl card-title font-bold text-center">{{
                                        screeningsById[reservation.screening_id]?.movie?.title || 'Ismeretlen' }}</h1>

                                    <p class="card-text text-center"><b>{{
                                        screeningsById[reservation.screening_id]?.drivein_cinema?.name ||
                                            'Ismeretlen' }}</b></p>

                                    <p class="card-text text-center"><b>{{ reservation.parkingspot }}</b></p>

                                    <p class="card-text px-10 text-center"><b>{{
                                        screeningsById[reservation.screening_id]?.start_time || 'Ismeretlen' }}</b>
                                    </p>
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


                    <div v-if="view == 'Vásárlások'">

                        <div v-if="filteredPurchases.length === 0" class="text-center my-10">
                            <h1 class="text-center text-3xl font-semibold text-pink-600">Jelenleg nincsen egyetlen aktív vásárlása sem.</h1>
                        </div>

                        <div v-else class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5">
                            <div class="p-3 bg-gray-300 m-3 md:m-3 card max-w-[350px] mx-auto rounded-lg"
                                v-for="purchase in filteredPurchases" :key="purchase.id">

                                <div class="card-body">
                                    <h1 class="text-3xl card-title font-bold text-center">
                                        {{ screeningsById[purchase.screening_id]?.movie?.title || 'Ismeretlen' }}
                                    </h1>

                                    <p class="card-text text-center">
                                        <b>{{ screeningsById[purchase.screening_id]?.drivein_cinema?.name ||
                                            'Ismeretlen' }}</b>
                                    </p>

                                    <p class="card-text text-center">
                                        <b>{{ purchase.parkingspot }}</b>
                                    </p>

                                    <p class="card-text px-10 text-center">
                                        <b>{{ screeningsById[purchase.screening_id]?.start_time || 'Ismeretlen' }}</b>
                                    </p>
                                </div>

                                <div class="card-footer text-center mt-5">
                                    <button class="bg-gray-700 font-semibold p-2 rounded-lg"
                                        @click="deleteMyPurchase(purchase.id)">
                                        Vásárlás törlése
                                    </button>
                                </div>
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
import { useRouter } from 'vue-router';
import { ToastService } from '@stores/ToastService';

const userStore = useUserStore();
const ticketStore = useTicketStore();
const screeningStore = useScreeningStore();

const screeningsById = ref({});
const loading = ref(true);
const reservations = ref([]);
const purchases = ref([]);
const router = useRouter();
const view = ref('Foglalások');

const changeView = (type) => {
    view.value = type;
};


const filteredReservations = computed(() => {
    return reservations.value.filter(r => Number(r.user_id) === Number(userStore.userData.id));
});

const filteredPurchases = computed(() => {
    return purchases.value.filter(p => p.userEmail === userStore.userData.email);
})

const deleteMyReservation = async (id) => {
    const confirmed = await ToastService.showConfirm("Foglalás törlése", "Biztosan törlöd a foglalásod?");
    if (confirmed) {
        await ticketStore.deleteReservation(id);
        reservations.value = reservations.value.filter(r => r.id !== id);
        ToastService.showSuccess("Foglalás törölve!");
    } else {
        ToastService.showError("Foglalás törlése megszakítva.")
    }
}

const deleteMyPurchase = async (id) => {
    const confirmed = await ToastService.showConfirm("Vásárlás törlése", "Biztosan törlöd a vásárlásod?");
    if (confirmed) {
        await ticketStore.deletePurchase(id);
        purchases.value = purchases.value.filter(r => r.id !== id);
        ToastService.showSuccess("Vásárlás törölve!");
    } else {
        ToastService.showError("Vásálrás törlése megszakítva.")
    }
}

const loadReservationsPurchasesScreenings = async () => {
    loading.value = true;
    try {
        const [reservationsArray, screeningsArray, purchasesArray] = await Promise.all([
            ticketStore.getReservations(),
            screeningStore.getScreenings(),
            ticketStore.getPurchases()
        ]);

        reservations.value = reservationsArray;
        purchases.value = purchasesArray;

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
    try {
        await userStore.getUser();

        if (!userStore.userData || !userStore.userData.id) {
            router.push('/');
            return;
        }

        await loadReservationsPurchasesScreenings();
    } catch (error) {
        router.push("/")
    }


});

</script>