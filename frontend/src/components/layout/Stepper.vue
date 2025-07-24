<template>
  <div class="w-10/12 mx-auto md:w-full flex justify-center mt-12 mb-20">
    <div class="w-full max-w-2xl px-4 relative">

      <div class="absolute top-1/2 left-0 w-full h-1.5 lg:h-1 bg-slate-400 rounded-full -z-10"></div>

      <div class="grid w-full grid-cols-4">
        <div v-for="(step, i) in steps" :key="i" class="relative flex flex-col items-center">
          <div :class="circleClass(i)"
            class="absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 w-7 h-7 lg:w-8 lg:h-8 rounded-full border-4 flex items-center justify-center transition-all duration-300 z-10">
            <i class="fa fa-solid circle"></i>
          </div>
          <span class="pt-14 text-center text-xs md:text-base text-white select-none">{{ step.label
            }}</span>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>

const props = defineProps({
  currentStep: { type: Number, required: true }
});
const steps = [
  { label: 'Helyszín' },
  { label: 'Film' },
  { label: 'Időpont' },
  { label: 'Parkoló' },
];
function circleClass(index) {
  if (index < props.currentStep) return "bg-pink-700 border-pink-700";
  if (index === props.currentStep) return "bg-pink-700 border-white";
  return "bg-pink-300 border-slate-100";
}
</script>