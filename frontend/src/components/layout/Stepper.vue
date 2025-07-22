<template>
    <div class="w-full flex justify-center my-8">
      <div class="relative flex items-center w-2/3 h-2 bg-gray-800 rounded-full">
        <div
          v-for="(step, index) in steps"
          :key="index"
          class="absolute top-1/2 -translate-y-1/2 flex flex-col items-center"
          :style="{ left: `${index * 28 + 5}%` }"
        >
          <span class="mb-2 md:text-lg text-sm text-white select-none whitespace-nowrap">
            {{ step.label }}
          </span>
  
          <div
            class="flex items-center justify-center w-8 h-8 rounded-full border-2 transition-all"
            :class="getStepClass(index)"
          >
            <font-awesome-icon :icon="step.icon" />
          </div>
        </div>
      </div>
    </div>
  </template>

<script setup>
import { ref } from 'vue';
const steps = ref([
  { label: 'Helyszín', icon: 'circle' },
  { label: 'Film', icon: 'circle' },
  { label: 'Időpont', icon: 'circle' },
  { label: 'Parkoló', icon: 'circle' },
]);
//const currentStep = ref(0);

function getStepClass(index) {
  if (index < props.currentStep) return 'bg-pink-500 border-pink-500'
  if (index === props.currentStep) return 'bg-white border-pink-500'
  return 'bg-white border-gray-500'
}

const props = defineProps({
  currentStep: {
    type: Number,
    required: true,
  }
});
</script>