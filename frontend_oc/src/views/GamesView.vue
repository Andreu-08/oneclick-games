<template>
  <div class="relative min-h-screen flex flex-col text-gray-800">
    <!-- Fondo desenfocado -->
    <div class="absolute inset-0 bg-[url('@/assets/bg_home.webp')] bg-cover bg-center brightness-50"></div>

    <!-- Contenido principal -->
    <div class="relative z-10 w-full px-4 md:px-8 pt-10 pb-4 flex flex-col gap-8">
      <!-- Cabecera -->
      <div class="flex items-center gap-6 h-32">
        <div class="bg-white p-4 rounded-2xl shadow-xl h-full aspect-square flex items-center justify-center hover:scale-105 transition">
          <IconoHome width="w-25" height="h-25" padding="p-0" />
        </div>
        <div class="flex-1 h-full flex items-center justify-center">
          <TituloVistas :titulo="'JUEGOS'" />
        </div>
        <div class="h-full flex items-center gap-4">
          <button id="games-ranking" @click="abrirRanking" title="Ver ranking global"
            class="bg-white p-4 rounded-2xl shadow-xl h-full aspect-square flex items-center justify-center hover:scale-105 transition cursor-pointer">
            <img src="@/assets/icons/ranking.png" alt="Ranking" class="w-18 h-18" />
          </button>
          <button id="games-logout" @click="cerrarSesion" title="Cerrar sesión"
            class="bg-white p-4 rounded-2xl shadow-xl h-full aspect-square flex items-center justify-center hover:scale-105 transition cursor-pointer">
            <img src="@/assets/icons/logout.png" alt="Salir" class="w-18 h-18" />
          </button>
        </div>
      </div>

      <!-- Lista de juegos con ID para tutorial -->
      <div id="games-lista">
        <GameCardList />
      </div>

      <!-- Modal ranking -->
      <ModalRanking
        v-if="showRanking"
        :ranking="ranking"
        :userId="userStore.user.id"
        :userInfo="userRanking"
        :cargando="cargandoRanking"
        @close="showRanking = false"
      />
    </div>
  </div>
</template>

<script>
import IconoHome from '@/components/IconoHome.vue'
import TituloVistas from '@/components/TituloVistas.vue'
import GameCardList from '@/components/GameCardList.vue'
import ModalRanking from '@/components/modales/ModalRanking.vue'
import { getGlobalRanking, getMyGlobalRanking } from '@/services/scores.js'
import { useUserStore } from '@/stores/user'
import { useRouter } from 'vue-router'

import { driver } from 'driver.js'
import 'driver.js/dist/driver.css'

export default {
  name: 'GamesView',
  components: {
    IconoHome,
    TituloVistas,
    GameCardList,
    ModalRanking
  },
  data() {
    return {
      showRanking: false,
      ranking: [],
      userRanking: null,
      cargandoRanking: false
    }
  },
  setup() {
    const userStore = useUserStore()
    const router = useRouter()
    return { userStore, router }
  },
  mounted() {
    if (!localStorage.getItem('tutorial_games_done')) {
      this.iniciarTutorialGames()
      localStorage.setItem('tutorial_games_done', 'true')
    }
  },
  methods: {
    async iniciarTutorialGames() {
      const driverObj = driver({
        popoverClass: 'driverjs-theme',
        nextBtnText: 'Siguiente',
        prevBtnText: 'Anterior',
        doneBtnText: 'Aceptar',
        allowClose: false,
        steps: [
          {
            element: '#games-lista',
            popover: {
              title: 'Elige tu juego favorito.',
              description: '',
              side: 'top',
              align: 'center'
            }
          },
          {
            element: '#games-ranking',
            popover: {
              title: 'Aquí puedes ver cuántos puntos tienes en total.',
              description: '',
              side: 'top',
              align: 'center'
            }
          },
          {
            element: '#games-logout',
            popover: {
              title: 'Aquí puedes cerrar sesión.',
              description: '',
              side: 'top',
              align: 'center'
            }
          },
          {
            element: '#games-jugar',
            popover: {
              title: 'Presiona "JUEGA YA" para comenzar a jugar.',
              description: '',
              side: 'top',
              align: 'center'
            }
          }
        ]
      })

      driverObj.drive()
    },
    async cerrarSesion() {
      await this.userStore.logout()
      this.router.push('/login')
    },
    async abrirRanking() {
      this.showRanking = true
      this.cargandoRanking = true

      try {
        const [top, me] = await Promise.all([
          getGlobalRanking(),
          getMyGlobalRanking()
        ])
        this.ranking = top
        this.userRanking = me
      } catch (error) {
        console.error('Error al cargar el ranking:', error)
      } finally {
        this.cargandoRanking = false
      }
    }
  }
}
</script>
