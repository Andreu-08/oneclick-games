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
          <button @click="abrirRanking" title="Ver ranking global"
            class="bg-white p-4 rounded-2xl shadow-xl h-full aspect-square flex items-center justify-center hover:scale-105 transition cursor-pointer">
            <img src="@/assets/icons/ranking.png" alt="Ranking" class="w-18 h-18" />
          </button>
          <button @click="cerrarSesion" title="Cerrar sesión"
            class="bg-white p-4 rounded-2xl shadow-xl h-full aspect-square flex items-center justify-center hover:scale-105 transition cursor-pointer">
            <img src="@/assets/icons/logout.png" alt="Salir" class="w-18 h-18" />
          </button>
        </div>
      </div>

      <!-- Lista de juegos -->
      <GameCardList />

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
      cargandoRanking: false // ⬅️ NUEVO: estado para mostrar skeleton
    }
  },
  setup() {
    const userStore = useUserStore()
    const router = useRouter()
    return { userStore, router }
  },
  methods: {
    async cerrarSesion() {
      await this.userStore.logout()
      this.router.push('/login')
    },
    async abrirRanking() {
      this.showRanking = true
      this.cargandoRanking = true // Activamos el skeleton

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
