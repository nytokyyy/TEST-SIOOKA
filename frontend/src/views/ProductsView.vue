<script setup>
import { onMounted } from 'vue'
import { useProductStore } from '@/stores/productStore'
import ProductCard from '@/components/ProductCard.vue'

const productStore = useProductStore()

onMounted(() => {
  productStore.fetchProducts()
})
</script>

<template>
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-6">Produits</h1>

        <div class="grid grid-cols-3 gap-6">
            <ProductCard
                v-for="product in productStore.products"
                :key="product.id"
                :product="product"
            />
        </div>
    </div>
</template>