import { defineStore } from "pinia";
import { http } from "@utils/http.mjs";
import { ref } from "vue";

export const useTicketStore = defineStore("ticketstore", {
  state: () => ({
    location: null,
    locationName: null,
    movie: null,
    time: null,
    parkingSpot: null,
    screeningId: null,
    reservations: ref([]),
    purchases: ref([])
  }),
  actions: {
    setLocation(location) {
      this.location = location;
      localStorage.setItem("location", JSON.stringify(location));
    },

    setLocationName(locationName) {
      this.locationName = locationName;
      localStorage.setItem("locationName", JSON.stringify(locationName));
    },

    setMovie(movie) {
      this.movie = movie;
      localStorage.setItem("movie", JSON.stringify(movie));
    },

    setTime(time) {
      this.time = time;
      localStorage.setItem("time", JSON.stringify(time));
    },

    setParkingSpot(parkingSpot) {
      this.parkingSpot = parkingSpot;
      localStorage.setItem("parkingSpot", JSON.stringify(parkingSpot));
    },

    async postTicketReservation(data) {      
      const response = await http.post("/reservations", data);
      return response.data.data;
    },

    async postTicketPurchase(data) {
      const response = await http.post("/purchases", data);
      return response.data.data;
    },

    async getPurchases() {
      try {
        const response = await http.get("/purchases");
        this.purchases = response.data.data;
        return this.purchases;
      } catch (error) {
        console.error("Hiba a vásárlások lekérése közben: ", error);
        return [];
      }
    },

    async updatePurchase(id, data) {
      try {
        const response = await http.put(`/purchases/${id}`, data);
        return response.data.data;
      } catch (error) {
        console.error("Hiba a vásárlás módosítása közben: ", error);
        throw error;
      }
    },

    async deletePurchase(id) {
      try {
        const response = await http.delete(`/purchases/${id}`);
        return response.data.data;
      } catch (error) {
        console.error("Hiba történt a vásárlás törlése közben!", error);
        throw error;
      }
    },

    async getReservations() {
      try {
        const response = await http.get("/reservations");
        this.reservations = response.data.data;
        return this.reservations;
      } catch (error) {
        console.error("Hiba a foglalások lekérdezése közben: ", error);
        return [];
      }
    },

    async deleteReservation(id) {
      try {
        const response = await http.delete(`/reservations/${id}`);
        return response.data.data;
      } catch (error) {
        console.error("Hiba a foglalás törlése közben: ", error)
        throw error
      }
    },

    async updateReservation(id, data) {
      try {
        const response = await http.put(`/reservations/${id}`, data);
        return response.data.data;
      } catch (error) {
        console.error("Hiba a foglalás módosítása közben: ", error)
        throw error
      }
    },

    clearLocation() {
      this.location = null;
      localStorage.removeItem("location");
    },
  },
  persist: true,
});
