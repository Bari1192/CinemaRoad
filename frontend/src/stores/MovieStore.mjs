import { ref } from "vue";
import { http } from "@utils/http.mjs";
import { defineStore } from "pinia";
export const useMovieStore = defineStore("movies", () => {
  const movies = ref([]);
  const movie = ref();
  const movieDetails = ref(null);

  async function getMovies() {
    try {
      const token = sessionStorage.getItem("token");

      const resp = await http.get("/movies", {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });
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
      return resp.data.data;
    } catch (err) {
      console.error("Hiba az film létrehozásakor", err);
      throw err;
    }
  }

  async function uploadMoviePoster(data) {
    const response = await http.post("/movies/upload-poster", data, {
      headers: {
        "Content-Type": "multipart/form-data"
      }});
    return response.data.data
  }

  async function updateMovie(id, data) {
    try {
      const resp = await http.put(`/movies/${id}`, data);
      return resp.data.data;
    } catch (err) {
      console.error("Hiba a film frissítésekor", err);
      throw err;
    }
  }
  async function deleteMovie(id) {
    try {
      await http.delete(`/movies/${id}`);
      movies.value = movies.value.filter((m) => m.id !== id);
    } catch (err) {
      console.error("Hiba a film törlésekor", err);
      throw err;
    }
  }

  function setMovieRoute(movieObj) {
    movieDetails == movieObj;
  }

  function storeMovieToLocalStore(movieObj) {
    try {

      movieDetails.value = movieObj;
      localStorage.setItem('movieDetails', JSON.stringify(movieObj));
      console.log("Film objektum sikeresen elmentve")

    } catch (error) {

     console.error("Hiba a film objektum tárolóba való elmentése során: ", error) 
     
    }
  }

  function clearMovieDetails() {
    movieDetails == null;
    movie == null;
    localStorage.removeItem('movieDetails');
  }
  

  return {
    movies,
    movie,
    movieDetails,

    getMovies,
    getMovie,
    createMovie,
    updateMovie,
    deleteMovie,
    setMovieRoute,
    storeMovieToLocalStore,
    clearMovieDetails,
    uploadMoviePoster
  };
});
