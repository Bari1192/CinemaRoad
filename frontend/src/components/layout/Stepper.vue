<template>
  <div class="w-10/12 mx-auto md:w-full flex justify-center mt-12 mb-20">
    <div class="w-full max-w-2xl px-4 relative">

      <div class="absolute top-1/2 left-0 w-full h-1.5 lg:h-1 bg-slate-400 rounded-full -z-10"></div>

      <div :class="`grid grid-cols-${steps.length} w-full relative`">
        <div v-for="(step, i) in steps" :key="i" class="flex flex-col items-center">
          <div :class="circleClass(i)"
            class="w-5 h-5 -top-2  lg:w-8 lg:h-8 absolute lg:-top-4 rounded-full border-4 flex items-center justify-center transition-all duration-300 z-10">
            <i class="fa fa-solid circle"></i>
          </div>
          <span class="mt-2 absolute top-4 text-center text-xs md:text-base text-white select-none">{{ step.label
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