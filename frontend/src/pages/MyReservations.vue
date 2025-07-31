    <template>
        <BaseLayout>
            <div v-if="loading">
                <BaseSpinner />
            </div>

            <div v-else>
                <!-- Ha nincs bejelentkezve user -->
                <div v-if="!userStore.isUserLoggedIn">
                    <h1>Nincs bejelentkezve a pali!</h1>
                </div>

                <!-- Ha van bejelentkezve user -->
                <div v-else>

                    <!-- Ha be van jelentkezve, de nincs aktív foglalása -->
                    <div v-if="reservations.length == 0">
                        <h1>Nincs aktív foglalásod</h1>
                    </div>

                    <!-- Ha be van jelentkezve és van aktív foglalása -->
                    <div v-else class="p-14">
                        <h1 class="text-3xl font-bold" v-if="userStore.userData && userStore.userData.name">
                            {{ userStore.userData.name }} aktív foglalásai:
                        </h1>
                        <div class="flex p-14">
                            <div class="bg-gray-300 p-5 m-5 rounded-lg" v-for="reservation in filteredReservations"
                                :key="reservation">
                                <p class="text-2xl font-semibold">Film Neve: {{ screeningsById[reservation.screening_id]?.movie?.title || 'Ismeretlen' }}</p>
                                <p>Vetítés helyszíne: {{ screeningsById[reservation.screening_id]?.drivein_cinema?.name || 'Ismeretlen' }}</p>
                                <p>Parkolóhely: {{ reservation.parkingspot }}</p>
                                <p>Foglalás időpontja: {{ screeningsById[reservation.screening_id]?.start_time || 'Ismeretlen' }}</p>
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
import { http } from '@utils/http.mjs';

const userStore = useUserStore();
const ticketStore = useTicketStore();
const screeningsById = ref({});

const reservations = ref([]);
const loading = ref(true);

const filteredReservations = computed(() => {
  if (!userStore.userData || !userStore.userData.id) return [];
  return reservations.value.filter(r => r.user_id === userStore.userData.id);
});

onMounted(async () => {
    await userStore.getUser();
    const response = await ticketStore.getReservations();
    reservations.value = response;

    const uniqueScreeningIds = [...new Set(reservations.value.map(r => r.screening_id))];

    const promises = uniqueScreeningIds.map(id =>
        http.get(`/screenings/${id}`).then(r => {
            screeningsById.value[id] = r.data.data;
        })
    );

    await Promise.all(promises);
    loading.value = false;
});
</script>