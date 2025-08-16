<template>
  <nav>
    <div v-if="isLargeScreen" class="bg-slate-950 text-pink-600 w-full">
      <div class="flex justify-between p-3 border-b-2 flex-wrap">
        <RouterLink to="/" class="flex items-center space-x-3">
          <span class="self-center text-4xl tracking-wider"
            style="font-family: 'Cookie','Arial','Times New Roman', Times, serif;">
            Cinema Road
          </span>
        </RouterLink>
        <ul class="flex flex-row items-center space-x-8 tracking-wide"
          style="font-family: 'Cookie','Arial','Times New Roman', Times, serif;">
          <li
            class="md:text-3xl lg:text-4xl tracking-wider block py-2 px-3 transition-colors duration-150 text-pink-600 hover:text-white rounded">
            <RouterLink to="/movies/SpecialWeek">Special Week</RouterLink>
          </li>
          <li
            class="relative md:text-3xl lg:text-4xl tracking-wider xl:px-3 transition-all duration-150 text-pink-600 rounded focus-within:z-30">
            <button @click="toggleCinemaDropdown"
              class="block w-full h-full my-auto top-10 text-left focus:outline-none transition-all duration-150  hover:text-white"
              style="font-family:inherit;" :class="cinemaDropdownOpen ? 'text-white' : ''">
              Filmkínálat
            </button>
            <transition name="fade">
              <ul v-if="cinemaDropdownOpen" class="absolute lg:-left-7 min-w-[200px] md:w-full mt-7 lg:mt-3 bg-slate-950 shadow-2xl rounded-xl
                       border-4 border-pink-500 z-50 flex flex-col divide-y divide-pink-800
                       overflow-hidden"
                style="font-family: 'Onest', 'Cookie','Arial','Times New Roman', Times, serif;">
                <li v-for="cinema in driveinCinemas.driveInCinemas" :key="cinema.id"
                  class="md:text-3xl lg:text-4xl tracking-wider block transition-colors duration-150 text-pink-600 hover:text-white rounded">
                  <button @click="selectCinema(cinema)"
                    class="block w-full text-left lg:text-2xl lg:text-center lg:px-0 tracking-wide pl-3 py-3 transition-all duration-200 text-white bg-transparent hover:bg-pink-300/85 hover:text-pink-950 hover:font-semibold focus:bg-pink-600 focus:text-white"
                    style="font-family:inherit;">
                    {{ cinema.name }}
                  </button>
                </li>
              </ul>
            </transition>
          </li>
          <li
            class="md:text-3xl lg:text-4xl tracking-wider block py-2 px-3 transition-colors duration-150 text-pink-600 hover:text-white rounded">
            <RouterLink to="/LocationChoose">Jegyfoglalás</RouterLink>
          </li>
          <li
            class="md:text-3xl lg:text-4xl tracking-wider block py-2 px-3 transition-colors duration-150 text-pink-600 hover:text-white rounded">
            <RouterLink to="/LocationViewer">Helyszínek</RouterLink>
          </li>
          <li v-if="!userIsLoggedIn"
            class="md:text-3xl lg:text-4xl tracking-wider block py-2 px-3 transition-colors duration-150 text-pink-600 hover:text-white rounded">
            <RouterLink to="/Login">Bejelentkezés</RouterLink>
          </li>
          <li v-else
            class="md:text-3xl lg:text-4xl tracking-wider block py-2 px-3 transition-colors duration-150 text-pink-600 hover:text-white rounded">
            <button @click="handleLogOut">Kijelentkezés</button>
          </li>
        </ul>
      </div>
    </div>


    <!-- LG ALATT (mert más dizájn) -->
    <div v-else
      class="bg-slate-950 text-pink-600 w-full flex lg:flex-row justify-center xl:border-b-2 lg:gap-2 py-5 border-b-4 border-pink-800 flex-wrap">
      <RouterLink to="/" class="flex flex-row w-full mx-auto gap-4 justify-center items-center pt-4">
        <div
          class="hidden md:block xl:hidden w-1/5 h-[5px] rounded-full bg-gradient-to-r from-sky-300 via-sky-600 to-sky-300">
        </div>
        <span class="text-center text-4xl md:text-5xl font-bold tracking-wide mb-1 w-fit mx-2"
          style="font-family: 'Cookie','Arial','Times New Roman', Times, serif;">
          Cinema Road
        </span>
        <div
          class="hidden md:block xl:hidden w-1/5 h-[5px] rounded-full bg-gradient-to-r from-sky-300 via-sky-600 to-sky-300">
        </div>
      </RouterLink>
      <button class="inline-flex md:hidden" @click="toggleMenu">
        <svg class="w-5 h-5" aria-hidden="true" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M1 1h15M1 7h15M1 13h15" />
        </svg>
      </button>
      <div class="w-full md:block md:w-auto" :class="{ hidden: !menuOpen }">
        <ul class="flex flex-col md:flex-row px-3 md:px-1 md:space-x-6 tracking-wide"
          style="font-family: 'Cookie','Arial','Times New Roman', Times, serif;">
          <li
            class="md:text-3xl lg:text-4xl tracking-wider block py-2 transition-colors duration-150 text-pink-600 hover:text-white rounded">
            <RouterLink to="/movies/SpecialWeek">Rendezvények</RouterLink>
          </li>
          <li v-if="!isMobile" class="relative group">
            <button @click="toggleCinemaDropdown"
              class="md:text-3xl lg:text-4xl tracking-wider block py-2 transition-colors duration-150 text-pink-600 hover:text-white rounded"
              style="font-family:inherit;" :class="cinemaDropdownOpen ? 'text-white' : ''">
              Filmkínálat
            </button>
            <transition name="fade">
              <ul v-if="cinemaDropdownOpen" class="absolute -left-5 min-w-[150px] md:w-full mt-2 lg:mt-3 bg-slate-950 shadow-2xl rounded-xl
                       border-4 border-pink-500 z-50 flex flex-col divide-y divide-pink-800
                       overflow-hidden"
                style="font-family: 'Onest', 'Cookie','Arial','Times New Roman', Times, serif;">
                <li v-for="cinema in driveinCinemas.driveInCinemas" :key="cinema.id"
                  class="md:text-3xl lg:text-4xl tracking-wider block transition-colors duration-150 text-pink-600 hover:text-white rounded">
                  <button @click="selectCinema(cinema)"
                    class="block w-full text-left text-base lg:px-0 tracking-wide pl-3 py-3 transition-all duration-200 text-white bg-transparent hover:bg-pink-300/85 hover:text-pink-950 hover:font-semibold focus:bg-pink-600 focus:text-white"
                    style="font-family:inherit;">
                    {{ cinema.name }}
                  </button>
                </li>
              </ul>
            </transition>
          </li>

          <!-- Mobil-->
          <li v-if="isMobile"
            class="relative md:text-3xl lg:text-4xl tracking-wider xl:px-3 transition-all duration-150 text-pink-600 rounded focus-within:z-30">
            <button @click="toggleCinemaList"
              class="w-full text-left py-2 md:text-3xl lg:text-4xl text-pink-600 hover:text-white"
              style="font-family:inherit;" :class="cinemaListOpen ? 'text-white' : ''">
              Filmkínálat <span class="inline-block -ml-1 w-fit h-2" v-if="!cinemaListOpen">🔺</span> <span
                class="inline-block -ml-1 w-fit h-2" v-else>🔻</span>
            </button>
            <transition name="fade">
              <ul v-if="cinemaListOpen" v-show="cinemaListOpen" class="ml-4 mt-1 flex flex-col">
                <li v-for="cinema in driveinCinemas.driveInCinemas" :key="cinema.id"
                  class="md:text-3xl lg:text-4xl tracking-wider block transition-colors duration-150 mb-0.5 text-pink-600 hover:text-white rounded">
                  <button @click="selectCinema(cinema)" class="block font-extralight w-full text-left lg:text-2xl lg:text-center lg:px-0 tracking-wide pl-3 transition-all duration-200 
                    text-pink-200 bg-transparent hover:text-pink-500/85 focus:text-white"
                    style="font-family: 'Nunito', 'Cookie','Arial','Times New Roman', Times, serif;font-weight: 200;">
                    {{ cinema.name }}
                  </button>
                </li>
              </ul>
            </transition>
          </li>
          <li
            class="md:text-3xl lg:text-4xl tracking-wider block py-2 transition-colors duration-150 text-pink-600 hover:text-white rounded">
            <RouterLink to="/LocationChoose">Jegyfoglalás</RouterLink>
          </li>
          <li
            class="md:text-3xl lg:text-4xl tracking-wider block py-2 transition-colors duration-150 text-pink-600 hover:text-white rounded">
            <RouterLink to="/LocationViewer">Helyszínek</RouterLink>
          </li>
          <li v-if="!userIsLoggedIn"
            class="md:text-3xl lg:text-4xl tracking-wider block py-2 transition-colors duration-150 text-pink-600 hover:text-white rounded">
            <RouterLink to="/Login">Bejelentkezés</RouterLink>
          </li>
          <li v-else
            class="md:text-3xl lg:text-4xl tracking-wider block py-2 transition-colors duration-150 text-pink-600 hover:text-white rounded">
            <button @click="handleLogOut">Kijelentkezés</button>
          </li>
        </ul>
      </div>
    </div>


  </nav>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useUserStore } from '@stores/UserStore.js'
import { useDriveInCinemaStore } from '@stores/DriveInCinemaStore'
import { useTicketStore } from '@stores/TicketStore'

const userStore = useUserStore()
const driveinCinemas = useDriveInCinemaStore()
const ticketStore = useTicketStore()
const router = useRouter()
const menuOpen = ref(false)
const cinemaDropdownOpen = ref(false)
const isMobile = ref(window.innerWidth < 768)
onMounted(() => { driveinCinemas.getDriveInCinemas() })


const toggleMenu = () => { menuOpen.value = !menuOpen.value }
const toggleCinemaDropdown = () => { cinemaDropdownOpen.value = !cinemaDropdownOpen.value }
const Cinemas = computed(() => driveinCinemas.getDriveInCinemas ? driveinCinemas.getDriveInCinemas() : [])

function selectCinema(cinema) {
  ticketStore.setLocation(cinema)
  ticketStore.setLocationName(cinema.name)
  cinemaDropdownOpen.value = false
  router.push(`/movies/MovieWeek/${cinema.id}`)
  cinemaListOpen.value = false
  menuOpen.value = false
}
const userIsLoggedIn = computed(() => userStore.isUserLoggedIn)
const handleLogOut = () => { userStore.logoutUser() }

const isLargeScreen = ref(window.innerWidth > 1024)
function checkScreen() {
  isLargeScreen.value = window.innerWidth > 1024
}
function toggleCinemaList() {
  cinemaListOpen.value = !cinemaListOpen.value
}
function checkView() {
  isMobile.value = window.innerWidth < 768
}
onMounted(() => {
  window.addEventListener('resize', checkScreen)
  window.addEventListener('resize', checkView)
  driveinCinemas.getDriveInCinemas();
});
const cinemaListOpen = ref(false)

</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity .19s;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

@import url('https://fonts.googleapis.com/css2?family=Cookie&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Onest:wght@100..900&display=swap');
</style>