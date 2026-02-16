import { defineStore } from 'pinia'
import { getCart, updateCartQuantity, addToCart, removeFromCart } from '@/api/cartManagement/cartApi'

export const useCartStore = defineStore('cart', {
    state: () => ({
        items: [],
        loading: false,
        totalPrice: 0
    }),

    actions: {
        async fetchCart() {
            this.loading = true
            const { data } = await getCart()
            
            this.items = data.data.cartItems
            this.totalPrice = data.data.total
            this.loading = false
        },

        async changeQuantity(productId, action) {
            await updateCartQuantity(productId, action)
            await this.fetchCart()
        },

        async addToCart(productId, quantity = 1) {
            await addToCart(productId, quantity)
            await this.fetchCart()
        },

        async removeItem(productId) {
            await removeFromCart(productId)
            await this.fetchCart()
        }
    }
})