import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { router } from '@/router/index.js'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import { plugin, defaultConfig } from '@formkit/vue'
import { definePreset } from '@primeuix/themes';
import config from '../formkit.config.js'

import Toast from "vue3-toastify";
import "vue3-toastify/dist/index.css";

// PrimeVue
import PrimeVue from 'primevue/config';
import Paginator from 'primevue/paginator'
import Aura from '@primeuix/themes/aura';

const CinemaRoadPreset = definePreset(Aura, {
    semantic:{
        primary:{
            50: '{pink.100}',
            100: '{pink.100}',
            200: '{pink.200}',
            300: '{pink.300}',
            400: '{pink.400}',
            500: '{pink.500}',
            600: '{pink.600}',
            700: '{pink.700}',
            800: '{pink.800}',
            900: '{pink.900}',
            950: '{pink.950}'
        }
    }
})

import App from '@/App.vue'

import '@assets/app.scss'

const app = createApp(App)

const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)

app.use(router)
app.use(plugin, defaultConfig(config))
app.use(pinia)
app.use(Toast);

app.use(PrimeVue, {
    // Default theme configuration
    theme: {
        preset: CinemaRoadPreset,
        options: {
            prefix: 'p',
            darkModeSelector: false || 'none',
            cssLayer: false
        }
    }
 });
app.component('Paginator', Paginator);

app.mount('#app')
