import { ref } from "vue";
import { http } from "@utils/http.mjs";
import { defineStore } from "pinia";

export const useScreeningStore = defineStore("screenings", () => {
  const screenings = ref([]);
  const screening = ref(null);

  async function getScreenings() {
    try {
      const resp = await http.get("/screenings");
      screenings.value = resp.data;
      return resp.data;
    } catch (err) {
      console.error("Hiba a vetítések lekérésekor", err);
      throw err;
    }
  }

  async function getScreening(id) {
    try {
      const resp = await http.get(`/screenings/${id}`);
      screening.value = resp.data.data;
      return screening.value;
    } catch (err) {
      console.error("Hiba a vetítés lekérésekor", err);
      throw err;
    }
  }
  async function createScreening(data) {
    try {
      await http.post("/screenings", data);
      //screenings.value.push(data);
      return data;
    } catch (err) {
      console.error("Hiba a vetítés létrehozásakor", err);
      throw err;
    }
  }

  async function updateScreening(id, data) {
    try {
      const resp = await http.put(`/screenings/${id}`, data);
      await getScreenings();
      return resp.data;
    } catch (err) {
      console.error("Hiba a vetítés módosításakor", err);
      throw err;
    }
  }

  async function deleteScreening(id) {
    try {
      await http.delete(`/screenings/${id}`);
      screenings.value = screenings.value.filter((s) => s.id !== id);
    } catch (err) {
      console.error("Hiba a vetítés törlésekor", err);
      throw err;
    }
  }

  return {
    screenings,
    screening,

    getScreenings,
    getScreening,
    createScreening,
    updateScreening,
    deleteScreening,
  };
});
