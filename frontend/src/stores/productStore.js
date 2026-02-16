import { defineStore } from 'pinia'
import { getProducts } from '@/api/cartManagement/productApi'

export const useProductStore = defineStore('product', {
    state: () => ({
        products: [],
        loading: false,
    }),

    actions: {
        async fetchProducts() {
            this.loading = true
            const { data } = await getProducts()
            this.products = data.data
            this.loading = false
        }
    }
})