import { defineStore } from "pinia";
import { http } from "@utils/http.mjs";
import { ref } from "vue";

export const useUserStore = defineStore("user", {
  state: () => ({
    token: sessionStorage.getItem("token") || null,
    userData: {},
    userID: null,
    loading: false,
  }),
  getters: {
    isUserLoggedIn: (state) => !!state.token,
    isAdmin: (state) => !!state.userData && state.userData.role === "admin",
  },
  actions: {
    setAuthHeader(token) {
      // idegfingot kapok, ha minden küldésnél manuálisan kell hozzáraknom a tokent az admin profilomhoz.!
      if (token) {
        http.defaults.headers.common["Authorization"] = `Bearer ${token}`;
      } else {
        delete http.defaults.headers.common["Authorization"];
      }
    },
    async registerUser({ name, email, phone, password }) {
      const response = await http.post("/register", {
        name,
        email,
        phone,
        password,
      });
      return response.data.data;
    },

    async logInUser({ email, password }) {
      const response = await http.post("/authenticate", { email, password });
      this.token = response.data.data.token;
      sessionStorage.setItem("token", this.token);
      this.setAuthHeader(this.token); 
      // Amikor belogol, viszi mindenki szépen magával a kis tokenjét
      // ami amúgy frankó -> mert logolásra is lehet(ne) használni. 
      // elv. fejletebb rendszerek - nem a mienk :D - erre is építenek.
    },

    async updateUserData(id, data) {
      const response = await http.put(`/users/${id}`, data);

      return response.data.data;
    },

    async getUser() {
      try {
        const token = this.token || sessionStorage.getItem("token");
        this.setAuthHeader(token);
        //Reload után is maradjon meg!

        const response = await http.get("/user", {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        this.userID = response.data.id;

        const userResponse = await http.get(`/users/${this.userID}`);
        this.userData = userResponse.data.data;

        return response.data;
      } catch (error) {
        this.userData = null;
        this.userID = null;
      }
    },

    async logoutUser() {
      this.token = null;
      this.userData = {};
      this.userID = null;

      sessionStorage.removeItem("token");
      sessionStorage.removeItem("userData");

       this.setAuthHeader(null); 
       // "kilépésnél" dobja is el!
    },
  },
});
