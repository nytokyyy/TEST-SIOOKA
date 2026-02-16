<script setup>
import { onMounted } from 'vue'
import { useCartStore } from '@/stores/cartStore'
import CartItem from '@/components/CartItem.vue'

const cartStore = useCartStore()

onMounted(() => {
  cartStore.fetchCart()
})
</script>

<template>
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-6">Mon Panier</h1>

        <CartItem
        v-for="item in cartStore.items"
        :key="item.id"
        :item="item"
        />

        <div class="mt-6 text-right font-bold text-xl">
        Total : {{ cartStore.totalPrice }} €
        </div>
    </div>
</template>
