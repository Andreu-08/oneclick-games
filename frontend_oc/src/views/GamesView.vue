<template>
  <div class="relative min-h-screen flex flex-col text-gray-800">
    <!-- Fondo desenfocado -->
    <div class="absolute inset-0 bg-[url('@/assets/bg_home.webp')] bg-cover bg-no-repeat bg-center brightness-50"></div>

    <!-- Contenido principal -->
    <div class="relative z-10 w-full px-4 md:px-8 pt-10 pb-4 flex flex-col gap-8">

      <!-- Cabecera perfectamente alineada -->
      <div class="flex items-center gap-6 h-32">

        <!-- Logo -->
        <div
          class="bg-white p-4 rounded-2xl shadow-xl hover:scale-105 transition cursor-pointer h-full aspect-square flex items-center justify-center"
        >
          <IconoHome width="w-25" height="h-25" padding="p-0" />
        </div>

        <!-- Título reutilizable -->
        <div class=" flex-1 h-full flex items-center justify-center">
          <TituloVistas :titulo="`JUEGOS`" />
        </div>

        <!-- Botones -->
        <div class="h-full flex items-center gap-4">
          <button
            @click="abrirRanking"
            title="Ver ranking global"
            class="bg-white p-4 rounded-2xl shadow-xl hover:scale-105 transition cursor-pointer h-full aspect-square flex items-center justify-center"
          >
            <img src="@/assets/icons/ranking.png" alt="Ranking" class="w-18 h-18" />
          </button>
          <button
            @click="cerrarSesion"
            title="Cerrar sesión"
            class="bg-white p-4 rounded-2xl shadow-xl hover:scale-105 transition cursor-pointer h-full aspect-square flex items-center justify-center"
          >
            <img src="@/assets/icons/logout.png" alt="Salir" class="w-18 h-18" />
          </button>
        </div>
      </div>

      <GameCardList />

    </div>
  </div>
</template>

<script>
import IconoHome from '@/components/IconoHome.vue'
import TituloVistas from '@/components/TituloVistas.vue'
import GameCardList from '@/components/GameCardList.vue'
import { useUserStore } from '@/stores/user'
import { useRouter } from 'vue-router'

export default {
  name: 'GamesView',
  components: {
    IconoHome,
    TituloVistas,
    GameCardList
  },
  data() {
    return {
      nickname: ''
    }
  },
  setup() {
    const userStore = useUserStore()
    const router = useRouter()
    return { userStore, router }
  },
  mounted() {
    this.nickname = this.userStore.user.nickname
  },
  methods: {
    async cerrarSesion() {
      await this.userStore.logout()
      this.router.push('/login')
    },
    abrirRanking() {
      alert('Aquí se abrirá el modal con el ranking global.')
    }
  }
}
</script>
