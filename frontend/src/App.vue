<script setup>
import { computed, onMounted } from 'vue'
import { useCartStore } from '@/stores/cartStore'
import { RouterView, RouterLink } from 'vue-router'

const cartStore = useCartStore()

onMounted(() => {
  cartStore.fetchCart()
})

const cartCount = computed(() =>
  cartStore.items.reduce((sum, item) => sum + item.quantity, 0)
)
</script>

<template>
  <div class="min-h-screen bg-gray-100 flex flex-col">

    <!-- NAVBAR -->
    <header class="bg-white shadow-md">
      <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo -->
        <RouterLink
          to="/"
          class="text-2xl font-bold text-blue-600"
        >
          MyShop
        </RouterLink>

        <!-- Navigation -->
        <nav class="flex items-center gap-6">

          <RouterLink
            to="/"
            class="hover:text-blue-600 transition"
          >
            Produits
          </RouterLink>

          <RouterLink
            to="/cart"
            class="relative hover:text-blue-600 transition"
          >
            Panier
            <span
              v-if="cartCount > 0"
              class="absolute -top-2 -right-4 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full"
            >
              {{ cartCount }}
            </span>
          </RouterLink>

        </nav>
      </div>
    </header>

    <main class="flex-1 max-w-6xl mx-auto w-full px-6 py-8">
      <RouterView />
    </main>

  </div>
</template>