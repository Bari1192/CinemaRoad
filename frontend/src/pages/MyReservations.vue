    <template>
        <BaseLayout>
            <div v-if="loading">
                <BaseSpinner class="mx-auto my-32" />
            </div>

            <div v-else>

                <!-- Ha be van jelentkezve, de nincs aktív foglalása -->
                <div v-if="reservations.length == 0">
                    <h1>Nincs aktív foglalásod</h1>
                </div>

                <!-- Ha be van jelentkezve és van aktív foglalása -->
                <div v-else>
                    <p>{{ ticketStore.userData }}</p>
                    <h1 class="text-3xl font-bold mt-20 mb-10" v-if="userStore.userData && userStore.userData.name">
                        {{ userStore.userData.name }} aktív foglalásai:
                    </h1>

                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5">

                        <div class="p-3 bg-gray-300 m-3 md:m-3 card max-w-[350px] mx-auto rounded-lg" v-for="reservation in filteredReservations"
                            :key="reservation.id">

                            <p>{{filteredReservations}}</p>
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
                                <button class="bg-gray-700 font-semibold p-2 rounded-lg" @click="deleteMyReservation(reservation.id)">
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
import { onMounted, computed, ref } from 'vue';
import BaseSpinner from '@components/layout/BaseSpinner.vue';

const userStore = useUserStore();
const ticketStore = useTicketStore();
const screeningsById = ref({});

const loading = ref(true);
const reservations = [];
const filteredReservations = computed(() => {
    
    const filtered = reservations.value.filter(r => Number(r.user_id) === Number(userStore.userData.id));
    console.log(filteredReservations)
    return filtered;
});

const deleteMyReservation = async(id) => {
    if(confirm("Biztosan törlöd a foglalásod?") === true){
        await ticketStore.deleteReservation(id);
        reservations.value = reservations.value.filter(r => r.id !== id); 
        console.log('Foglalás törölve!');
        alert("Foglalás törölve!");
    } else {
        alert("Foglalás törlése megszakítva!");
    }
}

const loadReservations = async () => {
    loading.value = true;
    try {
        const res = await ticketStore.getReservations();
        reservations.value = res.data.data;
        console.log(reservations.data.data)
        return reservations;
        // const screeningIds = [...new Set(reservations.value.map(r => r.screening_id))];
        // screeningsById.value = {};

        // for (const id of screeningIds) {
        //     const response = await http.get(`/screenings/${id}`);
        //     screeningsById.value = { ...screeningsById.value, [id]: response.data.data };
        // }

    //     const filteredReservations = [];
    //     filteredReservations = reservations.filter(item => item && item.user_id == ticketStore.UserID);
     } catch (e) {
        console.error('Hiba történt:', e);
    } finally {
        loading.value = false;
    }
};

onMounted(async () => {
    console.log("kezdődik")
    await userStore.getUser();
    console.log("UserID: ",ticketStore.UserID)
    await loadReservations();
    
    console.log("vége")
});

</script>