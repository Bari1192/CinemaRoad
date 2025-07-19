import { ref } from "vue";
import { http } from "@utils/http.mjs";

export const useMovieStore = defineStore("movies", () => {
  const movies = ref([]);
  const movie = ref(null);

  async function getMovies() {
    try {
      const resp = await http.get("/movies");
      movies.value = resp.data.data;
      return movies.value;
    } catch (error) {
      console.error("Hiba a filmek lekérése közben", err);
    }
  }

  async function getMovie(id) {
    try {
      const resp = await http.get(`/movies/${id}`);
      movie.value = resp.data.data;
      return movie.value;
    } catch (err) {
      console.error(`Hiba a film lekérése közben ${id}:`, err);
    }
  }

  async function createMovie(data) {
    try {
      const resp = await http.post("/movies", data);
      ToastService.updateToSuccess(
        toastId,
        "A film sikeresen hozzáadásra került!"
      );
      return resp.data.data;
    } catch (err) {
      console.error("Hiba az film létrehozásakor", err);
      throw err;
    }
  }

  async function updateMovie(id, data) {
    try {
      const resp = await http.put(`/movies/${id}`, data);
      ToastService.updateToSuccess(toastId, "Film sikeresen módosítva!");
      return resp.data.data;
    } catch (err) {
      console.error("Hiba a film frissítésekor", err);
      throw err;
    }
  }
  async function deleteMovie(id) {
    try {
      await http.delete(`/movies/${id}`);
      movies.value = movies.value.filter((m) => m.id !== id); //frissítés
    } catch (err) {
      console.error("Hiba a film törlésekor", err);
      throw err;
    }
  }

  return {
    cars,
    car,

    getMovies,
    getMovie,
    createMovie,
    updateMovie,
    deleteMovie,
  };
});