<template>
  <article
    class="flex flex-col gap-4 p-5 rounded-2xl shadow-md w-full max-w-[400px] mx-auto hover:scale-105 hover:shadow-xl transition"
    style="background-color: #FEF9C2"
    tabindex="0"
    role="group"
    :aria-label="game.title"
  >
    <div class="bg-blue-100 rounded-xl px-4 py-2 text-center shadow-sm">
      <h2 class="text-2xl font-semibold uppercase">
        {{ game.title }}
      </h2>
    </div>

    <div class=" rounded-xl  h-[180px] flex items-center justify-center">
      <img
        :src="game.image_url"
        :alt="`Captura del juego ${game.title}`"
        class="w-full h-full object-contain"
      />
    </div>

    <div
      class="bg-purple-200 rounded-xl px-4 py-4 text-blue-900 text-base font-medium text-center shadow-inner h-[84px] flex items-center justify-center"
    >
    <p class="text-xl">
      {{ game.description }}
    </p>
    </div>

    <div id="games-jugar" class="flex justify-center bg-green-100 rounded-xl px-4 py-4 text-blue-900 text-base font-medium text-center shadow-inner h-[84px] flex items-center justify-center">
      <router-link
        :to="`/games/${game.url}`"
        class="w-full max-w-[300px] py-3 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-2xl font-semibold transition text-center focus:outline-none focus:ring-4 focus:ring-blue-300"
      >
        Jugar
      </router-link>
    </div>
  </article>
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
