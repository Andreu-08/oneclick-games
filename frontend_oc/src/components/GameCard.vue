<template>
  <div class="relative flex flex-col items-start gap-4 rounded-2xl shadow-2xl p-8 bg-gradient-to-br from-yellow-100 via-white to-blue-100 border-2 border-blue-200 hover:border-blue-400 transition-all duration-300 hover:scale-105 min-h-[240px] w-full">
    <h2 class="font-extrabold text-2xl md:text-3xl text-blue-900 drop-shadow-2xl mb-2 tracking-wide">
      {{ game.title }}
    </h2>
    <p class="text-blue-800/90 text-base md:text-lg mb-4 flex-1">
      {{ game.description }}
    </p>
    <router-link
      :to="`/games/${game.url}`"
      class="mt-auto px-8 py-3 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-bold text-lg shadow-lg transition-all text-center self-end focus:outline-none focus:ring-4 focus:ring-blue-300"
    >
      Jugar
    </router-link>
    <div class="absolute inset-0 rounded-2xl pointer-events-none" style="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.10);"></div>
  </div>
</template>

<script setup>
defineProps({ game: Object })
</script>
