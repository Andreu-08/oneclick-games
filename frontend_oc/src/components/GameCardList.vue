<template>
  <section class="px-4 sm:px-6 md:px-8 w-full max-w-screen-2xl mx-auto">

    <!-- Skeletons mientras se cargan -->
    <div v-if="cargando" class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
      <SkeletonCard v-for="indice in 6" :key="'skeleton-' + indice" />
    </div>

    <!-- Lista real de juegos -->
    <div v-else-if="games.length" class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
      <GameCard v-for="game in games" :key="game.id" :game="game" />
    </div>

    <p v-else class="text-blue-800 text-lg mt-4">No se pudieron cargar los juegos.</p>
  </section>
</template>

<script>
import GameCard from '@/components/GameCard.vue'
import SkeletonCard from '@/components/skeletons/SkeletonCard.vue'
import { getGames } from '@/services/games.js'

export default {
  name: 'GameCardList',
  components: {
    GameCard,
    SkeletonCard
  },
  data() {
    return {
      games: [],
      cargando: true
    }
  },
  mounted() {
    this.fetchGames()
  },
  methods: {
    async fetchGames() {
      try {
        this.cargando = true
        this.games = await getGames()
      } catch (error) {
        console.error('Error al cargar los juegos:', error)
      } finally {
        this.cargando = false
      }
    }
  }
}
</script>
