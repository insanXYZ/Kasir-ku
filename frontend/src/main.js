import './assets/css/index.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import Vue3Toasity from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const app = createApp(App)
app.use(createPinia())
app.use(VueSweetalert2);
app.use(router)
app.use(Vue3Toasity, {
  autoClose: 3000,
})
app.mount('#app')
