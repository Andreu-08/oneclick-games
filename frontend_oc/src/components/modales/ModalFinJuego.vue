<template>
  <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 px-4">
    <div class="bg-green-100 rounded-2xl shadow-xl p-8 w-full max-w-lg border border-blue-100">

      <!-- Título con iconos -->
      <div class="flex items-center justify-between mb-4">
        <img src="@/assets/icons/win.png" alt="Fin del juego" class="w-15 h-15" />
        <h2 class="text-3xl text-blue-900 font-semibold text-center flex-1">
          ¡Fin del juego!
        </h2>
        <img src="@/assets/icons/win.png" alt="Fin del juego" class="w-15 h-15" />
      </div>

      <!-- Mensaje con puntuación -->
      <div class="text-center mb-8">
        <p class="text-blue-700 font-semibold text-2xl">
            {{ puntuacion }} puntos
        </p>
      </div>

      <!-- Botones -->
      <div class="flex justify-center gap-6">
        <button
          @click="$emit('salir')"
          class="text-xl bg-red-200 hover:bg-red-300 text-gray-800 px-6 py-2 rounded-full transition cursor-pointer"
        >
          Salir
        </button>
        <button
          @click="$emit('reiniciar')"
          class="text-xl bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full transition cursor-pointer"
        >
          Reiniciar
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModalFinJuego',
  props: {
    puntuacion: {
      type: Number,
      required: true
    }
  }
}
</script>
