import axios from 'axios'

// 1) A fő forrás az API URL-re (felhasználják, de lehet refaktorálni köll majd)
const API_BASE_URL = 'http://backend.cinemaroad/api'

//gyökér URL és a storage alapjai
const ROOT_BASE_URL = API_BASE_URL.replace(/\/api\/?$/, '')
const STORAGE_BASE_URL = `${ROOT_BASE_URL}/storage`

// Maradt, csak akkor ha már .env-ből jön minden, jöjjön ez is onnan! <Menci_így> </Menci_így>
export const http = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json'
  }
})

// Helper rész a képekhez. A storage részben így egyszerűbb behívni a storage.url() -lel.
export const storage = {
  baseURL: STORAGE_BASE_URL,
  url: (path = '') => {
    const clean = String(path).replace(/^\/+/, '')
    return `${STORAGE_BASE_URL}/${clean}`
  }
}