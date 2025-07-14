import { ref } from "vue";
import { defineStore } from "pinia";
import { http } from "@utils/http.mjs";

export const useDriveInCinemaStore = defineStore("driveInCinemas", () => {
  const driveInCinemas = ref([]);
  const driveInCinema = ref(null);

  async function getDriveInCinemas() {
    try {
      const resp = await http.get("/drive_in_cinemas");
      driveInCinemas.value = resp.data.data;
    } catch (err) {
      console.error("Hiba az autósmozi lekérdezésekor", err);
      throw err;
    }
  }

  async function getDriveInCinema(id) {
    try {
      const resp = await http.get(`/drive_in_cinemas/${id}`);
      driveInCinema.value = resp.data.data;
    } catch (err) {
      console.error("Hiba az autósmozi lekérdezésekor", err);
      throw err;
    }
  }

  async function createDriveInCinema(data) {
    try {
      await http.post("/drive_in_cinemas", data);
      driveInCinemas.value.push(data);
      return driveInCinema;
    } catch (err) {
      console.error("Hiba az autósmozi létrehozásakor", err);
      throw err;
    }
  }

  async function updateDriveInCinema(id, data) {
    try {
      await http.put(`/drive_in_cinemas/${id}`, data);
      const idx = driveInCinemas.value.findIndex((c) => c.id === id);
      if (idx !== -1) driveInCinemas.value[idx] = data;
      if (driveInCinema.value?.id === id) driveInCinema.value = data;
      return data;
    } catch (err) {
      console.error("Hiba az autósmozi frissítésekor", err);
      throw err;
    }
  }

  async function deleteDriveInCinema(id) {
    try {
      await http.delete(`/drive_in_cinemas/${id}`);
      driveInCinemas.value = driveInCinemas.value.filter((c) => c.id !== id);
      if (driveInCinema.value?.id === id) driveInCinema.value = null;
    } catch (err) {
      console.error("Hiba az autósmozi törlésekor", err);
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
