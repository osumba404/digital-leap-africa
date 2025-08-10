import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router' // <-- IMPORT THE ROUTER

const app = createApp(App)

app.use(router) // <-- TELL THE APP TO USE THE ROUTER

app.mount('#app')