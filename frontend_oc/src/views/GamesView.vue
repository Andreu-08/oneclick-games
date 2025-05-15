<template>
  <div class="relative min-h-screen flex flex-col text-gray-800">
    <!-- Fondo desenfocado -->
    <div class="absolute inset-0 bg-[url('@/assets/bg_home.webp')] bg-cover bg-no-repeat bg-center brightness-50"></div>

    <!-- Contenido principal -->
    <div class="relative z-10 w-full px-4 md:px-8 pt-10 pb-4 flex flex-col gap-8">

      <!-- Cabecera perfectamente alineada -->
      <div class="flex items-center gap-6 h-32">

        <!-- Logo -->
        <div class="bg-white p-4 rounded-2xl shadow-xl hover:scale-105 transition cursor-pointer h-full aspect-square flex items-center justify-center">
          <IconoHome width="w-25" height="h-25" padding="p-0" />
        </div>

        <!-- Título -->
        <div class="flex-1 h-full flex items-center justify-center">
          <div class="bg-blue-100 rounded-2xl shadow-xl px-12 py-6 w-full h-full flex items-center justify-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-800 text-center tracking-wide">
              Juegos
            </h1>
          </div>
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

      <!-- Lista de juegos -->
      <div class="text-xl md:text-2xl text-center text-blue-900 mt-4">
        Aquí irá la lista de juegos
      </div>

    </div>
  </div>
</template>

<script setup>
import IconoHome from '@/components/IconoHome.vue'
import { useUserStore } from '@/stores/user'
import { useRouter } from 'vue-router'

const userStore = useUserStore()
const router = useRouter()

const cerrarSesion = async () => {
  await userStore.logout()
  router.push('/login')
}

const abrirRanking = () => {
  alert('Aquí se abrirá el modal con el ranking global.')
}
</script>
