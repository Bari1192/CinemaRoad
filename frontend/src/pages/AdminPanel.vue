<template>
    <BaseLayout>
        <div class="w-11/12 mx-auto my-10">
            <h1 v-if="viewMode === 'reservations'" class="mt-10 mb-5 font-bold text-2xl sm:text-3xl text-center">
                Foglalási áttekintő
            </h1>
            <h1 v-else class="mt-10 mb-5 font-bold text-2xl sm:text-3xl text-center">
                Vásárlási áttekintő
            </h1>

            <!-- Szűrők helye -->
            <div class="mb-2 w-full grid grid-cols-1 md:grid-cols-4 gap-2">

                <div> <!-- Helyszín -->
                    <label class="text-lg font-semibold px-1" for="locationOptions">Helyszín:</label>
                    <select v-model="selectedLocation" class="p-2 rounded-lg w-full" name="locationOptions"
                        id="locationOptions">
                        <option class="font-semibold" value="">Összes</option>
                        <option class="font-semibold" v-for="loc in Object.values(locationNames)" :key="loc"
                            :value="loc">{{ loc }}</option>
                    </select>
                </div>

                <div> <!-- Film -->
                    <label class="text-lg font-semibold px-1" for="movieOptions">Film:</label>
                    <select v-model="selectedMovie" class="p-2 rounded-lg w-full" name="movieOptions" id="movieOptions">
                        <option value="">Összes</option>
                        <option v-for="movie in movieStore.movies" :key="movie" :value="movie.title">{{ movie.title }}
                        </option>
                    </select>
                </div>

                <div> <!-- Email -->
                    <label class="text-lg font-semibold px-1" for="emailFilter">Email:</label>
                    <input v-model="emailFilter" type="text" id="emailFilter" class="p-2 rounded-lg w-full" />
                </div>

                <!-- Nézetek -->
                <div class="flex flex-col md:flex-row gap-2 ">
                    <button @click="viewMode = 'reservations'"
                        :class="['font-semibold p-1 rounded-lg w-full md:w-auto', viewMode === 'reservations' ? 'bg-pink-200' : 'bg-white']">
                        Foglalások
                    </button>
                    <button @click="viewMode = 'purchases'"
                        :class="['font-semibold p-1 rounded-lg w-full md:w-auto', viewMode === 'purchases' ? 'bg-pink-200' : 'bg-white']">
                        Vásárlások
                    </button>
                </div>
            </div>




            <!-- MOBIL KÁRTYÁK, FOGLALÁS -->
            <div v-if="viewMode === 'reservations'" class="space-y-4 lg:hidden">
                <div v-for="reservation in filteredItems" :key="reservation.id"
                    class="bg-gray-100 py-4 pl-2 rounded-lg shadow">
                    <p class="font-semibold pl-2">Helyszín: <span class="px-2">{{ locationNames[reservation.location_id]
                    }}</span></p>
                    <p class="font-semibold pl-2">Email: <span class="px-2">{{ reservation.guest_email ||
                        reservation.userEmail }}</span></p>
                    <p class="font-semibold pl-2">Film: <span class="px-2">Film</span></p>
                    <p class="font-semibold pl-2">Jegyek: <span class="px-2">{{ reservation.parkingspot }}</span>
                    </p>
                    <p class="font-semibold pl-2">Azonosító: <span class="px-2">{{ reservation.confirmation ||
                        reservation.ticket_code }}</span>
                    </p>

                    <div v-if="editingDataId !== reservation.id" class="flex justify-end gap-2 mt-3">
                        <button @click="startEdit(reservation)"
                            class="text-black font-semibold bg-yellow-500 px-1 mx-1 py-1 rounded-lg">
                            Módosítás
                        </button>
                        <button @click="handleDeleteReservation(reservation.id)"
                            class="text-white font-semibold bg-red-700 px-1 mx-1 py-1 rounded-lg">
                            Törlés
                        </button>
                    </div>
                    <div v-else class="flex justify-center">
                        <button @click="handleUpdateReservation(reservation.id)"
                            class="text-white font-semibold bg-green-600 px-3 py-1 rounded-lg">
                            Mentés
                        </button>
                    </div>
                </div>
            </div>



            <!-- MOBIL KÁRTYÁK, VÁSÁRLÁS -->
            <div v-if="viewMode === 'purchases'" class="space-y-4 lg:hidden">
                <div class="hidden sm:block">
                    <Paginator :rows="rows" :first="currentPage * rows" :totalRecords="filteredItems.length"
                        :rowsPerPageOptions="[10, 20, 30]" @page="onPage" :pt="{
                            root: 'flex justify-center rounded-lg items-center gap-2 my-4',
                            page: 'p-2 px-4 m-1 rounded-full bg-white text-black font-semibold hover:bg-gray-300 cursor-pointer',
                            pageLink: 'w-full h-full flex justify-center items-center',
                            pageActive: 'bg-pink-500 text-white',
                            prev: 'px-3 py-1 m-1 bg-blue-500 text-white rounded-full hover:bg-blue-600',
                            next: 'px-3 py-1 m-1 bg-blue-500 text-white rounded-full hover:bg-blue-600'
                        }" />
                </div>
                <div v-for="purchase in paginatedItems" :key="purchase.id"
                    class="bg-gray-100 py-4 pl-2 rounded-lg shadow">
                    <p class="font-semibold pl-2">Helyszín: <span class="px-2">{{ locationNames[purchase.location_id]
                    }}</span></p>
                    <p class="font-semibold pl-2">Email: <span class="px-2">{{ purchase.guest_email ||
                        purchase.userEmail }}</span></p>
                    <p class="font-semibold pl-2">Film: <span class="px-2">Film</span></p>
                    <td class="font-semibold p-2">
                        <span v-if="editingDataId !== purchase.id"> Jegyek: {{ purchase.parkingspot
                        }}</span>
                        <input v-else v-model="editableData.parkingspot" class="border rounded px-1 w-20 text-center" />
                    </td>
                    <p class="font-semibold pl-2">Azonosító: <span class="px-2">{{ purchase.confirmation ||
                        purchase.ticket_code }}</span>
                    </p>

                    <div v-if="editingDataId !== purchase.id" class="flex justify-end gap-2 mt-3">
                        <button @click="startEdit(purchase)"
                            class="text-black font-semibold bg-yellow-500 px-1 mx-1 py-1 rounded-lg">
                            Módosítás
                        </button>
                        <button @click="handleDeletePurchase(purchase.id)"
                            class="text-white font-semibold bg-red-700 px-1 mx-1 py-1 rounded-lg">
                            Törlés
                        </button>
                    </div>
                    <div v-else class="flex justify-center">
                        <button @click="handleUpdatePurchase(purchase.id)"
                            class="text-white font-semibold bg-green-600 px-3 py-1 rounded-lg">
                            Mentés
                        </button>
                    </div>
                </div>
            </div>

            <!-- LG ÉS FOGLALÁS -->
            <table v-if="viewMode === 'reservations'" class="hidden lg:table bg-gray-100 w-full rounded-lg shadow">
                <thead class="border-b-4 border-pink-600">
                    <tr>
                        <th class="text-center p-2 text-lg">Helyszín</th>
                        <th class="text-center p-2 text-lg">Email</th>
                        <th class="text-center p-2 text-lg">Film</th>
                        <th class="text-center p-2 text-lg">Jegyek</th>
                        <th class="text-center p-2 text-lg">Foglalási azonosító</th>
                        <th class="text-center p-2 text-lg">Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="reservation in paginatedItems" :key="reservation.id" class="text-center p-4">
                        <td>{{ locationNames[reservation.location_id] }}</td>
                        <td>{{ reservation.userEmail }}</td>
                        <td>{{ reservation.movieTitle }}</td>
                        <td>
                            <span v-if="editingDataId !== reservation.id">{{ reservation.parkingspot }}</span>
                            <input v-else v-model="editableData.parkingspot"
                                class="border rounded px-1 w-20 text-center" />
                        </td>
                        <td>{{ reservation.confirmation }}</td>
                        <td>
                            <div v-if="editingDataId !== reservation.id" class="flex justify-center gap-2">
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
                        <th class="text-center p-2 text-lg">Jegyek</th>
                        <th class="text-center p-2 text-lg">Vásárlási azonosító</th>
                        <th class="text-center p-2 text-lg">Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="purchase in paginatedItems" :key="purchase.id" class="text-center">
                        <td class="font-semibold p-2">{{ locationNames[purchase.location_id] }}</td>
                        <td class="font-semibold p-2">{{ purchase.guest_email || purchase.userEmail }}</td>
                        <td class="font-semibold p-2">{{ purchase.movieTitle || "Ismeretlen" }}</td>
                        <td class="font-semibold p-2">
                            <span v-if="editingDataId !== purchase.id">{{ purchase.parkingspot }}</span>
                            <input v-else v-model="editableData.parkingspot"
                                class="border rounded px-1 w-20 text-center" />
                        </td>
                        <td class="font-semibold p-2">{{ purchase.ticket_code }}</td>
                        <td class="font-semibold p-2">
                            <div v-if="editingDataId !== purchase.id" class="flex justify-center gap-2">
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

            <div class="hidden lg:block">
                <Paginator :rows="rows" :totalRecords="filteredItems.length" :rowsPerPageOptions="[10, 20, 30]"
                    @page="onPage" :pt="{
                        root: 'flex justify-center rounded-lg items-center gap-2 my-4',
                        page: 'p-2 px-4 m-1 rounded-full bg-white text-black font-semibold hover:bg-gray-300 cursor-pointer',
                        pageLink: 'w-full h-full flex justify-center items-center',
                        pageActive: 'bg-pink-500 text-white',
                        prev: 'px-3 py-1 m-1 bg-blue-500 text-white rounded-full hover:bg-blue-600',
                        next: 'px-3 py-1 m-1 bg-blue-500 text-white rounded-full hover:bg-blue-600'
                    }" />
            </div>
        </div>


        <AdminMovieUpdatePanel />
    </BaseLayout>
</template>

<script setup>
import BaseLayout from '@layouts/BaseLayout.vue';
import Paginator from 'primevue/paginator'
import { onMounted, ref, computed } from 'vue';
import { ToastService } from '@stores/ToastService';
import AdminMovieUpdatePanel from './AdminMovieUpdatePanel.vue';

import { useTicketStore } from '@stores/TicketStore';
import { useMovieStore } from '@stores/MovieStore.mjs';

const movieStore = useMovieStore();
const ticketStore = useTicketStore();

const editingDataId = ref(null);
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

// PAGINATOR 
const currentPage = ref(0);
const rows = ref(10);
const paginatedItems = computed(() => {
    const start = currentPage.value * rows.value
    return filteredItems.value.slice(start, start + rows.value)
});
const onPage = (event) => {
    currentPage.value = event.page
    rows.value = event.rows
}

const filteredItems = computed(() => {
    const all = viewMode.value === 'reservations'
        ? (ticketStore.reservations || [])
        : (ticketStore.purchases || []);

    let items = [...all];

    if (selectedLocation.value) {
        const searchLocation = selectedLocation.value.toString().toLowerCase();
        items = items.filter(r => {
            const locName = (locationNames[r.location_id] || '').toString().toLowerCase();
            return locName === searchLocation;
        });
    }

    if (selectedMovie.value) {
        const searchMovie = selectedMovie.value.toString().toLowerCase();
        items = items.filter(r => (r.movieTitle || '').toString().toLowerCase() === searchMovie);
    }

    if (emailFilter.value) {
        const searchEmail = emailFilter.value.toString().toLowerCase();
        items = items.filter(r => {
            const email = (r.userEmail || r.user?.email || r.guest_email || '').toString().toLowerCase();
            return email.includes(searchEmail);
        });
    }

    return items;
});


const startEdit = (reservation) => {
    editingDataId.value = reservation.id;
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
        editingDataId.value = null;
        await ticketStore.getReservations();
        ToastService.showSuccess("Foglalás frissítve!");
    } catch (error) {
        ToastService.showError("A módosítani kívánt hely már foglalt!");
    }
}

const handleUpdatePurchase = async (id) => {
    try {
        await ticketStore.updatePurchase(id, editableData.value);
        editingDataId.value = null;
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