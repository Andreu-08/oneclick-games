<template>
  <div class="relative min-h-screen flex flex-col text-gray-800">
    <!-- Fondo desenfocado -->
    <div
      class="absolute inset-0 bg-[url('@/assets/bg_home.webp')] bg-cover bg-no-repeat bg-center brightness-50"
    ></div>

    <!-- Contenido encima -->
    <div class="relative z-10 flex-1 flex items-center justify-center px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 md:grid-rows-2 gap-6 w-full max-w-6xl py-12">

        <!-- LOGO extraído a componente -->
        <IconoHome />

        <!-- TÍTULO (2 columnas en desktop) -->
        <div class="md:col-span-2 bg-yellow-100 rounded-2xl shadow-xl flex items-center justify-center p-6 transition-transform duration-300 hover:scale-105">
          <h1 class="text-4xl md:text-6xl font-extrabold text-center">OneClick Games</h1>
        </div>

        <!-- DESCRIPCIÓN + BOTÓN -->
        <div class="md:col-span-2 bg-green-100 rounded-2xl shadow-xl p-6 flex flex-col items-center justify-center gap-6 text-center transition-transform duration-300 hover:scale-105">
          <button
            @click="handlePlay"
            class="bg-blue-600 hover:bg-blue-700 text-white text-3xl md:text-5xl font-extrabold px-12 py-6 md:px-30 md:py-10 rounded-full focus:outline-none focus:ring-4 focus:ring-blue-400 transition-all duration-300 cursor-pointer"
          >
            JUGAR
          </button>
        </div>

        <div class="bg-blue-100 rounded-2xl shadow-xl flex items-center justify-center p-6 transition-transform duration-300 hover:scale-105">
          <p class="text-2xl md:text-4xl font-bold text-center">¡Diviértete jugando!</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// Vista principal de la aplicación
// Contiene acceso al juego o login dependiendo del estado de autenticación

import { useRouter } from 'vue-router'
import { useUserStore } from '@/stores/user'
import IconoHome from '@/components/IconoHome.vue'

const router = useRouter()
const userStore = useUserStore()

const handlePlay = () => {
  if (userStore.isAuthenticated) {
    router.push('/games')
  } else {
    router.push('/login')
  }
}
</script>
