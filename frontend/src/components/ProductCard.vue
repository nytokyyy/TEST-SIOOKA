<script setup>
import { useCartStore } from '@/stores/cartStore'

const props = defineProps({
  product: Object
})

const cartStore = useCartStore()

const addToCart = () => {
  cartStore.addToCart(props.product.id)
}
</script>

<template>
    <div class="border p-4 rounded-xl shadow">
        <h2 class="text-lg font-bold">{{ product.name }}</h2>
        <p class="text-gray-600">{{ product.price }} €</p>

        <button
        class="bg-blue-600 text-white px-4 py-2 rounded mt-3 hover:bg-blue-700"
        @click="addToCart"
        >
            Ajouter au panier
        </button>
    </div>
</template>