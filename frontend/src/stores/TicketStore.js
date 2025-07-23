import { defineStore } from "pinia";

export const useTicketStore = defineStore("ticketstore", {
  state: () => ({
    location: null,
    locationName: null,
    movie: null,
    time: null,
    parkingSpot: null,
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

    clearLocation() {
      this.location = null;
      localStorage.removeItem("location");
    },
  },
  persist: true,
});
