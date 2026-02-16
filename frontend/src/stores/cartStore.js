import { defineStore } from 'pinia'
import { getCart, updateCartQuantity, addToCart } from '@/api/cartManagement/cartApi'

export const useCartStore = defineStore('cart', {
    state: () => ({
        items: [],
        loading: false,
    }),

    getters: {
        totalPrice: (state) =>
            state.items.reduce((sum, item) =>
                sum + item.quantity * item.product.price, 0
            )
    },

    actions: {
        async fetchCart() {
            this.loading = true
            const { data } = await getCart()
            
            this.items = data.data.cartItems
            this.loading = false
        },

        async changeQuantity(productId, action) {
            await updateCartQuantity(productId, action)
            await this.fetchCart()
        },

        async addToCart(productId, quantity = 1) {
            await addToCart(productId, quantity)
            await this.fetchCart()
        }
    }
})