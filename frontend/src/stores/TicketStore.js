import { defineStore } from "pinia";
import { http } from '@utils/http.mjs';

export const useTicketStore = defineStore('ticketstore', {
    state: () => ({
        location: JSON.parse(localStorage.getItem('location')) || null,
        locationName: JSON.parse(localStorage.getItem('locationName')) || null,
        movie: JSON.parse(localStorage.getItem('movie')) || null,
        time: false,
        parkingSpot: false
    }),
    actions: {
        setLocation(location) {
            this.location = location;
            localStorage.setItem('location', JSON.stringify(location));
        },

        setLocationName(locationName) {
            this.locationName = locationName;
            localStorage.setItem('locationName', JSON.stringify(locationName));
        },

        setMovie(movie) {
            this.movie = movie;
            localStorage.setItem('movie', JSON.stringify(movie));
        },

        clearLocation() {
            this.location = null;
            localStorage.removeItem('location');
        }
    }
})