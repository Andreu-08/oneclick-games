<template>
  <div class="relative min-h-screen flex flex-col justify-start items-center px-4 pt-10 text-white">
    <!-- Fondo desenfocado -->
    <div class="absolute inset-0 bg-[url('@/assets/bg_home.webp')] bg-cover bg-center brightness-50"></div>

    <!-- Contenido principal -->
    <div class="relative z-10 w-full max-w-3xl flex flex-col gap-8 items-center">
      
      <!-- Puntuación y vidas -->
      <div class="flex justify-between w-full items-center px-4">
        <div class="flex items-center gap-2 text-green-300 text-6xl font-bold">
          <img src="@/assets/icons/star.png" alt="Puntos" class="w-12 h-12" />
          0
        </div>
        <div class="flex items-center gap-2 text-red-400 text-6xl font-bold">
          5
          <img src="@/assets/icons/heart.png" alt="Vidas" class="w-15 h-15" />
        </div>
      </div>

      <!-- Cuadrícula de colores (simulada) -->
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 p-6 rounded-2xl bg-white/10 shadow-md w-full">
        <div v-for="(color, index) in colores" :key="index"
          :class="[ 'h-24 sm:h-28 rounded-xl cursor-pointer transition shadow-md', color ]">
        </div>
      </div>

      <!-- Botón simulado -->
      <div class="flex gap-4">
        <button
          class="bg-blue-500 hover:bg-blue-600 text-white font-semibold text-lg px-6 py-3 rounded-xl shadow-md">
          Repetir secuencia
        </button>
      </div>

      <!-- Mensaje en desarrollo -->
      <div class="bg-yellow-200 text-yellow-800 px-6 py-4 rounded-xl text-xl text-center shadow-md">
        Este juego está en desarrollo...
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SecuenciaColores',
  data() {
    return {
      colores: [
        'bg-red-500',
        'bg-yellow-400',
        'bg-green-400',
        'bg-blue-500'
      ]
    }
  }
}
</script>
