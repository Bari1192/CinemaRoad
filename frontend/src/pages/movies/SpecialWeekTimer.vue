<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'

function getNextThursdayMidnight(now = new Date()) {
    const d = new Date(now)
    const day = d.getDay() // 0=Vas, 1=Hét, 2=Kedd, 3=Sze, 4=Csüt, 5=Pén, 6=Szom
    const diff = (4 - day + 7) % 7 // hány nap múlva lesz csütörtök (0, ha ma)
    const target = new Date(d)
    target.setHours(0, 0, 0, 0)
    if (diff > 0) target.setDate(target.getDate() + diff)
    return target
}

function formatDateHu(date) {
    return date.toLocaleDateString('hu-HU', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit'
    })
}

const isTodayThursday = computed(() => new Date().getDay() === 4)

const nextThursday = computed(() => getNextThursdayMidnight())

const nextThursdayLabel = computed(() => formatDateHu(nextThursday.value))

const nowMs = ref(Date.now())
let timerId = null

onMounted(() => {
    timerId = setInterval(() => {
        nowMs.value = Date.now()
    }, 1000)
})

onUnmounted(() => {
    if (timerId) clearInterval(timerId)
})

const targetMs = computed(() => nextThursday.value.getTime())

const diffMs = computed(() => Math.max(0, targetMs.value - nowMs.value))

const remaining = computed(() => {
    const total = Math.floor(diffMs.value / 1000) // mp
    const days = Math.floor(total / (24 * 3600))
    const hours = Math.floor((total % (24 * 3600)) / 3600)
    const minutes = Math.floor((total % 3600) / 60)
    const seconds = total % 60

    return {
        days,
        hours,
        minutes,
        daysStr: String(days),
        hoursStr: String(hours).padStart(1, '0'),
        minutesStr: String(minutes).padStart(2, '0'),
        secondsStr: String(seconds).padStart(2, '0'),
    }
})
</script>

<template>
    <section class="w-full max-w-6xl mx-auto text-center mt-4">
        <div
            class="inline-flex items-center gap-6 mb-4 md:mb-3 md:mt-5 lg:mt-12 bg-slate-800/70 border border-slate-700 rounded-xl px-5 py-4 shadow">
            <span class="text-xl md:text-2xl lg:text-3xl font-bold text-amber-300">
                <template v-if="isTodayThursday">
                    Mától
                </template>
                <template v-else>
                    <div class="lg:text-3xl">
                        {{ nextThursdayLabel }} héttől </div>
                </template>
            </span>
        </div>

        <div v-if="!isTodayThursday" class="mt-3 text-pink-100 text-base md:text-lg font-semibold md:mt-4 lg:mt-6">
            <div class="flex items-center justify-center gap-3 font-mono">
                <!-- Nap -->
                <div class="flex items-baseline gap-3" style="font-family: Onest, Noto Sans,'Arial','Sherif;">
                    <transition name="tick" mode="out-in">
                        <span :key="remaining.daysStr" class="text-3xl md:text-4xl font-extrabold text-white">
                            {{ remaining.daysStr }}
                        </span>
                    </transition>
                    <span class="text-sm md:text-base lg:text-lg text-pink-500 tracking-wider">nap</span>
                </div>

                <span class="text-slate-500">|</span>

                <!-- Óra -->
                <div class="flex items-baseline gap-3"  style="font-family: Onest, Noto Sans,'Arial','Sherif;">
                    <transition name="tick" mode="out-in">
                        <span :key="remaining.hoursStr" class="text-3xl md:text-4xl font-extrabold text-white">
                            {{ remaining.hoursStr }}
                        </span>
                    </transition>
                    <span class="text-sm md:text-base lg:text-lg text-pink-500 tracking-wider">óra</span>
                </div>

                <span class="text-slate-500">|</span>

                <!-- Perc -->
                <div class="flex items-baseline gap-3"  style="font-family: Onest, Noto Sans,'Arial','Sherif;">
                    <transition name="tick" mode="out-in">
                        <span :key="remaining.minutesStr" class="text-3xl md:text-4xl font-extrabold text-white">
                            {{ remaining.minutesStr }}
                        </span>
                    </transition>
                    <span class="text-sm md:text-base lg:text-lg text-pink-500 tracking-wider">perc</span>
                </div>

                <!-- MS-ben -->
                <div class="flex items-baseline gap-3" style="font-family: Noto Sans,'Arial','Sherif;">
                    <transition name="tick" mode="out-in">
                        <span :key="remaining.secondsStr" class="text-3xl md:text-4xl font-extrabold text-white">
                            {{ remaining.secondsStr }}
                        </span>
                    </transition>
                    <span class="text-sm md:text-base lg:text-lg text-pink-500 tracking-wider">mp</span>
                </div>
            </div>
        </div>
    </section>
</template>

<style>
/* finom csere-animáció a számokra */
.tick-enter-active,
.tick-leave-active {
    transition: transform .35s ease, opacity .35s ease;
}

.tick-enter-from {
    transform: translateY(-35%);
    opacity: 0;
}

.tick-leave-to {
    transform: translateY(35%);
    opacity: 0;
}

@import url('https://fonts.googleapis.com/css2?family=Cookie&family=DynaPuff:wght@400..700&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Onest:wght@100..900&family=Permanent+Marker&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap');
</style>