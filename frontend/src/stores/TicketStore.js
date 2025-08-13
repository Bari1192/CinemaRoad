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
    reservations: ref([])
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
    
    async postTicketReservation(data){
      const response = await http.post("/reservations", data);
      return response.data.data;
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

      return { reservations, getReservations };
    },

    async deleteReservation(id){
      try {
        const response = await http.delete(`/reservations/${id}`);
        return response.data.data;
      } catch (error) {
        console.error("Hiba a foglalás törlése közben: ", error)
      }
    },

    clearLocation() {
      this.location = null;
      localStorage.removeItem("location");
    },
  },
  persist: true,
});
