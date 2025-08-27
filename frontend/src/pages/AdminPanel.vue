<template>
    <BaseLayout>
        <div class="w-11/12 mx-auto my-10">
            <h1 v-if="viewMode === 'reservations'" class="mt-10 mb-5 font-bold text-2xl sm:text-3xl text-center">
                Foglalási áttekintő
            </h1>
            <h1 v-else class="mt-10 mb-5 font-bold text-2xl sm:text-3xl text-center">
                Vásárlási áttekintő
            </h1>

            <!-- SM: cards -->
            <div class="space-y-4 lg:hidden">
                <div v-for="reservation in filteredItems" :key="reservation.id"
                    class="bg-gray-100 py-4 pl-2 rounded-lg shadow">
                    <p class="font-semibold pl-2">Helyszín: <span class="px-2">{{ reservation.location_id }}</span></p>
                    <p class="font-semibold pl-2">Email: <span class="px-2">Email</span></p>
                    <p class="font-semibold pl-2">Film: <span class="px-2">Film</span></p>
                    <p class="font-semibold pl-2">Hely jegyek: <span class="px-2">{{ reservation.parkingspot }}</span>
                    </p>
                    <p class="font-semibold pl-2">Azonosító: <span class="px-2">{{ reservation.confirmation }}</span>
                    </p>

                    <div class="flex justify-end gap-2 mt-3">
                        <button class="text-black font-semibold bg-yellow-500 px-1 mx-1 py-1 rounded-lg">
                            Módosítás
                        </button>
                        <button class="text-white font-semibold bg-red-700 px-1 mx-1 py-1 rounded-lg">
                            Törlés
                        </button>
                    </div>
                </div>
            </div>

            <!-- Szűrők helye -->
            <div class="mb-2 flex w-full">
                <div class="mx-2">
                    <label class="text-lg font-semibold px-1" for="locationOptions">Helyszín:</label>
                    <select v-model="selectedLocation" class="p-2 rounded-lg" name="locationOptions" id="locationOptions">
                        <option class="font-semibold" value="">Összes</option>
                        <option class="font-semibold" v-for="loc in Object.values(locationNames)" :key="loc"
                            :value="loc">{{ loc }}</option>
                    </select>
                </div>

                <div class="mx-2">
                    <label class="text-lg font-semibold px-1" for="movieOptions">Film:</label>
                    <select v-model="selectedMovie" class="p-2 rounded-lg" name="movieOptions" id="movieOptions">
                        <option value="">Összes</option>
                        <option v-for="movie in movieStore.movies" :key="movie" :value="movie.title">{{ movie.title }}
                        </option>
                    </select>
                </div>

                <div class="mx-2 flex items-center">
                    <label class="text-lg font-semibold px-1" for="emailFilter">Email:</label>
                    <input v-model="emailFilter" type="text" id="emailFilter" class="p-2 rounded-lg" />
                </div>

                <div class="mx-2 flex">
                    <button @click="viewMode = 'reservations'"
                        :class="['mx-1 font-semibold p-1 rounded-lg', viewMode === 'reservations' ? 'bg-pink-200' : 'bg-white']">
                        Foglalások
                    </button>
                    <button @click="viewMode = 'purchases'"
                        :class="['mx-1 font-semibold p-1 rounded-lg', viewMode === 'purchases' ? 'bg-pink-200' : 'bg-white']">
                        Vásárlások
                    </button>
                </div>
            </div>

            <!-- LG ÉS FOGLALÁS -->
            <table v-if="viewMode === 'reservations'" class="hidden lg:table bg-gray-100 w-full rounded-lg shadow">
                <thead class="border-b-4 border-pink-600">
                    <tr>
                        <th class="text-center p-2 text-lg">Helyszín</th>
                        <th class="text-center p-2 text-lg">Email</th>
                        <th class="text-center p-2 text-lg">Film</th>
                        <th class="text-center p-2 text-lg">Hely jegyek</th>
                        <th class="text-center p-2 text-lg">Foglalási azonosító</th>
                        <th class="text-center p-2 text-lg">Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="reservation in filteredItems" :key="reservation.id" class="text-center p-4">
                        <td>{{ locationNames[reservation.location_id] }}</td>
                        <td>{{ reservation.userEmail }}</td>
                        <td>{{ reservation.movieTitle }}</td>
                        <td>
                            <span v-if="editingReservationId !== reservation.id">{{ reservation.parkingspot }}</span>
                            <input v-else v-model="editableData.parkingspot"
                                class="border rounded px-1 w-20 text-center" />
                        </td>
                        <td>{{ reservation.confirmation }}</td>
                        <td>
                            <div v-if="editingReservationId !== reservation.id" class="flex justify-center gap-2">
                                <button @click="startEdit(reservation)"
                                    class="text-black font-semibold bg-yellow-500 px-3 py-1 rounded-lg">
                                    Módosítás
                                </button>
                                <button @click="handleDeleteReservation(reservation.id)"
                                    class="text-white font-semibold bg-red-700 px-3 py-1 rounded-lg">
                                    Törlés
                                </button>
                            </div>

                            <!-- Szerkesztés módban: csak Mentés -->
                            <div v-else class="flex justify-center">
                                <button @click="handleUpdateReservation(reservation.id)"
                                    class="text-white font-semibold bg-green-600 px-3 py-1 rounded-lg">
                                    Mentés
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- LG ÉS VÁSÁRLÁS -->
            <table v-if="viewMode === 'purchases'" class="hidden lg:table bg-gray-100 w-full rounded-lg shadow">
                <thead class="border-b-4 border-pink-600">
                    <tr>
                        <th class="text-center p-2 text-lg">Helyszín</th>
                        <th class="text-center p-2 text-lg">Email</th>
                        <th class="text-center p-2 text-lg">Film</th>
                        <th class="text-center p-2 text-lg">Hely jegyek</th>
                        <th class="text-center p-2 text-lg">Vásárlási azonosító</th>
                        <th class="text-center p-2 text-lg">Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="purchase in filteredItems" :key="purchase.id" class="text-center p-4">
                        <td>{{ locationNames[purchase.location_id] }}</td>
                        <td>{{ purchase.guest_email || "-" }}</td>
                        <td>{{ purchase.movieTitle || "Ismeretlen" }}</td>
                        <td>
                            <span v-if="editingReservationId !== purchase.id">{{ purchase.parkingspot }}</span>
                            <input v-else v-model="editableData.parkingspot"
                                class="border rounded px-1 w-20 text-center" />
                        </td>
                        <td>{{ purchase.ticket_code }}</td>
                        <td>
                            <div v-if="editingReservationId !== purchase.id" class="flex justify-center gap-2">
                                <button @click="startEdit(purchase)"
                                    class="text-black font-semibold bg-yellow-500 px-3 py-1 rounded-lg">
                                    Módosítás
                                </button>
                                <button @click="handleDeletePurchase(purchase.id)"
                                    class="text-white font-semibold bg-red-700 px-3 py-1 rounded-lg">
                                    Törlés
                                </button>
                            </div>

                            <!-- Szerkesztés módban: csak Mentés -->
                            <div v-else class="flex justify-center">
                                <button @click="handleUpdatePurchase(purchase.id)"
                                    class="text-white font-semibold bg-green-600 px-3 py-1 rounded-lg">
                                    Mentés
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </BaseLayout>
</template>

<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';
import { useTicketStore } from '@stores/TicketStore';
import { onMounted, ref, computed } from 'vue';
import { ToastService } from '@stores/ToastService';
import { useMovieStore } from '@stores/MovieStore.mjs';

const movieStore = useMovieStore();

const ticketStore = useTicketStore();
const editingReservationId = ref(null);
const editableData = ref({});
const viewMode = ref('reservations');
const emailFilter = ref('');
const selectedMovie = ref('');
const selectedLocation = ref('');

const locationNames = {
    1: "Starfield",
    2: "Horizon Drive",
    3: "Orbit Cinema"
};

const filteredItems = computed(() => {
  const all = viewMode.value === 'reservations'
    ? (ticketStore.reservations || [])
    : (ticketStore.purchases || []);

  let items = [...all];

  if (selectedLocation.value) {
    const wantLoc = selectedLocation.value.toString().toLowerCase();
    items = items.filter(r => {
      const locName = (locationNames[r.location_id] || '').toString().toLowerCase();
      return locName === wantLoc;
    });
  }

  if (selectedMovie.value) {
    const wantMovie = selectedMovie.value.toString().toLowerCase();
    items = items.filter(r => (r.movieTitle || '').toString().toLowerCase() === wantMovie);
  }

  if (emailFilter.value) {
    const q = emailFilter.value.toString().toLowerCase();
    items = items.filter(r => {
      const email = (r.userEmail || r.user?.email || r.guest_email || '').toString().toLowerCase();
      return email.includes(q);
    });
  }

  return items;
});


const startEdit = (reservation) => {
    editingReservationId.value = reservation.id;
    editableData.value = { ...reservation };
};

const handleDeleteReservation = async (id) => {
    try {
        await ticketStore.deleteReservation(id);
        ToastService.showSuccess("Sikeresen törölve!")
    } catch (error) {
        console.error("Hiba történt a foglalás törlése közben: ", error)
    }
};

const handleDeletePurchase = async (id) => {
    try {
        await ticketStore.deletePurchase(id);
        ToastService.showSuccess("Vásárlás sikeresen törölve!")
    } catch (error) {
        console.error("Hiba történt a vásárlás törlése közben: ", error)
    }
};

const handleUpdateReservation = async (id) => {
    try {
        await ticketStore.updateReservation(id, editableData.value);
        editingReservationId.value = null;
        await ticketStore.getReservations();
        ToastService.showSuccess("Foglalás frissítve!");
    } catch (error) {
        ToastService.showError("A módosítani kívánt hely már foglalt!");
    }
}

const handleUpdatePurchase = async (id) => {
    try {
        await ticketStore.updatePurchase(id, editableData.value);
        editingReservationId.value = null;
        await ticketStore.getPurchases();
        ToastService.showSuccess("Vásárlás frissítve!");
    } catch (error) {
        ToastService.showError("A módosítani kívánt hely már foglalt!");
    }
}

onMounted(async () => {
    await ticketStore.getReservations();
    await ticketStore.getPurchases();
    await movieStore.getMovies();
});
</script>