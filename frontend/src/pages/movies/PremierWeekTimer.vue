<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import BaseSpinner from '@components/layout/BaseSpinner.vue'

const props = defineProps({
    premierDateTime: {
        type: String,
        required: true
    }
})

function getNextThursdayMidnight(now = new Date()) {
    const d = new Date(now)
    const day = d.getDay() // 0=Vas, 1=Hét, 2=Kedd, 3=Sze, 4=Csüt, 5=Pén, 6=Szom
    const diff = (4 - day + 7) % 7 // hány nap múlva lesz csütörtök (0, ha ma)
    const target = new Date(d)
    target.setHours(0, 1, 0, 0) // 00:01-re állítjuk
    if (diff > 0) target.setDate(target.getDate() + diff)
    else if (diff === 0 && now.getHours() >= 0 && now.getMinutes() >= 1) {
        // Ha ma csütörtök és már elmúlt 00:01, akkor következő hét
        target.setDate(target.getDate() + 7)
    }
    return target
}

function formatDateHu(date) {
    return date.toLocaleDateString('hu-HU', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    })
}
// Ezt kapja a szülőtől -> így fix premier dátum + óra-perc számolja!
const premierDate = computed(() => new Date(props.premierDateTime))

const nextThursday = computed(() => getNextThursdayMidnight())
const nextThursdayLabel = computed(() => formatDateHu(nextThursday.value))

const nowMs = ref(Date.now())
let timerId = null
const loading = ref(false);

onMounted(() => {
    loading.value = true;
    timerId = setInterval(() => {
        nowMs.value = Date.now()
    }, 1000)
    loading.value = false;
})

onUnmounted(() => {
    if (timerId) clearInterval(timerId)
})

const premierTargetMs = computed(() => premierDate.value.getTime())
const diffMsToPremier = computed(() => Math.max(0, premierTargetMs.value - nowMs.value))

const remaining = computed(() => {
    const total = Math.floor(diffMsToPremier.value / 1000)
    const days = Math.floor(total / (24 * 3600))
    const hours = Math.floor((total % (24 * 3600)) / 3600)
    const minutes = Math.floor((total % 3600) / 60)
    const seconds = total % 60

    return {
        days,
        hours,
        minutes,
        seconds,
        daysStr: String(days),
        hoursStr: String(hours).padStart(2, '0'),
        minutesStr: String(minutes).padStart(2, '0'),
        secondsStr: String(seconds).padStart(2, '0'),
    }
})

const scrollToPremierFilms = () => {
    const premierSection = document.getElementById('premier-filmek')
    if (premierSection) {
        premierSection.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        })
    }
}
</script>

<template>
    <section v-if="!loading" class="relative w-full max-w-6xl mx-auto overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-purple-900/20 to-rose-900/30 rounded-3xl border-2 border-white/30">
        </div>
        <div class="relative z-10 px-6 py-12 lg:py-16">
            <div class="text-center mb-16">
                <div class="relative inline-block mb-6">
                    <div
                        class="absolute -inset-4 bg-gradient-to-r from-pink-500/20 via-purple-500/20 to-rose-500/20 blur-xl rounded-full animate-pulse">
                    </div>
                    <h1
                        class="relative text-5xl lg:text-7xl font-black bg-gradient-to-r from-pink-400 via-rose-300 to-amber-300 bg-clip-text text-transparent">
                        PREMIER HÉT
                    </h1>
                </div>

                <div class="relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-transparent via-rose-500/50 to-transparent h-[1px] blur-sm">
                    </div>
                    <div class="bg-gradient-to-r from-transparent via-rose-400 to-transparent h-[2px]"></div>
                </div>

            </div>

            <div class="space-y-12 mx-auto text-center">
                <p class="relative text-2xl lg:text-3xl font-bold text-white backdrop-blur-sm rounded-lg">
                    Jegyvásárlás megnyílik:</p>
                <!-- Dátum kijelző -->
                <div class="text-center">

                    <div class="relative inline-block">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-amber-500/30 to-orange-500/30 blur-xl rounded-xl">
                        </div>
                        <div
                            class="relative bg-slate-800/60 backdrop-blur-sm border border-amber-500/30 rounded-xl px-8 py-4">
                            <span class="text-3xl lg:text-4xl font-bold text-amber-300">
                                {{ nextThursdayLabel }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Visszaszámláló -->
                <div class="relative">
                    <!-- Visszaszámláló cím -->
                    <div class="text-center mb-8">
                        <div class="relative inline-block">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-purple-500/20 to-pink-500/20 blur-lg rounded-lg">
                            </div>
                            <h2
                                class="relative text-2xl lg:text-3xl font-bold text-white px-6 py-3 bg-slate-800/40 backdrop-blur-sm rounded-lg border border-white/10">
                                ⏰ Visszaszámlálás
                            </h2>
                        </div>
                    </div>

                    <!-- Számláló dobozok -->
                    <div class="flex items-center justify-center gap-4 lg:gap-8 flex-wrap">
                        <!-- Napok -->
                        <div class="relative group">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-rose-500/30 to-pink-600/30 blur-lg rounded-2xl group-hover:blur-xl transition-all duration-500">
                            </div>
                            <div
                                class="relative bg-slate-800/70 backdrop-blur-sm border border-rose-500/30 rounded-2xl p-6 lg:p-8 min-w-[120px] group-hover:scale-105 transition-transform duration-300">
                                <transition name="flip" mode="out-in">
                                    <div :key="remaining.daysStr" class="text-center">
                                        <div class="text-4xl lg:text-6xl font-black text-white mb-2 font-mono">
                                            {{ remaining.daysStr }}
                                        </div>
                                        <div
                                            class="text-rose-300 text-sm lg:text-base font-semibold uppercase tracking-wider">
                                            Nap
                                        </div>
                                    </div>
                                </transition>
                            </div>
                        </div>

                        <!-- Elválasztó -->
                        <div class="text-white/30 text-3xl font-bold hidden sm:block">:</div>

                        <!-- Órák -->
                        <div class="relative group">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-purple-500/30 to-violet-600/30 blur-lg rounded-2xl group-hover:blur-xl transition-all duration-500">
                            </div>
                            <div
                                class="relative bg-slate-800/70 backdrop-blur-sm border border-purple-500/30 rounded-2xl p-6 lg:p-8 min-w-[120px] group-hover:scale-105 transition-transform duration-300">
                                <transition name="flip" mode="out-in">
                                    <div :key="remaining.hoursStr" class="text-center">
                                        <div class="text-4xl lg:text-6xl font-black text-white mb-2 font-mono">
                                            {{ remaining.hoursStr }}
                                        </div>
                                        <div
                                            class="text-purple-300 text-sm lg:text-base font-semibold uppercase tracking-wider">
                                            Óra
                                        </div>
                                    </div>
                                </transition>
                            </div>
                        </div>

                        <!-- Elválasztó -->
                        <div class="text-white/30 text-3xl font-bold hidden sm:block">:</div>

                        <!-- Percek -->
                        <div class="relative group">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-blue-500/30 to-indigo-600/30 blur-lg rounded-2xl group-hover:blur-xl transition-all duration-500">
                            </div>
                            <div
                                class="relative bg-slate-800/70 backdrop-blur-sm border border-blue-500/30 rounded-2xl p-6 lg:p-8 min-w-[120px] group-hover:scale-105 transition-transform duration-300">
                                <transition name="flip" mode="out-in">
                                    <div :key="remaining.minutesStr" class="text-center">
                                        <div class="text-4xl lg:text-6xl font-black text-white mb-2 font-mono">
                                            {{ remaining.minutesStr }}
                                        </div>
                                        <div
                                            class="text-blue-300 text-sm lg:text-base font-semibold uppercase tracking-wider">
                                            Perc
                                        </div>
                                    </div>
                                </transition>
                            </div>
                        </div>

                        <!-- Elválasztó -->
                        <div class="text-white/30 text-3xl font-bold hidden sm:block">:</div>

                        <!-- Másodpercek -->
                        <div class="relative group">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-emerald-500/30 to-teal-600/30 blur-lg rounded-2xl group-hover:blur-xl transition-all duration-500">
                            </div>
                            <div
                                class="relative bg-slate-800/70 backdrop-blur-sm border border-emerald-500/30 rounded-2xl p-6 lg:p-8 min-w-[120px] group-hover:scale-105 transition-transform duration-300">
                                <transition name="" mode="out-in">
                                    <div :key="remaining.secondsStr" class="text-center">
                                        <div class="text-4xl lg:text-6xl font-black text-white mb-2 font-mono">
                                            {{ remaining.secondsStr }}
                                        </div>
                                        <div
                                            class="text-emerald-300 text-sm lg:text-base font-semibold uppercase tracking-wider">
                                            Mp
                                        </div>
                                    </div>
                                </transition>
                            </div>
                        </div>
                    </div>

                    <!-- Alsó szöveg -->
                    <div class="text-center mt-12">
                        <p class="text-white/70 text-lg">
                            <span class="w-full mx-auto gap-2 italic">
                                Addig is tekintsd meg a
                                <button @click="scrollToPremierFilms"
                                    class="text-amber-400/95 italic font-semibold hover:text-pink-200 transition-colors duration-300 underline underline-offset-2 hover:underline-offset-4">
                                    premier filmeket!
                                </button>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div v-else class="w-full min-h-screen inline-flex items-center justify-center align-middle">
        <BaseSpinner />
        <p class="pl-4 text-white font-semibold">Betöltés folyamatban...</p>
    </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Onest:wght@100..900&family=Noto+Sans:wght@100..900&display=swap');

.flip-enter-active,
.flip-leave-active {
    transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.flip-enter-from {
    transform: rotateX(-90deg) scale(0.8);
    opacity: 0;
}

.flip-leave-to {
    transform: rotateX(90deg) scale(0.8);
    opacity: 0;
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0px);
    }

    50% {
        transform: translateY(-10px);
    }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

@media (max-width: 640px) {
    .flex-wrap>div {
        min-width: 80px;
    }

    .flex-wrap>div .text-4xl {
        font-size: 2rem;
    }
}
</style>