<template>
  <div class="relative flex flex-col items-start gap-4 rounded-2xl shadow-xl p-6 bg-gradient-to-br from-yellow-100 via-white to-blue-100 border-2 border-blue-200 hover:border-blue-400 w-full min-h-[240px]">
    
    <!-- Título del juego -->
    <h2 class="font-semibold text-2xl text-blue-900">
      {{ game.title }}
    </h2>

    <!-- Descripción del juego -->
    <p class="text-blue-800 text-base flex-1">
      {{ game.description }}
    </p>

    <!-- Botón de jugar -->
    <router-link
      :to="`/games/${game.url}`"
      class="mt-auto px-6 py-2 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-semibold text-lg text-center self-end"
    >
      Jugar
    </router-link>

    <!-- Capa decorativa para sombra suave -->
    <div class="absolute inset-0 rounded-2xl pointer-events-none" style="box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);"></div>
  </div>
</template>

<script>
export default {
  name: 'GameCard',
  props: {
    game: {
      type: Object,
      required: true
    }
  }
}
</script>
