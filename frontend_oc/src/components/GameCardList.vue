<template>
  <section class="p-4 sm:p-6 md:p-8 max-w-7xl mx-auto">
    <div v-if="games.length" class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
      <GameCard v-for="game in games" :key="game.id" :game="game" />
    </div>

    <p v-else class="text-blue-800 text-lg mt-4">Cargando juegos...</p>
  </section>
</template>

<script>
import GameCard from '@/components/GameCard.vue'
import { getGames } from '@/services/games.js'

export default {
  name: 'GameCardList',
  components: {
    GameCard
  },
  data() {
    return {
      games: []
    }
  },
  mounted() {
    this.fetchGames()
  },
  methods: {
    async fetchGames() {
      try {
        this.games = await getGames()
      } catch (error) {
        console.error('Error al cargar los juegos:', error)
      }
    }
  }
}
</script>
