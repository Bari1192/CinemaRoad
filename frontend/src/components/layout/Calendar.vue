<template>
    <div class="container mx-auto w-full my-12 p-8 bg-slate-800 rounded-lg shadow-xl">
        <h2 class="text-5xl text-white font-bold mb-8 text-center">Mozihét</h2>
        <p class="text-xl text-gray-300 text-center my-2">(Aktuálisan az egyik mozira vetítve, annak a kínálata)
        </p>
        <p class="text-lg text-pink-400 tracking-wider text-center mb-10 italic">Kérem válassza ki a napot, hogy
            megtekinthesse az aznapi filmkínálatot!
        </p>
        <!-- elválasztó -->
        <div class="w-[95%] mx-auto h-[3px] bg-pink-100/65 mb-12"></div>
        <div class="grid grid-cols-7 gap-4 text-center">

            <div
                class="text-pink-600 font-semibold text-2xl border-l-4 border-gray-500 py-2">
                Hétfő</div>
            <div class="text-pink-600 font-semibold text-2xl border-l-4 border-gray-500 py-2">Kedd</div>
            <div class="text-pink-600 font-semibold text-2xl border-l-4 border-gray-500 py-2">Szerda</div>
            <div class="text-pink-600 font-semibold text-2xl border-l-4 border-gray-500 py-2">Csütörtök</div>
            <div class="text-pink-600 font-semibold text-2xl border-l-4 border-gray-500 py-2">Péntek</div>
            <div class="text-pink-600 font-semibold text-2xl border-l-4 border-gray-500 py-2">Szombat</div>
            <div class="text-pink-600 font-semibold text-2xl border-x-4 border-gray-500 py-2">Vasárnap</div>

            
            <div v-for="n in 3" :key="'empty-prev-' + n" class="p-4"></div>
            
            <div v-for="day in 30" :key="day" class="mt-1 calendar-day p-4 bg-slate-700 rounded-lg cursor-pointer border-x-4 border-gray-500
            hover:bg-pink-600 transition-colors duration-300 
            flex flex-col justify-center items-center group">
            <span class="text-white text-3xl font-bold">{{ day }}</span>
            <span class="text-gray-300 text-sm mt-1 group-hover:text-white">
                {{ day % 5 === 0 ? '3 film' : (day % 3 === 0 ? '2 film' : 'Nincs vetítés') }}
                
            </span>
        </div>
        <div v-for="n in 2" :key="'empty-next-' + n" class="p-4"></div>
    </div>
    <!-- elválasztó -->
            <div class="w-full mx-auto h-[3px] bg-pink-100/65 mt-12"></div>
</div>
</template>