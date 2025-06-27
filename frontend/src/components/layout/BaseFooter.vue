<template>
    <footer class="bg-gray-900 text-gray-300 py-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <!-- Oszlop 1: Logó és rövid leírás -->
                <div class="col-span-1">
                    <h3 class="text-6xl text-pink-500 mb-4 tracking-wider"
                              style="font-family: 'Cookie','Arial','Times New Roman', Times, serif;">Cinema Road</h3>
                    <p class="text-sm leading-relaxed text-justify">
                        Éld át a klasszikus drive-in mozi élményét modern technológiával!
                        A legjobb filmek, a legnagyobb vászon, a saját autód kényelméből.
                    </p>
                </div>

                <!-- Oszlop 2: Gyorslinkek -->
                <div class="col-span-1 w-1/2 mx-auto">
                    <h4 class="text-xl font-semibold text-white mb-4">Gyorslinkek</h4>
                    <ul>
                        <li class="mb-2">
                            <a href="#" class="hover:text-pink-400 transition-colors duration-200">Kezdőlap</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="hover:text-pink-400 transition-colors duration-200">Filmek</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="hover:text-pink-400 transition-colors duration-200">Vetítési idők</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="hover:text-pink-400 transition-colors duration-200">Jegyvásárlás</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="hover:text-pink-400 transition-colors duration-200">Kapcsolat</a>
                        </li>
                    </ul>
                </div>

                <!-- Oszlop 3: Elérhetőségek -->
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

                <!-- Oszlop 4: Közösségi média és hírlevél -->
                <div class="col-span-1">
                    <h4 class="text-xl font-semibold text-white mb-4">Kövess Minket!</h4>
                    <div class="flex space-x-4 mb-6">
                        <a href="#" class="text-gray-400 hover:text-pink-500 transition-colors duration-200">
                            <i class="fab fa-facebook-f text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-pink-500 transition-colors duration-200">
                            <i class="fab fa-instagram text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-pink-500 transition-colors duration-200">
                            <i class="fab fa-twitter text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-pink-500 transition-colors duration-200">
                            <i class="fab fa-youtube text-2xl"></i>
                        </a>
                    </div>
                    <!-- Hírlevél feliratkozás (opcionális) -->
                    <h4 class="text-xl font-semibold text-white mb-3">Hírlevél</h4>
                    <form class="flex">
                        <input type="email" placeholder="E-mail címed"
                            class="flex-grow p-2 rounded-l-md bg-gray-800 border border-gray-700 text-white focus:outline-none focus:border-pink-500" />
                        <button type="submit"
                            class="bg-pink-600 hover:bg-pink-700 text-white p-2 rounded-r-md transition-colors duration-200">
                            Feliratkozom
                        </button>
                    </form>
                </div>
            </div>

            <!-- Copyright rész -->
            <div class="border-t border-gray-700 mt-10 pt-8 text-center text-gray-500 text-sm">
                &copy; {{ currentYear }} Cinema Road. Minden jog fenntartva.
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