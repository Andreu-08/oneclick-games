<template>
  <div class="relative min-h-screen flex flex-col text-gray-800">
    <!-- Fondo desenfocado -->
    <div class="absolute inset-0 bg-[url('@/assets/bg_home.webp')] bg-cover bg-no-repeat bg-center brightness-50"></div>

    <!-- Contenido encima -->
    <div class="relative z-10 flex-1 flex flex-col items-center justify-start px-4 pt-6">
      <div class="w-full max-w-4xl flex flex-row items-center gap-4 mb-6">
        <!-- LOGO reducido -->
        <div class="bg-white rounded-2xl shadow-xl flex items-center justify-center p-4 w-24 h-24 md:w-32 md:h-32 transition-transform duration-300 hover:scale-105">
          <img
            src="../assets/Logo_oc.png"
            alt="Logo OneClick Games"
            class="w-16 h-16 md:w-24 md:h-24 rounded-full"
          />
        </div>
        <!-- TÍTULO reducido -->
        <div class="flex-1 bg-blue-100 rounded-2xl shadow-xl flex items-center justify-center p-3 md:p-4 transition-transform duration-300 hover:scale-105">
          <h1 class="text-2xl md:text-4xl font-extrabold text-center text-blue-900 drop-shadow-2xl tracking-wide">
            Juegos
          </h1>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 w-full max-w-6xl pb-12">
        <GameCard v-for="game in games" :key="game.id" :game="game" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { getGames } from '@/services/games'
import GameCard from '@/components/GameCard.vue'

const games = ref([])

onMounted(async () => {
  games.value = await getGames()
})
</script>
