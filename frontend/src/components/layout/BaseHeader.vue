<template>
  <nav class="bg-slate-950 text-pink-600">
    <div class="flex justify-between p-3 border-b-2 flex-wrap">
      <RouterLink to="/" class="flex items-center space-x-3">
        <span class="self-center text-5xl tracking-wider"
          style="font-family: 'Cookie','Arial','Times New Roman', Times, serif;">Cinema Road</span>
      </RouterLink>
      <button class="block md:hidden" @click="toggleMenu">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M1 1h15M1 7h15M1 13h15" />
        </svg>
      </button>
      <div class="w-full md:block md:w-auto" :class="{ hidden: !menuOpen }">
        <ul class="flex flex-col p-4 md:flex-row md:p-0 md:space-x-8 tracking-wide" style="font-family: 'Noto Serif';">
          <li
            class="md:text-xl block py-2 px-3 text-pink-600 hover:bg-pink-00 hover:text-white rounded p-2 has-[.active]:text-pink-500 has-[.active]:hover:text-white tracking-wide">
            <router-link to="/movies/movie">Movie aloldal</router-link>
          </li>
          <li
            class="md:text-xl block py-2 px-3 text-pink-600 hover:bg-pink-00 hover:text-white rounded p-2 has-[.active]:text-pink-500 has-[.active]:hover:text-white tracking-wide">
            <RouterLink to="#">Aloldal_2</RouterLink>
          </li>
          <li
            class="md:text-xl block py-2 px-3 text-pink-600 hover:bg-pink-00 hover:text-white rounded p-2 has-[.active]:text-pink-500 has-[.active]:hover:text-white tracking-wide">
            <RouterLink to="#">Aloldal_3</RouterLink>
          </li>
          <li
            class="md:text-xl block py-2 px-3 text-pink-600 hover:bg-pink-00 hover:text-white rounded p-2 has-[.active]:text-pink-500 has-[.active]:hover:text-white tracking-wide">
            <RouterLink to="#">Aloldal_4</RouterLink>
          </li>
          <li
            class="md:text-xl block py-2 px-3 text-pink-600 hover:bg-pink-00 hover:text-white rounded p-2 has-[.active]:text-pink-500 has-[.active]:hover:text-white tracking-wide">
            <RouterLink to="#">Aloldal_5</RouterLink>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      menuOpen: false
    }
  },
  methods: {
    toggleMenu() {
      this.menuOpen = !this.menuOpen
    }
  }
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Cookie&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Onest:wght@100..900&display=swap');
</style>