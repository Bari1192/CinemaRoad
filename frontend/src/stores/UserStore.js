import { defineStore } from "pinia";
import { http } from '@utils/http.mjs';
import { ref } from "vue";

export const useUserStore = defineStore('user', {
    state: () => ({
        token: sessionStorage.getItem('token') || null,
        userData: {},
        userID: ref(null),
        loading: false
    }),
    getters: {
        isUserLoggedIn: (state) => !!state.token,
    },
    actions: {
        async registerUser({ name, email, phone, password }) {
            const response = await http.post("/register", { name, email, phone, password });
            return response.data.data;
        },

        async logInUser({ email, password }) {
            const response = await http.post("/authenticate", { email, password });
            this.token = response.data.data.token;
            sessionStorage.setItem('token', this.token);
        },

        async updateUserData(id, data) {
            const response = await http.put(`/users/${id}`, data);

            return response.data.data;
        },

        async getUser() {

            const token = sessionStorage.getItem("token");
            const response = await http.get("/user", {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            });

            this.userID = response.data.id;

            const userResponse = await http.get(`/users/${this.userID}`);
            this.userData = userResponse.data.data;

            return response.data;
        },

        async logoutUser() {
            this.token = null;
            this.userData = {};

            sessionStorage.removeItem("token");
            sessionStorage.removeItem("userData");
        }
    }
})