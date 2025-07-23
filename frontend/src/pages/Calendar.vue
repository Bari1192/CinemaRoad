<script setup>
import { computed } from 'vue'
import { useLocalStorage, useNow } from '@vueuse/core'
import { useTicketStore } from '@stores/TicketStore';

const ticketStore = useTicketStore();

const props = defineProps({
    screenings: {
        type: Array,
        required: true,
    }
})
const emit = defineEmits(['select-screening']);
function selectScreening(id) {
    const screening = props.screenings.find(s => s.id === id)
    emit('select-screening', id)
    ticketStore.setTime(screening.start_time);
}

const screeningsByDate = computed(() => {
    const map = {};
    for (const screening of props.screenings) {
        const [date, time] = screening.start_time.split(' ');
        if (!map[date]) map[date] = [];
        map[date].push({
            time: time.slice(0, 5),
            id: screening.id,
            obj: screening
        });
    }
    return map;
});

const currentDate = useNow() // Ahhoz majd, hogy csak a MAI-TÓL mutassa majd!
const year = currentDate.value.getFullYear()
const month = currentDate.value.getMonth() // ha majd csak a kövi hónap VAGY hét kell, akkor '+1'-et ide kell vágni a végére!

const daysWithScreenings = computed(() => {
    const days = []
    const totalDays = new Date(year, month, 0).getDate()

    for (let day = 1; day <= totalDays; day++) {
        const paddedDay = String(day).padStart(2, '0')
        const paddedMonth = String(month).padStart(2, '0')
        const date = `${year}-${paddedMonth}-${paddedDay}`
        const times = screeningsByDate.value[date]

        if (times) {
            days.push({
                day,
                date,
                times
            })
        }
    }

    return days
})
</script>

<template>
    <div class="container mx-auto w-full my-12 p-8 bg-slate-800 rounded-lg shadow-xl">
        <h2 class="text-5xl text-white font-bold mb-8 text-center">{{ ticketStore.locationName }}</h2>
        <h2 class="text-4xl text-pink-400 font-semibold mb-8 text-center">{{ ticketStore.movie.title }} Vetítések</h2>
        <div class="w-[95%] mx-auto h-1.5 rounded-full bg-pink-100/65 mb-12"></div>

        <div class="grid grid-cols-7 gap-4 text-center">
            <div class="text-pink-600 font-semibold text-2xl border-l-4 border-gray-500 py-2">Hétfő</div>
            <div class="text-pink-600 font-semibold text-2xl border-l-4 border-gray-500 py-2">Kedd</div>
            <div class="text-pink-600 font-semibold text-2xl border-l-4 border-gray-500 py-2">Szerda</div>
            <div class="text-pink-600 font-semibold text-2xl border-l-4 border-gray-500 py-2">Csütörtök</div>
            <div class="text-pink-600 font-semibold text-2xl border-l-4 border-gray-500 py-2">Péntek</div>
            <div class="text-pink-600 font-semibold text-2xl border-l-4 border-gray-500 py-2">Szombat</div>
            <div class="text-pink-600 font-semibold text-2xl border-x-4 border-gray-500 py-2">Vasárnap</div>

            <div v-for="day in daysWithScreenings" :key="day.date"
                class="mt-1 w-11/12 mx-auto calendar-day p-2 bg-slate-700 
            rounded-lg cursor-pointer border-x-4 border-gray-500 flex flex-col justify-center items-center group h-fit">
                <span class="text-white text-3xl font-bold mx-auto w-full h-full">
                    {{ month <= '10' ? '0' + month + '.' + day.day : month + '.' + day.day }} <div
                        class="w-4/5 rounded-full h-1 my-2 bg-amber-300 mx-auto">
            </div>

            <div class="w-full h-fit flex flex-col gap-2 justify-center lg:w-10/12 mx-auto">

                <div v-for="screen in day.times" :key="screen.id"
                    class="text-white font-medium w-full text-xl mt-1 hover:bg-pink-700 transition-colors duration-200 px-3 py-2 bg-pink-600 rounded-lg">
                    <button class="idopont-btn" @click="selectScreening(screen.id)">
                        {{ screen.time }}
                    </button>
                </div>
            </div>
            </span>
        </div>
    </div>

    <div class="w-full mx-auto h-[3px] bg-pink-100/65 mt-12"></div>
    </div>
</template>
