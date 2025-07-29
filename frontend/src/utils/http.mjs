import axios from 'axios'

export const http = axios.create({
    baseURL: "http://backend.cinemaroad/api",
    headers:{
        "Accept": "application/json",
        "Content-Type": "application/json" 
    }
})
