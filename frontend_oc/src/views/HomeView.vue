<template>
  <div class="relative min-h-screen flex flex-col text-gray-800">
    <!-- Fondo desenfocado -->
    <div class="absolute inset-0 bg-[url('@/assets/bg_home.webp')] bg-cover bg-no-repeat bg-center brightness-50"></div>

    <!-- Contenido encima -->
    <div class="relative z-10 flex-1 flex items-center justify-center px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 md:grid-rows-2 gap-6 w-full max-w-6xl py-12">

        <!-- LOGO -->
        <div class="hover:scale-105 transition">
          <IconoHome />
        </div>

        <!-- TÍTULO -->
        <div class="md:col-span-2 bg-yellow-100 rounded-2xl shadow-xl flex items-center justify-center p-6 hover:scale-105 transition">
          <h1 class="text-4xl md:text-6xl font-semibold text-center">OneClick Games</h1>
        </div>

        <!-- BOTÓN JUGAR -->
        <div
          id="tour-jugar"
          class="md:col-span-2 bg-green-100 rounded-2xl shadow-xl p-6 flex flex-col items-center justify-center gap-6 text-center hover:scale-105 transition"
        >
          <button
            @click="entrar"
            class="bg-blue-600 hover:bg-blue-700 hover:scale-105 transition text-white text-3xl md:text-5xl font-semibold px-12 py-6 md:px-30 md:py-10 rounded-full cursor-pointer"
          >
            JUGAR
          </button>
        </div>

        <!-- MENSAJE -->
        <div class="bg-blue-100 rounded-2xl shadow-xl flex items-center justify-center p-6 hover:scale-105 transition">
          <p class="text-2xl md:text-5xl font-semibold text-center">¡Diviértete jugando!</p>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import IconoHome from '@/components/IconoHome.vue'
import { useUserStore } from '@/stores/user'
import { useRouter } from 'vue-router'
import { driver } from 'driver.js'
import 'driver.js/dist/driver.css'

export default {
  name: 'HomeView',
  components: {
    IconoHome
  },
  data() {
    return {
      userStore: useUserStore(),
      router: useRouter()
    }
  },
  mounted() {
    if (!localStorage.getItem('oneclick_tour_done')) {
      this.iniciarTour()
      localStorage.setItem('oneclick_tour_done', 'true')
    }
  },
  methods: {
    entrar() {
      this.router.push(this.userStore.isAuthenticated ? '/games' : '/login')
    },
    iniciarTour() {
      const driverObj = driver({
        popoverClass: 'driverjs-theme',
        opacity: 0.3,
        doneBtnText: 'Aceptar',
        allowClose: false,
        steps: [
          {
            element: '#tour-jugar',
            popover: {
              title: '¡Presiona aquí para JUGAR!',
              description: '',
              side: 'top',
              align: 'center',
              showButtons: ['next']
            }
          }
        ]
      })

      driverObj.drive()
    }
  }
}
</script>
