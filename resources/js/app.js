import './bootstrap';

import Alpine from 'alpinejs';

import { createApp } from "vue";
import router from './router';
import App from './Components/App.vue';

createApp({App}).use(router).mount('#app')

window.Alpine = Alpine;

Alpine.start();
