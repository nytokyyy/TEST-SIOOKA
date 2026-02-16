<script setup>
import { useCartStore } from '@/stores/cartStore'

const props = defineProps({
  item: Object
})

const cartStore = useCartStore()
</script>

<template>
    <div class="flex justify-between items-center border-b py-4">
        <div>
            <p class="font-semibold">{{ item.product.name }}</p>
            <p class="text-gray-500">{{ item.product.price }} €</p>
        </div>

        <div class="flex items-center gap-3">
            <button
                class="px-3 py-1 bg-gray-200 rounded"
                @click="cartStore.changeQuantity(item.product.id, 'decrement')"
            >
                -
            </button>

            <span>{{ item.quantity }}</span>

            <button
                class="px-3 py-1 bg-gray-200 rounded"
                @click="cartStore.changeQuantity(item.product.id, 'increment')"
            >
                +
            </button>

            <button
                class="text-red-500 hover:text-red-700 transition"
                @click="cartStore.removeItem(item.product.id)"
            >
                Supprimer
            </button>
        </div>
    </div>
</template>