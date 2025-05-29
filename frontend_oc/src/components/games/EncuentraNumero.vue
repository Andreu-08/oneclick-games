<template>
  <div class="relative min-h-screen flex flex-col justify-start items-center px-4 pt-10 text-white">
    <!-- Fondo accesible -->
    <div class="absolute inset-0 bg-[url('@/assets/bg_home.webp')] bg-cover bg-center brightness-50"></div>

    <!-- Contenedor principal -->
    <div class="relative z-10 w-full max-w-4xl flex flex-col gap-6 items-center">

      <!-- Cabecera: puntos, número objetivo, vidas -->
      <div class="flex justify-between items-center w-full px-4">
        <!-- Puntos -->
        <div class="flex items-center gap-2 text-green-300 text-5xl font-bold">
          <img src="@/assets/icons/star.png" alt="Puntos" class="w-10 h-10" />
          0
        </div>

        <!-- Número objetivo -->
        <div class="text-violet-600 text-3xl md:text-4xl font-extrabold text-center bg-violet-400/80 px-6 py-2 rounded-xl shadow">
          Busca el número <br><span class="text-6xl text-yellow-300">8</span>
        </div>

        <!-- Vidas -->
        <div class="flex items-center gap-2 text-red-400 text-5xl font-bold">
          5
          <img src="@/assets/icons/heart.png" alt="Vidas" class="w-10 h-10" />
        </div>
      </div>

      <!-- Cuadrícula accesible de números -->
      <div class="grid grid-cols-3 sm:grid-cols-4 gap-4 p-4 rounded-xl bg-white/10 shadow w-full">
        <button
          v-for="(num, i) in numeros"
          :key="i"
          class="bg-white text-gray-900 font-bold text-3xl sm:text-4xl h-20 rounded-xl flex items-center justify-center shadow-md hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-violet-400 transition"
        >
          {{ num }}
        </button>
      </div>

      <!-- Botón siguiente -->
      <div>
        <button
          class="bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold px-6 py-3 rounded-xl shadow focus:outline-none focus:ring-4 focus:ring-yellow-300"
        >
          Siguiente número
        </button>
      </div>

      <!-- Aviso accesible -->
      <div class="bg-yellow-200 text-yellow-800 px-6 py-4 rounded-xl text-base text-center shadow-md">
        Este juego está en desarrollo...
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'EncuentraNumero',
  data() {
    return {
      numeros: [1, 4, 8, 2, 7, 3, 9, 5, 6, 0, 10, 11]
    }
  }
}
</script>
