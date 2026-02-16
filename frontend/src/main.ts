import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import './assets/main.css'
import { useAuthStore } from './stores/authStore'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import { setAuthToken } from '@/api/auth/authApi'

const app = createApp(App)
app.use(createPinia().use(piniaPluginPersistedstate))
app.use(router)


const authStore = useAuthStore()
// authStore.initializeAuth()
if (authStore.token) {
  setAuthToken(authStore.token)
}

app.mount('#app')
