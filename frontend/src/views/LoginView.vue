<script setup>
import { ref } from 'vue'
import { useAuthStore } from '@/stores/authStore'
import { useRouter } from 'vue-router'

const authStore = useAuthStore()
const router = useRouter()

const email = ref('')
const password = ref('')

const submit = async () => {
    await authStore.loginUser({
        email: email.value,
        password: password.value
    })

    router.push('/')
}
</script>

<template>
    <div class="max-w-md mx-auto bg-white p-6 shadow rounded">
        <h2 class="text-2xl mb-4">Connexion</h2>

        <input v-model="email" type="email" placeholder="Email"
        class="w-full mb-3 p-2 border rounded" />

        <input v-model="password" type="password" placeholder="Mot de passe"
        class="w-full mb-3 p-2 border rounded" />

        <button @click="submit"
        class="w-full bg-blue-600 text-white p-2 rounded">
        Se connecter
        </button>
    </div>
</template>
