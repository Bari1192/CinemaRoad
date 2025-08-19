<template>
    <footer class="bg-gray-900 text-gray-300 py-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <div class="col-span-1">
                    <h3 class="text-6xl text-pink-500 mb-4 lg:mb-2 italic text-center lg:text-start tracking-wider"
                        style="font-family: 'Cookie','Arial','Times New Roman', Times, serif;">Cinema Road</h3>
                    <p class="text-sm leading-relaxed text-justify italic">
                        Éld át a klasszikus <b>drive-in mozi élményét</b> modern technológiával!
                        A legjobb filmek, a legnagyobb vászon, a saját autód kényelméből.
                    </p>
                </div>

                <div class="col-span-1 w-full lg:w-4/5 mx-auto">
                    <h4 class="text-xl font-semibold text-white mb-4">Gyorslinkek</h4>
                    <ul class="grid grid-cols-1 md:grid-cols-2 justify-around items-center mx-auto w-full ">
                        <router-link to="/">
                            <li class="mb-2 lg:mb-1">
                                <a href="#" class="hover:text-pink-400 transition-colors duration-200">Kezdőlap</a>
                            </li>
                        </router-link>
                        <router-link to="/movies/SpecialWeek">
                            <li class="mb-2 lg:mb-1">
                                <a href="#" class="hover:text-pink-400 transition-colors duration-200">Rendezvények</a>
                            </li>
                        </router-link>
                        <router-link to="/LocationChoose">
                            <li class="mb-2 lg:mb-1">
                                <a href="#" class="hover:text-pink-400 transition-colors duration-200">Jegyvásárlás</a>
                            </li>
                        </router-link>
                        <router-link to="/LocationViewer">
                            <li class="mb-2 lg:mb-1">
                                <a href="#" class="hover:text-pink-400 transition-colors duration-200">Helyszínek</a>
                            </li>
                        </router-link>
                        <router-link to="/Login">
                            <li class="mb-2 lg:mb-1">
                                <a href="#" class="hover:text-pink-400 transition-colors duration-200">Bejelentkezés</a>
                            </li>
                        </router-link>
                        <router-link to="/Registration">
                            <li class="mb-2 lg:mb-1">
                                <a href="#" class="hover:text-pink-400 transition-colors duration-200">Regisztráció</a>
                            </li>
                        </router-link>
                    </ul>
                </div>

                <div class="col-span-1">
                    <h4 class="text-xl font-semibold text-white mb-4">Elérhetőségek</h4>
                    <p class="mb-2">
                        <i class="fas fa-map-marker-alt mr-2 text-pink-500"></i>
                        1234 Budapest, Mozi utca 5.
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-phone mr-2 text-pink-500"></i>
                        +36 20 123 4567
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-envelope mr-2 text-pink-500"></i>
                        info@cinemaroad.hu
                    </p>
                </div>

                <div class="col-span-1">
                    <h4 class="text-xl font-semibold text-white mb-5">Kövess Minket!</h4>
                    <div class="flex space-x-4 mb-3">
                        <a href="#" class="text-blue-500 hover:text-pink-500 transition-colors duration-200">
                            <i class="fab fa-facebook-f text-3xl"></i>
                        </a>
                        <a href="#" class="text-rose-400 hover:text-pink-500 transition-colors duration-200">
                            <i class="fab fa-instagram text-3xl"></i>
                        </a>
                        <a href="#" class="text-sky-400 hover:text-pink-500 transition-colors duration-200">
                            <i class="fab fa-twitter text-3xl"></i>
                        </a>
                        <a href="#"
                            class="text-red-500 rounded-full hover:text-pink-500 transition-colors duration-200">
                            <i class="fab fa-youtube text-3xl"></i>
                        </a>
                    </div>
                    <p class="text-white text-sm italic">Értesülj elsőként nyereményjátékainkról, akcióinkról és a legújabb
                        filmek kínálatáról!</p>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-10 pt-8 text-center text-gray-500 text-sm">
               Cinema Road&copy; - {{ currentYear }} - Minden jog fenntartva.
            </div>
        </div>
    </footer>
</template>

<script setup>
import { ref } from 'vue';

const currentYear = ref(new Date().getFullYear());
</script>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
@import url('https://fonts.googleapis.com/css2?family=Cookie&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Onest:wght@100..900&display=swap');
</style>