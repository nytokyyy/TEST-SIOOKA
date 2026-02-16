import { defineStore } from 'pinia'
import { login, register, logout, setAuthToken } from '@/api/auth/authApi'
import { useCartStore } from '@/stores/cartStore'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        token: null,
        loading: false,
    }),

    persist: {
        storage: localStorage,
        paths: ['user', 'token'],
    },

    getters: {
        isAuthenticated: (state) => !!state.token
    },

    actions: {
        async loginUser(credentials) {
            const { data } = await login(credentials)

            this.user = data.user
            this.token = data.access_token

            setAuthToken(data.access_token)

            // After login, fetch the cart to sync it with the server
            const cartStore = useCartStore()
            await cartStore.fetchCart()
        },

        async registerUser(payload) {
            const { data } = await register(payload)

            this.user = data.user
            this.token = data.token

            setAuthToken(data.token)
        },

        async logoutUser() {
            await logout()

            this.user = null
            this.token = null

            setAuthToken(null)
        },

        async initializeAuth() {
            if (this.token) {
                setAuthToken(this.token)

                try {
                    const { data } = await getUser()
                    this.user = data
                } catch (error) {
                    this.logoutUser()
                }
            }
        }
    }
})