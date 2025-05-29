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
          class="bg-white p-4 rounded-2xl shadow-xl hover:scale-105 transition cursor-pointer h-full aspect-square flex items-center justify-center">
          <IconoHome width="w-25" height="h-25" padding="p-0" />
        </div>

        <!-- Título del juego -->
        <div class="flex-1 h-full flex items-center justify-center">
          <TituloVistas :titulo="game?.title?.toUpperCase() || 'CARGANDO JUEGO'" />
        </div>

        <!-- Botones de acción -->
        <div class="h-full flex items-center gap-4">
          <button @click="abrirRanking" title="Ver ranking del juego"
            class="bg-white p-4 rounded-2xl shadow-xl hover:scale-105 transition cursor-pointer h-full aspect-square flex items-center justify-center">
            <img src="@/assets/icons/ranking.png" alt="Ranking" class="w-18 h-18" />
          </button>
          <button @click="salirJuego" title="Volver"
            class="bg-white p-4 rounded-2xl shadow-xl hover:scale-105 transition cursor-pointer h-full aspect-square flex items-center justify-center">
            <img src="@/assets/icons/logout.png" alt="Salir" class="w-18 h-18" />
          </button>
        </div>
      </div>

      <!-- Carga del componente de juego -->
      <div v-if="game">
        <OrdenarPalabras v-if="game.url === 'ordenar-palabras'" :juego="game" @finJuego="mostrarFinJuego" />
        <SecuenciaColores v-if="game.url === 'secuencia-de-colores'" :juego="game" @finJuego="mostrarFinJuego" />
        <EncuentraNumero v-if="game.url === 'encuentra-el-numero'" :juego="game" @finJuego="mostrarFinJuego" />
      </div>

      <!-- JUEGO CARGANDO -->
      <div v-else class="flex justify-center items-center min-h-[400px]">
        <svg class="animate-spin h-40 w-40 text-blue-800" xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
        </svg>
      </div>


      <!-- Modal del ranking -->
      <ModalRanking v-if="showRanking" :ranking="ranking" :userId="userStore.user.id" :userInfo="userRanking"
        :title="'Top 10 - ' + game.title" :cargando="cargandoRanking" @close="showRanking = false" />


      <!-- Modal fin del juego -->
      <ModalFinJuego v-if="modalFin" :puntuacion="puntosObtenidos" @reiniciar="reiniciarJuego" @salir="salirJuego" />
    </div>
  </div>
</template>

<script>
import IconoHome from '@/components/IconoHome.vue'
import TituloVistas from '@/components/TituloVistas.vue'

//juegos
import OrdenarPalabras from '@/components/games/OrdenarPalabras.vue'
import SecuenciaColores from '@/components/games/SecuenciaColores.vue'
import EncuentraNumero from '@/components/games/EncuentraNumero.vue'

// modales
import ModalRanking from '@/components/modales/ModalRanking.vue'
import ModalFinJuego from '@/components/modales/ModalFinJuego.vue'

import { getGames } from '@/services/games.js'
import { getGameTopScores, getMyGameRanking, guardarPuntuacion } from '@/services/scores.js'
import { useRoute, useRouter } from 'vue-router'
import { useUserStore } from '@/stores/user'

export default {
  name: 'GameView',
  components: {
    IconoHome,
    TituloVistas,
    OrdenarPalabras,
    SecuenciaColores,
    EncuentraNumero,
    ModalRanking,
    ModalFinJuego
  },
  data() {
    return {
      game: null,
      showRanking: false,
      ranking: [],
      userRanking: null,
      modalFin: false,
      puntosObtenidos: 0,
      cargandoRanking: false
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
  this.showRanking = true
  this.cargandoRanking = true

  try {
    // Simulación de carga lenta para ver el skeleton
    const [ranking, me] = await Promise.all([
      getGameTopScores(this.game.id),
      getMyGameRanking(this.game.id)
    ])
    this.ranking = ranking
    this.userRanking = me
  } catch (err) {
    console.error('Error al cargar el ranking del juego:', err)
  } finally {
    this.cargandoRanking = false
  }
},
    salirJuego() {
      this.router.push('/games')
    },
    async mostrarFinJuego(puntos) {
      this.puntosObtenidos = puntos
      this.modalFin = true
      
      //si la puntuación es 0 no la amacenamos 
      if (puntos === 0) {
      console.log('No se guarda puntuación porque el resultado fue 0.')
      return
      }

      try {
        await guardarPuntuacion(this.game.id, puntos)
      } catch (err) {
        console.error('Error al guardar puntuación:', err)
      }
    },
    async reiniciarJuego() {
      this.modalFin = false
      this.game = null
      this.$nextTick(async () => {
        const games = await getGames()
        this.game = games.find(g => g.url === this.route.params.url)
      })
    }
  }
}
</script>
