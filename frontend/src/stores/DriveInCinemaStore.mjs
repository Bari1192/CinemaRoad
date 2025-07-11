import { ref } from "vue";
import { defineStore } from "pinia";
import { http } from "@utils/http.mjs";


export const useDriveInCinemaStore = defineStore("driveInCinemas", () => {
  const driveInCinemas = ref([]);
  const driveInCinema = ref(null);

  async function getDriveInCinemas(params = {}) {
    try {
      const { data } = await http.get("/driveInCinemas", { params });
      driveInCinemas.value = data;
    } catch (err) {
      console.error("Hiba az autók lekérdezésekor", err);
      throw err;
    }
  }

  async function getDriveInCinema(id) {
    try {
      const { data } = await http.get(`/driveInCinemas/${id}`);
      driveInCinema.value = data;
    } catch (err) {
      console.error("Hiba az autó lekérdezésekor", err);
      throw err;
    }
  }

  async function createDriveInCinema(data) {
    try {
      await http.post("/driveInCinemas", data);
      driveInCinemas.value.push(data);
      return driveInCinema;
    } catch (err) {
      console.error("Hiba az autó létrehozásakor", err);
      throw err;
    }
  }

  async function updateDriveInCinema(id, data) {
    try {
      await http.put(`/driveInCinemas/${id}`, data);
      const idx = driveInCinemas.value.findIndex((c) => c.id === id);
      if (idx !== -1) driveInCinemas.value[idx] = data;
      if (driveInCinema.value?.id === id) driveInCinema.value = data;
      return data;
    } catch (err) {
      console.error("Hiba az autó frissítésekor", err);
      throw err;
    }
  }

  async function deleteDriveInCinema(id) {
    try {
      await http.delete(`/driveInCinemas/${id}`);
      driveInCinemas.value = driveInCinemas.value.filter((c) => c.id !== id);
      if (driveInCinema.value?.id === id) driveInCinema.value = null;
    } catch (err) {
      console.error("Hiba az autó törlésekor", err);
      throw err;
    }
  }

  return {
    driveInCinemas,
    driveInCinema,

    getDriveInCinemas,
    getDriveInCinema,
    createDriveInCinema,
    updateDriveInCinema,
    deleteDriveInCinema,
  };
});
