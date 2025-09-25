<script setup>
import { computed } from 'vue'

import ZeroPlus from '@assets/svg/ZeroPlus.vue'
import FourPlus from '@assets/svg/FourPlus.vue'
import SixPlus from '@assets/svg/SixPlus.vue'
import TwelvePlus from '@assets/svg/TwelvePlus.vue'
import SixteenPlus from '@assets/svg/SixteenPlus.vue'
import EighteenPlus from '@assets/svg/EighteenPlus.vue'

const props = defineProps({
  age: { type: [Number, String], default: null },  
  klassz: { type: String, default: 'w-8 h-8' }      
})

const AGE_MAP = {
  0: ZeroPlus,
  4: FourPlus,
  6: SixPlus,
  12: TwelvePlus,
  16: SixteenPlus,
  18: EighteenPlus
} 

const badgeComp = computed(() => {
  const key = Number(props.age)
  return AGE_MAP[key] ?? null
})
</script>

<template>
  <component v-if="badgeComp" :is="badgeComp" :class="klassz" />
</template>