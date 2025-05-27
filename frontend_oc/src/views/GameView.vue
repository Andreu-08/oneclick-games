<template>
  <div class="relative min-h-screen flex flex-col text-gray-800">
    <!-- Fondo desenfocado -->
    <div class="absolute inset-0 bg-[url('@/assets/bg_home.webp')] bg-cover bg-center brightness-50"></div>

    <!-- Contenido principal -->
    <div class="relative z-10 w-full px-4 md:px-8 pt-10 pb-4 flex flex-col gap-8">

      <!-- Cabecera superior -->
      <div class="flex items-center gap-6 h-32">
        <!-- Icono home -->
        <div
          class="bg-white p-4 rounded-2xl shadow-xl hover:scale-105 transition cursor-pointer h-full aspect-square flex items-center justify-center"
        >
          <IconoHome width="w-25" height="h-25" padding="p-0" />
        </div>

        <!-- Título del juego -->
        <div class="flex-1 h-full flex items-center justify-center">
          <TituloVistas :titulo="game?.title?.toUpperCase() || 'CARGANDO...'" />
        </div>

        <!-- Botones de acción -->
        <div class="h-full flex items-center gap-4">
          <button
            @click="abrirRanking"
            title="Ver ranking del juego"
            class="bg-white p-4 rounded-2xl shadow-xl hover:scale-105 transition cursor-pointer h-full aspect-square flex items-center justify-center"
          >
            <img src="@/assets/icons/ranking.png" alt="Ranking" class="w-18 h-18" />
          </button>
          <button
            @click="salirJuego"
            title="Volver"
            class="bg-white p-4 rounded-2xl shadow-xl hover:scale-105 transition cursor-pointer h-full aspect-square flex items-center justify-center"
          >
            <img src="@/assets/icons/logout.png" alt="Salir" class="w-18 h-18" />
          </button>
        </div>
      </div>

      <!-- Carga del componente de juego -->
      <div v-if="game">
        <OrdenarPalabras v-if="game.url === 'ordenar-palabras'" :juego="game" />
        <!-- Aquí puedes añadir más juegos con v-if -->
      </div>

      <!-- Mensaje si no se carga el juego -->
      <p v-else class="text-white text-lg text-center">Cargando juego...</p>

      <!-- Modal del ranking -->
      <ModalRanking
        v-if="showRanking"
        :ranking="ranking"
        :userId="userStore.user.id"
        :userInfo="userRanking"
        :title="'Top 10 - ' + game.title"
        @close="showRanking = false"
      />
    </div>
  </div>
</template>

<script>
import IconoHome from '@/components/IconoHome.vue'
import TituloVistas from '@/components/TituloVistas.vue'
import OrdenarPalabras from '@/components/games/OrdenarPalabras.vue'
import ModalRanking from '@/components/ModalRanking.vue'

import { getGames } from '@/services/games.js'
import { getGameTopScores, getMyGameRanking } from '@/services/scores.js'
import { useRoute, useRouter } from 'vue-router'
import { useUserStore } from '@/stores/user'

export default {
  name: 'GameView',
  components: {
    IconoHome,
    TituloVistas,
    OrdenarPalabras,
    ModalRanking
  },
  data() {
    return {
      game: null,
      showRanking: false,
      ranking: [],
      userRanking: null
    }
  },
  setup() {
    const route = useRoute()
    const router = useRouter()
    const userStore = useUserStore()
    return { route, router, userStore }
  },
  async mounted() {
    const games = await getGames()
    this.game = games.find(g => g.url === this.route.params.url)
  },
  methods: {
    async abrirRanking() {
      try {
        const [ranking, me] = await Promise.all([
          getGameTopScores(this.game.id),
          getMyGameRanking(this.game.id)
        ])
        this.ranking = ranking
        this.userRanking = me
        this.showRanking = true
      } catch (err) {
        console.error('Error al cargar el ranking del juego:', err)
      }
    },
    salirJuego() {
      this.router.push('/games')
    }
  }
}
</script>
